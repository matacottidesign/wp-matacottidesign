<?php
/*
 * ============================================================
 * NAVBAR OFFCANVAS — BOOTSTRAP 5
 * ============================================================
 * Template della barra di navigazione principale.
 * Usa il componente Offcanvas di Bootstrap 5 per il menu mobile.
 * Viene incluso tramite get_template_part() dall'header del tema.
 * ============================================================
 *
 * @package Understrap
 * @since 1.1.0
 */

// Impedisce l'accesso diretto al file
defined( 'ABSPATH' ) || exit;

// Tipo di container Bootstrap (container o container-fluid)
$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav"
     class="navbar navbar-expand-xxl navbar-light fixed-top"
     aria-labelledby="main-nav-label">

    <?php /* Testo accessibile per screen reader */ ?>
    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
    </h2>

    <div class="<?php echo esc_attr( $container ); ?>">

        <?php /* Logo e nome del sito */ ?>
        <?php get_template_part( 'global-templates/navbar-branding' ); ?>

        <?php /* Pulsante hamburger per aprire l'offcanvas su mobile */ ?>
        <button
            class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#navbarNavOffcanvas"
            aria-controls="navbarNavOffcanvas"
            aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php /* Pannello offcanvas: scorre da destra su mobile */ ?>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarNavOffcanvas">

            <?php /* Header offcanvas con pulsante di chiusura */ ?>
            <div class="offcanvas-header justify-content-end">
                <button
                    class="btn-close btn-close-black text-reset"
                    type="button"
                    data-bs-dismiss="offcanvas"
                    aria-label="<?php esc_attr_e( 'Close menu', 'understrap' ); ?>">
                </button>
            </div>

            <?php /* Menu WordPress: carica la posizione "primary" */ ?>
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container_class' => 'offcanvas-body',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav justify-content-end flex-grow-1 pe-3',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                )
            );
            ?>

        </div>

    </div>

</nav>
