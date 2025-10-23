<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



// Vérification du token CSRF
function check_csrf_token() {
    session_start();

    if (
        empty($_SESSION['csrf_token_auth']) ||
        empty($_SESSION['csrf_token_loader_i']) ||
        empty($_SESSION['email_user']) ||
        empty($_SESSION['csrf_token_code_email']) ||
        empty($_SESSION['csrf_token_loader_code_email']) ||
        empty($_SESSION['csrf_token_inscr_mdp']) ||
        empty($_SESSION['csrf_token_loader_mdp_i'])
    ) {
        http_response_code(403);
        exit;
    } else {
        init();
    }
}


// Initialiser
function init() {
    require "config.php";


    $data_array = $_SESSION["mdp-i"];
    $mdp1 = $data_array["mdpi1"];
    $mdp2 = $data_array["mdpi2"];

    $email_array = $_SESSION["form_data"];
    $email = $email_array["email-i"];

    if ($mdp1 === $mdp2 && $email !== "") {
        save_mdp($email, $mdp1, $mdp2, $pdo);
    } else {
        if ($email === "") {
            $act = "cr";
            header("Location: ../inscr-mdp.html?act=" . urlencode($act));
            exit;
        } else {
            $act = "df";
            header("Location: ../inscr-mdp.html?act=" . urlencode($act));
            exit;
        }
    }
}


// Save mdp
function save_mdp($email, $mdp1, $mdp2, $pdo) {
    $mdp_hash = password_hash($mdp1, PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("UPDATE users SET mdp = :mdp WHERE email = :email");
        $stmt->execute([
            ":mdp" => $mdp_hash,
            ":email" => $email
        ]);
        end_to($email, $mdp1, $mdp_hash);
    } catch (PDOException $e) {
        die("Erreur lors de la sauvegarde en BDD : " . $e->getMessage());
    }
}

function end_to($email, $mdp1, $mdp_hash) {
    header("Location: ../i-agree.php");
    exit;
}

check_csrf_token();