<?php
$container   = $args['container'] ?? '';
$cta         = $args['cta'] ?? '';
$hero_mobile = $args['hero_mobile'] ?? '';
?>

<section class="hero hero-desktop d-none d-xxl-block">
    <div class="<?php echo esc_attr($container); ?>">
        <div class="row align-items-start">

            <!-- COLONNA SINISTRA -->
            <div class="col-4">
                <div class="hero-title">
                    <?php the_field('titolo_hero'); ?>
                </div>

                <div class="hero-text fst-italic my-4">
                    <?php the_field('descrizione_hero'); ?>
                </div>

                <?php if ( ! empty( $cta['url'] ) ) : ?>
                    <a class="btn btn-primary btn-lg rounded-pill d-inline-flex align-items-center"
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

            <!-- COLONNA CENTRALE -->
            <div class="col-4 text-center">
                <?php
                if ( has_post_thumbnail() ) {
                    echo get_the_post_thumbnail(
                        get_the_ID(),
                        'large',
                        ['class' => 'img-fluid w-75']
                    );
                }
                ?>
                <section class="trustindex mt-3">
                    <?php echo do_shortcode('[trustindex no-registration="google"]'); ?>
                </section>
            </div>

            <!-- COLONNA DESTRA -->
            <div class="col-4">
                <?php if ( have_rows('servizi_hero') ) : ?>
                    <div class="servizi-hero">
                        <?php while ( have_rows('servizi_hero') ) : the_row(); ?>
                            <div class="servizio-item d-flex justify-content-end align-items-center">

                                <?php if ( $descrizione = get_sub_field('descrizione_servizio_hero') ) : ?>
                                    <div class="servizio-descrizione text-end">
                                        <?php echo $descrizione; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $image = get_sub_field('immagine_servizio_hero') ) : ?>
                                    <div class="servizio-img ms-4">
                                        <img src="<?php echo esc_url($image['url']); ?>"
                                                alt="<?php echo esc_attr($image['alt']); ?>">
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>