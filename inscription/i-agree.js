const para_in_url = new URLSearchParams(window.location.search);
const act_in_url = para_in_url.get("act");

if (act_in_url === "sd") {
    alert("Toutes nos excuses : nous avons rencontré une erreur soudaine. Veuillez réessayer.");
} else if (act_in_url === "pf") {
    alert("Veuillez accepter nos politiques pour être autorisé à utiliser JanTo");
}