<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function check_csrf_token() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (
            !isset($_POST['csrf_token_i_agree']) ||
            !hash_equals($_SESSION['csrf_token_i_agree'], $_POST['csrf_token_i_agree'])
        ) {
            http_response_code(403);
            exit;
        } else {
            init();
        }
    } else {
        http_response_code(403);
        exit;
    }
}

function init() {
    require "config.php";

    $email = $_SESSION['email_user'];

    $array_data = $_POST;
    $check_agree = $array_data["check_agree_doc"];
    if ($check_agree === TRUE) {
        try {
            $stmt = $pdo->prepare("UPDATE users SET ")
        }
    }
}


check_csrf_token();