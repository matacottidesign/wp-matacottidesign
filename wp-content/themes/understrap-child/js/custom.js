document.addEventListener("DOMContentLoaded", function () {

    const nav = document.getElementById("main-nav");

    function toggleNavBackground() {
        if (window.scrollY > 0) {
            nav.classList.add("scrolled");
        } else {
            nav.classList.remove("scrolled");
        }
    }

    // Controllo iniziale (se ricarichi a metà pagina)
    toggleNavBackground();

    // Evento scroll
    window.addEventListener("scroll", toggleNavBackground);

});