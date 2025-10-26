// ATTENDRE QUE LE DOM SOIT CHARGE !!!!

// CREER ANIM EN ATTENDANT QUE LE DOM CHARGE !!!!

const para_in_url = new URLSearchParams(window.location.search);
const act_in_url = para_in_url.get("act");

if (act_in_url === "df") {
    alert("Les mots de passe doivent être identiques.");
} else if (act_in_url === "cr") {
    alert("Tous les champs sont requis.");
}



const mdp_1_input = document.getElementById("mdpi1");
const mdp_2_input = document.getElementById("mdpi2");
const result1_r = document.getElementById("result1_r");
const result1_g = document.getElementById("result1_g");
const same_mdp = document.getElementById("same_mdp");
const send = document.getElementById("send");

const pre_res1_r = [
    "Votre mot de passe n'a pas de nombre",
    "Votre mot de passe n'a pas de majuscule",
    "Votre mot de passe n'a pas de caractère spécial",
    "Votre mot de passe est trop court (minimum 12 caractères)"
];
result1_r.innerHTML = pre_res1_r.join("<br>");

mdp_1_input.addEventListener("input", function() {
    const mdp_1 = mdp_1_input.value;
    
    const nb = /\d/.test(mdp_1);
    const maj = /[A-Z]/.test(mdp_1);
    const cara_spe = /[^A-Za-z0-9]/.test(mdp_1);

    const res1_g = [];
    const res1_r = [];


    if (nb) {
        res1_g.push("Votre mot de passe a un nombre");
    } else {
        res1_r.push("Votre mot de passe n'a pas de nombre");
    }

    if (maj) {
        res1_g.push("Votre mot de passe a une majuscule");
    } else {
        res1_r.push("Votre mot de passe n'a pas de majuscule");
    }

    if (cara_spe) {
        res1_g.push("Votre mot de passe a un caractère spécial");
    } else {
        res1_r.push("Votre mot de passe n'a pas de caractère spécial");
    }

    result1_g.innerHTML = res1_g.join("<br>");
    result1_r.innerHTML = res1_r.join("<br>");
    sessionStorage.setItem("value_mdp1", mdp_1);
    
    if (length(res1_g) === 3) {
        sessionStorage.setItem("val1", true);
    }

    const pre_res = [];
    const v_mdp2 = mdp_2_input.value;
    if (mdp_1 === v_mdp2) {
        pre_res.push("Mots de passe identiques");
        if (same_mdp.classList.contains("r")) {
            same_mdp.classList.remove("r");
        }
        same_mdp.classList.add("g");
    } else {
        pre_res.push("Mots de passe différents");
        if (same_mdp.classList.contains("g")) {
            same_mdp.classList.remove("g");
        }
        same_mdp.classList.add("r");
    }

    same_mdp.innerHTML = pre_res.join();
});

mdp_2_input.addEventListener("input", function() {
    const value_mdp1 = sessionStorage.getItem("value_mdp1");
    const mdp_2 = mdp_2_input.value;
    
    const res = [];
    if (value_mdp1 === mdp_2) {
        res.push("Mots de passe identiques");
        if (same_mdp.classList.contains("r")) {
            same_mdp.classList.remove("r");
        }
        same_mdp.classList.add("g");
    } else {
        res.push("Mots de passe différents");
        if (same_mdp.classList.contains("g")) {
            same_mdp.classList.remove("g");
        }
        same_mdp.classList.add("r");
    }

    same_mdp.innerHTML = res.join();
});

document.getElementById("mdp-form").addEventListener("submit", function(e) {
    const mdp_1_input = document.getElementById("mdpi1");
    const mdp_1 = mdp_1_input.value;

    const check_nb = /\d/.test(mdp_1);
    const check_maj = /[A-Z]/.test(mdp_1);
    const check_cara_spe = /[^A-Za-z0-9]/.test(mdp_1);
    const check_length = mdp_1.length;

    if (!check_nb || !check_maj || !check_cara_spe || check_length < 12) {
        e.preventDefault();
        alert("Votre mot de passe doit contenir au moins 12 caractères, une majuscule, un chiffre et un caractère spécial.");
    }
});