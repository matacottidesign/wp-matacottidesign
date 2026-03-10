<?php
defined( 'ABSPATH' ) || exit;

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$cta         = get_field('cta_hero');
$hero_mobile = get_field('immagine_hero_mobile');

$args = [
    'container'   => $container,
    'cta'         => $cta,
    'hero_mobile' => $hero_mobile,
];

?>

<div id="front-page-wrapper">

    <!-- H1 SEO -->
    <h1 class="sr-only">
        Aiuto privati e aziende a risolvere problemi di comunicazione del brand
    </h1>

    <?php get_template_part('front-page/hero', 'desktop', $args); ?>
    <?php get_template_part('front-page/hero', 'tablet', $args); ?>
    <?php get_template_part('front-page/hero', 'mobile', $args); ?>

</div>

<?php get_footer(); ?>