<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


// Vérification du token CSRF
function check_csrf_token() {
    session_start();

    if (
        empty($_SESSION['csrf_token_auth']) ||
        empty($_SESSION['csrf_token_loader_i'])
    ) {
        http_response_code(403);
        exit;
    } else {
        init();
    }
    
}


// Initialiser les principaux paramètres
function init() {
    
    require "../../vendor/autoload.php";
    require "config.php";

    $email_array = $_SESSION["form_data"];
    $email = $email_array["email-i"];
    $_SESSION['email_user'] = $email;

    if ($email === "") {
        die("Tous les champs sont requis.");
    } else {
        delete_old_rows($email, $pdo);
    }
}


// Delete les lignes trop vieilles (> 10 minutes)
function delete_old_rows($email, $pdo) {
    try {
        $sql = "DELETE FROM `mail-inscription` WHERE `time` < NOW() - INTERVAL 10 MINUTE";
        $pdo->exec($sql);
        $stmt = $pdo->prepare("DELETE FROM `mail-inscription` WHERE email = :email");
        $stmt->execute([
            ":email" => $email
        ]);
        check_email($email, $pdo);
    } catch (PDOException $e) {
        die ("Erreur : " . $e->getMessage());
    }
}


// Vérifier si email n'est pas déjà en BDD
function check_email($email, $pdo) {
    try {
        $stmt = $pdo->query("SELECT email FROM `users`");
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $email_a_verifier = $email;

        if (in_array($email_a_verifier, $rows)) {
            $act = "co";
            header("Location: ../inscription.php?act=" . urlencode($act));
            exit;
        } else {
            insert($email, $pdo);
        }
    } catch (PDOException $e) {
        die ("Erreur : " . $e->getMessage());
    }
}


// Insert dans BDD
function insert($email, $pdo) {
    $code = rand(100000, 999999);
    try {
        $sql = "INSERT INTO `mail-inscription` (email, code) VALUES (:email, :code)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":email" => $email,
            ":code" => $code
        ]);
        send_mail($email, $pdo, $code);
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement en BDD : " . $e->getMessage());
    }
}


// Mail
function send_mail($email, $pdo, $code) {
    $mail = new PHPMailer(true);

    $msg = "<strong>👋 Bienvenue sur JanTo !</strong> <br><br><br> Pour vérifier votre email, entrez le code suivant : <br><br> <strong>{$code}</strong> <br><br> Attention, ce code est valable pendant uniquement 10 minutes, après quoi il sera désactivé. <br><br><br> Si vous n'êtes pas à l'origine de cet email, veuillez l'ignorer. <br><br><br><br> Cordialement,<br> L'équipe JanTo<br><a scr='mailto:service.janto@gmail.com'>service.janto@gmail.com</a>";

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "service.janto@gmail.com";
        $mail->Password = "isua maoc kybj rhbb";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->setFrom("service.janto@gmail.com", "JanTo");
        $mail->addAddress($email);
    
        $mail->isHTML(true);
        $mail->Subject = "Verifiez votre email";
        $mail->Body = $msg;

        $mail->send();
    
        end_to();
    } catch (Exception $e) {
        die("Erreur: {$mail->ErrorInfo}");
    }
}

function end_to() {
    header("Location: ../code-email.php");
    exit;
}

check_csrf_token();