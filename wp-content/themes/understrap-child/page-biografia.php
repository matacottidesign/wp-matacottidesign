<?php
/*
 * Template Name: Pagina Biografia
 * ============================================================
 * TEMPLATE PAGINA BIOGRAFIA (page-biografia.php)
 * ============================================================
 * Layout a due colonne:
 * - Sinistra (8/12): titolo e contenuto della pagina
 * - Destra (4/12, sticky): Widget Bio gestito da Aspetto › Widget
 * ============================================================
 */

defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="biografia-wrapper">

    <section class="container mt-5">
        <div class="row">

            <?php /* ---- COLONNA PRINCIPALE: contenuto pagina ---- */ ?>
            <div class="col-12 col-xl-8 mb-5">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <h1 class="text-uppercase fs-1 mb-4">
                        <?php the_title(); ?>
                    </h1>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                <?php endwhile; endif; ?>

            </div>

            <?php /* ---- COLONNA LATERALE: Widget Bio sticky ---- */ ?>
            <div class="col-12 col-xl-4 sticky-xl-top align-self-start" style="top: 5.5rem;">
                <?php dynamic_sidebar( 'sidebar-bio' ); ?>
            </div>

        </div>
    </section>

</div>

<?php get_footer(); ?>
