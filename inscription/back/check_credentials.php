<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function check_csrf_token() {
    session_start();

    if (
        empty($_SESSION['csrf_token_auth']) ||
        empty($_SESSION['csrf_token_loader_c'])      
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
    
    $data_array = $_SESSION["data-c"];
    $email = $data_array["email-c"];
    $mdp = $data_array["password-c"];

    
    check_user($email, $mdp, $pdo);
}


// Vérifier validité email
function check_user($email, $mdp, $pdo) {
    try {
        $stmt = $pdo->query("SELECT email FROM users");
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (in_array($email, $rows)) {
            check_mdp($email, $mdp, $pdo);
        } else {
            $act = "in";
            header("Location: ../inscription.php?act=" . urlencode($act));
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}


// Vérifier mot de passe
function check_mdp($email, $mdp, $pdo) {
    try {
        $stmt = $pdo->prepare("SELECT mdp FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $mdp_in_database = $stmt->fetchColumn();

        if (password_verify($mdp, $mdp_in_database)) {
            end_to();
        } else {
            sleep(3);
            $act = "wp";
            header("Location: ../inscription.php?act=" . urlencode($act));
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

function end_to() {
    header("Location: ../../accueil/accueil.html");
    exit;
}

check_csrf_token();