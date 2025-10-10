<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (
        !isset($_POST['csrf_token_auth']) ||
        !hash_equals($_SESSION['csrf_token_auth'], $_POST['csrf_token_auth'])
    ) {
        http_response_code(403);
        exit;
    } else {
        if (empty($_SESSION['csrf_token_loader_i'])) {
            $_SESSION['csrf_token_loader_i'] = bin2hex(random_bytes(32));
            $_SESSION['form_data'] = $_POST;
        } else {
            http_response_code(403);
            exit;
        }
    }
} else {
    http_response_code(403);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="1,url=back/verifier-email.php">
    <title>Chargement...</title>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
    <div class="loader"></div>
</body>
</html>