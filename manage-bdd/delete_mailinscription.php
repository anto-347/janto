<?php

use PHPMailer\PHPMailer\Exception;

require "../includes/config.php";

try {
    $sql = "TRUNCATE TABLE `mail-inscription`";
    $pdo->exec($sql);
    
    header("Location: index.html");
    exit;
} catch (PDOException $e) {
    die("erreur : " . $e->getMessage());
}