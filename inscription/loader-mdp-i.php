<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (
        !isset($_POST['csrf_token_inscr_mdp']) ||
        !hash_equals($_SESSION['csrf_token_inscr_mdp'], $_POST['csrf_token_inscr_mdp'])
    ) {
        http_response_code(403);
        exit;
    } else {
        if (empty($_SESSION['csrf_token_loader_mdp_i'])) {
            $_SESSION['csrf_token_loadder_mdp_i'] = bin2hex(random_bytes(32));
            $_SESSION["mdp-i"] = $_POST;
            $try = $_SESSION['mdp-i'];
            $mdp1 = $try["mdp1"];
            $mdp2 = $try["mdp2"];
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
    <meta http-equiv="refresh" content="1,url=back/def_mdp.php">
    <title>Chargement...</title>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
    <div class="loader"></div>
</body>
</html>