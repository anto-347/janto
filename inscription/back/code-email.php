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
        empty($_SESSION['csrf_token_loader_code_email'])
    ) {
        http_response_code(403);
        exit;
    } else {
        init();
    }
}


function init() {
    require "config.php";


    $code_array = $_SESSION['code-email'];
    $code = $code_array["code"];

    $email = $_SESSION['email_user'];


    check_code($pdo, $code, $email);
}

function check_code($pdo, $code, $email) {
    if ($code === "") {
        $act = "fa";
        header("Location: ../code-email.php?act=" . urlencode($act));
        exit;
    } else {
        select_code($pdo, $code, $email);
    }
}

function select_code($pdo, $code, $email) {
    try {
        $stmt = $pdo->prepare("SELECT code FROM `mail-inscription` WHERE email = :email");
        $stmt->execute([
            ":email" => $email
        ]);
        $code_in_bdd = $stmt->fetchColumn();
        is_code_right($pdo, $code, $code_in_bdd, $email);
    } catch (PDOException $e) {
        die("Erreur lors du prélevement en BDD : " . $e->getMessage());
    }
}

function is_code_right($pdo, $code, $code_in_bdd, $email) {
    if ($code != $code_in_bdd) {
        header("Location: ../code-email.php?act=" . urlencode("wc"));
        exit;
    } else {
        insert_data($pdo, $code, $email);
    }
}

function insert_data($pdo, $code, $email) {
    try {
        $stmt = $pdo->prepare("INSERT INTO users (email, since) VALUES (:email, :since)");
        $stmt->execute([
            ":email" => $email,
            ":since" => date("Y")
        ]);
        end_to();
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement en BDD : " . $e->getMessage());
    }
}

function end_to() {
    header("Location: ../inscr-mdp.php");
    exit;
}

check_csrf_token();