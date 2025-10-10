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