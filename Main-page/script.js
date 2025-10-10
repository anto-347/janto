// Barre de nav menu principal
const toggle = document.getElementById("menu-toggle");
const navItems = document.getElementById("nav-items");

toggle.addEventListener("click", (e) => {
    e.stopPropagation();
    if (navItems.classList.contains("reset")) {
        navItems.classList.remove("reset");
    }
    if (navItems.classList.contains("show")) {
        navItems.classList.remove("show");
        navItems.classList.add("hide");
        setTimeout(reset, 100);
    }
    else {
        navItems.classList.add("show");
    }
});

document.addEventListener("click", (e) => {
    const isClickInsideMenu = navItems.contains(e.target) || toggle.contains(e.target);
    if (!isClickInsideMenu && navItems.classList.contains("show")) {
        navItems.classList.remove("show");
        navItems.classList.add("hide");
        setTimeout(reset, 100);
    }
});

function reset() {
    if (navItems.classList.contains("hide")) {
        navItems.classList.remove("hide");
    }
    if (navItems.classList.contains("show")) {
        navItems.classList.remove("show");
    }

    navItems.classList.add("reset");
};


// Enlever l'anim hover sur les boutons (mobile)
document.querySelectorAll('.bouton-intra-div').forEach(btn => {
    btn.addEventListener('touchend', () => {
        btn.blur(); // Il faudra peut être rajouter un setTimeout
    });
});
