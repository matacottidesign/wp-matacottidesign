<?php
$container   = $args['container'] ?? '';
$cta         = $args['cta'] ?? '';
$hero_mobile = $args['hero_mobile'] ?? '';
?>

<section class="hero hero-tablet d-none d-lg-block d-xxl-none">
    <div class="<?php echo esc_attr($container); ?> text-center">

        <div class="hero-title">
            <?php the_field('titolo_hero'); ?>
        </div>

        <?php
        if ( has_post_thumbnail() ) {
            echo get_the_post_thumbnail(
                get_the_ID(),
                'large',
                ['class' => 'img-fluid w-50 my-4']
            );
        }
        ?>

        <div class="hero-text fst-italic my-4">
            <?php the_field('descrizione_hero'); ?>
        </div>

        <section class="trustindex mt-3">
            <?php echo do_shortcode('[trustindex no-registration="google"]'); ?>
        </section>

    </div>
</section>