<?php
$container   = $args['container'] ?? '';
$cta         = $args['cta'] ?? '';
$hero_mobile = $args['hero_mobile'] ?? '';
?>

<section class="hero hero-tablet d-none d-md-block d-xxl-none">
    <div class="<?php echo esc_attr($container); ?> text-center">

        <div class="row align-items-end">

            <div class="col-6">
                <div class="hero-title">
                    <?php the_field('titolo_hero'); ?>
                </div>
                <div class="trustindex my-3">
                    <?php echo do_shortcode('[trustindex no-registration="google"]'); ?>
                </div>
                <?php if ( ! empty( $cta['url'] ) ) : ?>
                    <a class="btn btn-primary rounded-pill d-inline-flex align-items-center mb-5"
                    href="<?php echo esc_url($cta['url']); ?>"
                    target="<?php echo esc_attr($cta['target'] ?: '_self'); ?>">

                        <span class="me-3">
                            <?php echo esc_html($cta['title']); ?>
                        </span>

                        <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>

                    </a>
                <?php endif; ?>
            </div>

            <div class="col-6">
                <?php 
                $immagine_hero_mobile = get_field('immagine_hero_mobile');
                if( !empty( $immagine_hero_mobile ) ): ?>
                    <img src="<?php echo esc_url($immagine_hero_mobile['url']); ?>" alt="<?php echo esc_attr($immagine_hero_mobile['alt']); ?>" />
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>

<section class="container d-none d-md-block d-xxl-none">

    <div class="fst-italic fs-3 my-5">
        <?php the_field('descrizione_hero'); ?>
    </div>

    <?php if ( have_rows('servizi_hero') ) : ?>
        <div class="servizi-hero d-flex justify-content-evenly">
            <?php while ( have_rows('servizi_hero') ) : the_row(); ?>

                <div class="text-center fs-3">
                    <?php if ( $titolo_servizio = get_sub_field('titolo_servizio') ) : ?>
                        <strong><?php echo wp_kses_post($titolo_servizio); ?></strong>
                    <?php endif; ?>

                    <?php if ( $image = get_sub_field('immagine_servizio_hero') ) : ?>
                        <div class="servizio-img mt-3">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</section>