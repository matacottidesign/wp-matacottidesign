<?php
/*
 * ============================================================
 * HERO — VERSIONE DESKTOP (≥ 1400px)
 * ============================================================
 * Visibile solo su schermi xxl e superiori (Bootstrap 5: d-none d-xxl-flex).
 * Layout a tre colonne: testo | immagine + recensioni | servizi.
 *
 * Riceve i dati tramite $args passati da front-page.php:
 * - container: tipo di container Bootstrap
 * - cta: array ACF con url, title, target
 * ============================================================
 */

$container = $args['container'] ?? '';
$cta       = $args['cta']       ?? '';
?>

<section class="hero hero-desktop d-none d-xxl-flex">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div class="row align-items-start">

            <?php /* ---- COLONNA SINISTRA: titolo, descrizione e CTA ---- */ ?>
            <div class="col-4">

                <div class="hero-title">
                    <?php the_field( 'titolo_hero' ); ?>
                </div>

                <div class="hero-text fst-italic my-4">
                    <?php the_field( 'descrizione_hero' ); ?>
                </div>

                <?php if ( ! empty( $cta['url'] ) ) : ?>
                    <a class="btn btn-primary btn-lg rounded-pill d-inline-flex align-items-center"
                       href="<?php echo esc_url( $cta['url'] ); ?>"
                       target="<?php echo esc_attr( $cta['target'] ?: '_self' ); ?>">
                        <span class="me-3"><?php echo esc_html( $cta['title'] ); ?></span>
                        <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                <?php endif; ?>

            </div>

            <?php /* ---- COLONNA CENTRALE: foto in evidenza + recensioni Google ---- */ ?>
            <div class="col-4 text-center">

                <?php if ( has_post_thumbnail() ) : ?>
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'large', [
                        'class'         => 'img-fluid w-75',
                        'fetchpriority' => 'high',
                        'loading'       => 'eager',
                        'decoding'      => 'async',
                    ] ); ?>
                <?php endif; ?>

                <div class="trustindex mt-3">
                    <?php echo do_shortcode( '[trustindex no-registration="google"]' ); ?>
                </div>

            </div>

            <?php /* ---- COLONNA DESTRA: lista servizi con icone ---- */ ?>
            <div class="col-4">

                <?php if ( have_rows( 'servizi_hero' ) ) : ?>
                    <div class="servizi-hero">
                        <?php while ( have_rows( 'servizi_hero' ) ) : the_row(); ?>
                            <div class="servizio-item d-flex justify-content-end align-items-center">

                                <?php if ( $descrizione = get_sub_field( 'descrizione_servizio_hero' ) ) : ?>
                                    <div class="servizio-descrizione text-end">
                                        <?php echo wp_kses_post( $descrizione ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $image = get_sub_field( 'immagine_servizio_hero' ) ) : ?>
                                    <div class="servizio-img ms-4">
                                        <?php echo wp_get_attachment_image( $image['ID'], 'thumbnail', false, [
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                        ] ); ?>
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
