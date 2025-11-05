function send_taille() {
    const page_content = document.getElementById("page");
    const width = window.innerWidth;
    const height = window.innerHeight;

    console.log(width);
    console.log(height);

    page_content.style.setProperty("--var-width-page", `${width}px`);
    page_content.style.setProperty("--var-height-page", `${height}px`);
}

send_taille();

window.addEventListener("resize", send_taille);