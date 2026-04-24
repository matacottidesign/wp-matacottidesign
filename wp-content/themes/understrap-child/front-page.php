<?php
/*
 * ============================================================
 * TEMPLATE HOMEPAGE (front-page.php)
 * ============================================================
 * Carica header, sezioni della home e footer.
 * I dati ACF comuni vengono recuperati qui e passati
 * alle sezioni hero tramite $args per evitare query ripetute.
 *
 * Struttura della pagina:
 * 1. H1 nascosto per SEO
 * 2. Hero (desktop / tablet / mobile)
 * 3. Sezione progetti in evidenza
 * 4. Bio banner
 * ============================================================
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Dati condivisi tra le varianti hero
$container   = get_theme_mod( 'understrap_container_type' );
$cta         = get_field( 'cta_hero' );
$hero_mobile = get_field( 'immagine_hero_mobile' );

$args = [
    'container'   => $container,
    'cta'         => $cta,
    'hero_mobile' => $hero_mobile,
];
?>

<main id="content" tabindex="-1">

    <?php /* H1 nascosto visivamente ma indicizzato dai motori di ricerca */ ?>
    <h1 class="sr-only">
        Aiuto privati e aziende a risolvere problemi di comunicazione del brand
    </h1>

    <?php /* Sezioni hero: una per breakpoint, una sola è visibile alla volta */ ?>
    <?php get_template_part( 'front-page/hero', 'desktop', $args ); ?>
    <?php get_template_part( 'front-page/hero', 'tablet', $args ); ?>
    <?php get_template_part( 'front-page/hero', 'mobile', $args ); ?>

    <?php /* Sezione progetti e bio banner */ ?>
    <?php get_template_part( 'front-page/projects' ); ?>
    <?php get_template_part( 'front-page/bio-banner' ); ?>

</main>

<?php get_footer(); ?>
