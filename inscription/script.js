// Activer le bon paramètre
if (document.body.id === "page-principale-index") {
    const vers_inscription = document.getElementById("inscription-btn");
    const vers_connexion = document.getElementById("connexion-btn");
    vers_inscription.addEventListener("click", (e) => {
        sessionStorage.setItem("action", "inscription");
        window.location.href = "inscription/inscription.php";
    });

    vers_connexion.addEventListener("click", () => {
        sessionStorage.setItem("action", "connexion");
        window.location.href = "inscription/inscription.php";
    });
}


// Afficher le bon affichage en fonction du paramètre
if (document.body.id === "page-inscription") {

    // Modifier aperçu avec btn de contrôle
    const form_c = document.getElementById("form-c");
    const para_inscription = document.getElementById("btn-i");
    const para_connexion = document.getElementById("btn-c");
    const form_i = document.getElementById("form-i");
    const img = document.getElementById("logo-div");
    const form = document.getElementById("box-form");
 


    const para_in_url = new URLSearchParams(window.location.search);
    const act_in_url = para_in_url.get("act");

    if (act_in_url === "co" || act_in_url === "in" || act_in_url === "wp") {
        if (act_in_url === "co" || act_in_url === "wp") {
            para_connexion.classList.add("active");
            form_c.classList.add("active");
            document.title = "JanTo - Connexion";
            sessionStorage.clear("action");
            sessionStorage.setItem("action", "co");
            if (act_in_url === "co") {
                alert("Vous avez déjà un compte, connectez-vous.");
            } else {
                alert("Adresse email ou mot de passe invalide.");
            }
        } else {
            para_inscription.classList.add("active");
            form_i.classList.add("active");
            img.classList.add("right");
            form.classList.add("left");
            document.title = "JanTo - Inscription";
            sessionStorage.clear("action");
            alert("Vous n'avez pas encore de compte, inscrivez-vous.");
        }

    } else {
        const action = sessionStorage.getItem("action");
        if (action == "inscription") {
            para_inscription.classList.add("active");
            form_i.classList.add("active");
            img.classList.add("right");
            form.classList.add("left");
            document.title = "JanTo - Inscription";
        } else if (action == "connexion") {
            para_connexion.classList.add("active");
            form_c.classList.add("active");
            document.title = "JanTo - Connexion";
        } else {
            para_inscription.classList.add("active");
            form_i.classList.add("active");
            img.classList.add("right");
            form.classList.add("left");
            document.title = "JanTo - Inscription";
        }
    }

    para_inscription.addEventListener("click", () => {
        if (!para_inscription.classList.contains("active")) {
            if (para_connexion.classList.contains("active")) {
                para_connexion.classList.remove("active");
            }
            if (form_c.classList.contains("active")) {
                form_c.classList.remove("active");
            }
            img.classList.toggle("right");
            form.classList.toggle("left");
            para_inscription.classList.add("active");
            form_i.classList.add("active");
            document.title = "JanTo - Inscription";
        }
    });

    para_connexion.addEventListener("click", () => {
        if (!para_connexion.classList.contains("active")) {
            if (para_inscription.classList.contains("active")) {
                para_inscription.classList.remove("active");
            }
            if (form_i.classList.contains("active")) {
                form_i.classList.remove("active");
            }
            img.classList.toggle("right");
            form.classList.toggle("left");
            para_connexion.classList.add("active");
            form_c.classList.add("active");
            document.title = "JanTo - Connexion";
        }
    });


    // Récupérer width section et l'envoyer à CSS
   
    function send_width() {
        const sec = document.getElementById("section");
        const width = sec.offsetWidth;
        sec.style.setProperty("--var-width-sec", `${width}px`);
    }

    send_width()

    window.addEventListener("resize", send_width);
}