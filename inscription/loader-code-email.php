<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (
        !isset($_POST['csrf_token_code_email']) ||
        !hash_equals($_SESSION['csrf_token_code_email'], $_POST['csrf_token_code_email'])
    ) {
        http_response_code(403);
        exit;
    } else {
        if (empty($_SESSION['csrf_token_loader_code_email'])) {
            $_SESSION['csrf_token_loader_code_email'] = bin2hex(random_bytes(32));
            $_SESSION['code-email'] = $_POST;
        } else {
            http_response_code(403);
            ext;
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
    <meta http-equiv="refresh" content="1,url=back/code-email.php">
    <title>Chargement...</title>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
    <div class="loader"></div>
</body>
</html>