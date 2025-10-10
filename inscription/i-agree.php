<?php
if (empty($_SESSION['email_user'])) {
    header("Location: inscription.php");
    exit;
} elseif (empty($_SESSION['csrf_token_loader_mdp_i'])) {
    http_response_code(403);
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="i-agree.css">
</head>
<body>
    <main>
        <div class="box">
            <form action="">
                <p>
                    En m'inscrivant, je certifie avoir pris connaissance 
                    des <a href="../juridique/lst-juridique.html" target="_blank">documents juridiques</a>
                    à propos de l'utilisation de JanTo.
                </p>
                <input type="checkbox" required>
                <button type="submit">Je valide mon inscription</button>
            </form>
        </div>
    </main>
</body>
</html>