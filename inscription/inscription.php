<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (empty($_SESSION['csrf_token_auth'])) {
    $_SESSION['csrf_token_auth'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token_auth'];
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <script src="https://kit.fontawesome.com/b2911a96f0.js" crossorigin="anonymous"></script>
</head>
<body id="page-inscription">
    <main>
        <section id="section">
            <div class="logo-div" id="logo-div">
                <img src="../assets/logo.png" alt="JanTo">
            </div>


            <div class="box-form" id="box-form">
                
                <div class="box-btn">
                    <div id="base-mobile" class="base-mobile"></div>
                    <button id="btn-i" class="btn-i">Inscription</button>
                    <button id="btn-c" class="btn-c">Connexion</button>
                </div>

                
                <form action="loader.php" method="POST" id="form-i" class="form-i">
                    <h4>Inscrivez-vous rapidement <br> en seulement 3 étapes !</h4>
                    
                    <div class="div-input">
                        <input type="email" name="email-i" id="email-i" required placeholder="">
                        <label for="email-i">Adresse e-mail</label>
                    </div>
                    <input type="hidden" name="csrf_token_auth" value="<?= htmlspecialchars($csrf) ?>">
                    <button type="submit" class="suiv_i">Suivant</button>
                    
                </form>


                <form action="loader-c.php" method="post" id="form-c" class="form-c">
                    <div class="div-c">
                        <h4>Heureux de vous revoir !</h4>
                        
                        <div class="div-input">
                            <input type="email" name="email-c" id="email-c" required placeholder="" class="ipt">
                            <label for="email-c" class="lbl">Adresse e-mail</label>
                        </div>
                        <div class="div-input">
                            <input type="password" name="password-c" id="passwordc" required placeholder="" class="ipt">
                            <label for="passwordc" class="lbl">Mot de passe</label>
                            <input type="checkbox" name="aperçu-mdp" id="tick-aperçu" onclick="passwordc.type = this.checked ? 'text' : 'password'">
                            <label for="tick-aperçu" class="lbl-aperçu">
                                <i class="fa-solid fa-eye"></i>
                                <i class="fa-solid fa-eye-slash"></i>
                            </label>
                        </div>
                        <div id="infos-sup">
                            <div class="div-check">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Rester connecté</label>
                            </div>
                            <a href="#">Mot de passe oublié</a>
                        </div>
                     

                        <input type="hidden" name="csrf_token_auth" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit">Connexion</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>