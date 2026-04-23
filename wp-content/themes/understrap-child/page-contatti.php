<?php
/*
 * ============================================================
 * TEMPLATE PAGINA CONTATTI (page-contatti.php)
 * ============================================================
 * Layout a due colonne:
 * - Sinistra (8/12): form di prenotazione Amelia
 * - Destra (4/12, sticky): banner contatto con CTA mail
 * ============================================================
 */

defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="contatti-wrapper">

    <section class="container mt-5">
        <div class="row">

            <?php /* ---- COLONNA PRINCIPALE: form Amelia ---- */ ?>
            <div class="col-12 col-xl-8 mb-5">

                <h1 class="text-uppercase fs-1 mb-4">
                    <?php the_title(); ?>
                </h1>

                <?php echo do_shortcode( '[ameliastepbooking layout=1]' ); ?>

            </div>

            <?php /* ---- COLONNA LATERALE: Widget Contatti sticky ---- */ ?>
            <div class="col-12 col-xl-4 sticky-xl-top align-self-start" style="top: 5.5rem;">
                <?php dynamic_sidebar( 'sidebar-contatti' ); ?>
            </div>

        </div>
    </section>

</div>

<?php get_footer(); ?>
