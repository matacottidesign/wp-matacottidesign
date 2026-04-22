/*
 * ============================================================
 * SCRIPT PERSONALIZZATI — TEMA FIGLIO
 * ============================================================
 * Gestisce i comportamenti JavaScript del tema:
 * - Effetto glassmorphism sulla navbar allo scroll
 * ============================================================
 */

document.addEventListener("DOMContentLoaded", function () {

    const nav = document.getElementById("main-nav");

    /*
     * Aggiunge o rimuove la classe "scrolled" sulla navbar
     * in base alla posizione di scroll verticale della pagina.
     * La classe "scrolled" attiva lo sfondo frosted glass via CSS.
     */
    function toggleNavBackground() {
        if (window.scrollY > 0) {
            nav.classList.add("scrolled");
        } else {
            nav.classList.remove("scrolled");
        }
    }

    // Esegue al caricamento per gestire il caso di pagina ricaricata a metà scroll
    toggleNavBackground();

    // Aggiorna la navbar ad ogni evento di scroll
    window.addEventListener("scroll", toggleNavBackground);

});
