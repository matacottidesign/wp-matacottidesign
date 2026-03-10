<?php
$container   = $args['container'] ?? '';
$cta         = $args['cta'] ?? '';
$hero_mobile = $args['hero_mobile'] ?? '';
?>

<section class="hero hero-mobile d-block d-md-none bg-white mb-3">

    <div class="hero-mobile-bg d-flex align-items-end justify-content-center text-center position-relative">

        <?php 
        $immagine_hero_mobile = get_field('immagine_hero_mobile');
        if( !empty( $immagine_hero_mobile ) ): ?>
            <img src="<?php echo esc_url($immagine_hero_mobile['url']); ?>" 
                alt="<?php echo esc_attr($immagine_hero_mobile['alt']); ?>"
                class="position-absolute" />
        <?php endif; ?>

        <div class="hero-title text-white pb-4">
            <?php the_field('titolo_hero'); ?>
        </div>

    </div>

    <div class="<?php echo esc_attr($container); ?> text-center py-3">

        <section class="trustindex mb-4">
            <?php echo do_shortcode('[trustindex no-registration="google"]'); ?>
        </section>

        <?php if ( have_rows('servizi_hero') ) : ?>

            <div class="servizi-hero d-flex justify-content-between flex-wrap">

                <?php while ( have_rows('servizi_hero') ) : the_row();

                    $titolo   = get_sub_field('titolo_servizio');
                    $immagine = get_sub_field('immagine_servizio_hero');

                ?>

                    <div class="servizio-item d-flex flex-column align-items-center text-center px-3 mb-4">

                        <?php if ( $titolo ) : ?>
                            <div class="servizio-titolo mb-3">
                                <strong><?php echo esc_html($titolo); ?></strong>
                            </div>
                        <?php endif; ?>

                        <?php if ( $immagine ) : ?>
                            <div class="servizio-img">
                                <img 
                                    src="<?php echo esc_url($immagine['url']); ?>" 
                                    alt="<?php echo esc_attr($immagine['alt']); ?>"
                                    class="img-fluid"
                                >
                            </div>
                        <?php endif; ?>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php endif; ?>

        <div class="hero-text fst-italic mt-2 mb-4">
            <?php the_field('descrizione_hero'); ?>
        </div>

        <?php if ( ! empty( $cta['url'] ) ) : ?>
            <a class="btn btn-primary ps-3 w-100 rounded-pill d-inline-flex justify-content-between align-items-center"
            href="<?php echo esc_url($cta['url']); ?>"
            target="<?php echo esc_attr($cta['target'] ?: '_self'); ?>">

                <strong><?php echo esc_html($cta['title']); ?></strong>

                <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>

            </a>
        <?php endif; ?>


    </div>

</section>