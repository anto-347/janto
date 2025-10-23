let time_left = 60;
const countdown_aff = document.getElementById("countdown");
const lien = document.getElementById("lien_new_mail");

const timer = setInterval(function () {
    time_left--;

    countdown_aff.textContent = time_left;

    if (time_left <= 0) {
        clearInterval(timer);
        countdown_aff.textContent = 0;
        lien.classList.add("cliquable");
    }
}, 1000);

let para_in_url = new URLSearchParams(window.location.search);
let act_in_url = para_in_url.get("act");

if (act_in_url === "wc") {
    alert("Code erroné, veuillez réessayer.");
} else if (act_in_url === "fa") {
    alert("Tous les champs sont requis.");
}