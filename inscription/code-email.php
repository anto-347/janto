<?php
session_start();
if (empty($_SESSION['email_user'])) {
    header("Location: inscription.php");
    exit;
} else {
    if (empty($_SESSION['csrf_token_code_email'])) {
        $_SESSION['csrf_token_code_email'] = bin2hex(random_bytes(32));
        $email = $_SESSION['email_user'];
    } else {
        http_response_code(403);
        exit;
    }
}
$csrf = $_SESSION['csrf_token_code_email'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier votre adresse email</title>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="code-email.css">
    <script src="code-email.js" defer></script>
</head>
<body>

    <form action="loader-code-email.php" method="post">
        <h2>Vérifiez votre email</h2>
        <h5>Un code a été envoyé à l'adresse <?php $email ?>, veuillez l'entrer ci-dessous.</h5>
        <h4>Ce code est valable pendant 10 minutes, après quoi il sera désactivé.</h4>
        <div>
            <input type="number" name="code" id="code" placeholder="Votre code" require>
        </div>

        <input type="hidden" name="csrf_token_code_email" value="<?= htmlspecialchars($csrf) ?>">
        <button type="submit">Vérifier</button>
        <a href="https://www.ecoledirecte.com" target="_blank" id="lien_new_mail" class="lien_new_mail">Renvoyer un code (<span id="countdown">60</span>s)</a>
    </form>

</body>
</html>