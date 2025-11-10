const input_field = document.getElementById("input-text");
const bouton = document.getElementById("submit-btn");

input_field.addEventListener('input', function() {
    const input = input_field.value;

    if (input !== "") {
        bouton.classList.add("clic");
    } else {
        bouton.classList.remove("clic");
    }
})

bouton.addEventListener('click', (e) => {
    if (!bouton.classList.contains('clic')) {
        e.preventDefault();
    }
})