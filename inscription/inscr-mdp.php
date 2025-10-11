<?php
session_start();
if (empty($_SESSION['email_user'])) {
    header("Location: inscription.php");
    exit;
} else {
    if (empty($_SESSION['csrf_token_inscr_mdp'])) {
        $_SESSION['csrf_token_inscr_mdp'] = bin2hex(random_bytes(32));
    } else {
        http_response_code(403);
        exit;
    }
}
$csrf = $_SESSION['csrf_token_inscr_mdp'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créez votre mot de passe</title>
    <link rel="stylesheet" href="i-mdp.css">
    <script src="i-mdp.js" defer></script>
    <script src="https://kit.fontawesome.com/b2911a96f0.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
</head>
<body>
    <main>
        <div class="box-form">
            <img src="../assets/logo.png" alt="Logo">
            
            <form action="loader-mdp-i.php" method="post" id="mdp-form">
                <h2>Créez votre mot de passe</h2>
                <div class="mdp-1-div">
                    <input type="password" name="mdpi1" id="mdpi1" placeholder="" required>
                    <label for="mdpi1" class="lbl_ipt">Mot de passe</label>
                    <input type="checkbox" name="tick-aperçu1" id="tick-aperçu1" onclick="mdpi1.type = this.checked ? 'text' : 'password'">
                    
                    <label for="tick-aperçu1" class="lbl-aperçu">
                        <i class="fa-solid fa-eye"></i>
                        <i class="fa-solid fa-eye-slash"></i>
                   </label>

                </div>

                <p class="result1_r" id="result1_r"></p>
                <p class="result1_g" id="result1_g"></p>

                <div class="mdp-2-div">
                    <input type="password" name="mdpi2" id="mdpi2" placeholder="" required>
                    <label for="mdpi2" class="lbl_ipt">Confirmer votre mot de passe</label>
                    <input type="checkbox" name="tick-aperçu2" id="tick-aperçu2" onclick="mdpi2.type = this.checked ? 'text' : 'password'">
                    
                    <label for="tick-aperçu2" class="lbl-aperçu">
                        <i class="fa-solid fa-eye"></i>
                        <i class="fa-solid fa-eye-slash"></i>
                    </label>

                </div>
                <p class="same_mdp" id="same_mdp"></p>
                <input type="hidden" name="csrf_token_inscr_mdp" value="<?= htmlspecialchars($csrf) ?>">
                <button id="send">Suivant</button>
            </form>
        
        </div>
    </main>
</body>
</html>