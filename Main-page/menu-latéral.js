document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById('toggleBtn');
    const barre_nav = document.getElementById('barre_nav');

    btn.addEventListener('click', () => {
        barre_nav.classList.toggle('active');
    });

    document.addEventListener("click", (e) => {
        const isClickInsideMenu = barre_nav.contains(e.target) || btn.contains(e.target);
        if (!isClickInsideMenu && barre_nav.classList.contains("active")) {
            barre_nav.classList.remove("active")
        }
    });
})