<?php
/*
 * ============================================================
 * HERO — VERSIONE MOBILE (< 768px)
 * ============================================================
 * Visibile solo su schermi xs (Bootstrap 5: d-block d-md-none).
 * Layout verticale: immagine con overlay in alto, poi testo,
 * recensioni, lista servizi e CTA nella sezione sottostante.
 *
 * Riceve i dati tramite $args passati da front-page.php:
 * - container: tipo di container Bootstrap
 * - cta: array ACF con url, title, target
 * - hero_mobile: array ACF con l'immagine hero per mobile
 * ============================================================
 */

$container   = $args['container']  ?? '';
$cta         = $args['cta']        ?? '';
$hero_mobile = $args['hero_mobile'] ?? '';
?>

<section class="hero hero-mobile d-block d-md-none">

    <?php /* ---- BLOCCO IMMAGINE con overlay gradiente ---- */ ?>
    <div class="hero-mobile-bg d-flex align-items-end justify-content-center text-center position-relative">

        <?php if ( ! empty( $hero_mobile ) ) : ?>
            <img src="<?php echo esc_url( $hero_mobile['url'] ); ?>"
                 alt="<?php echo esc_attr( $hero_mobile['alt'] ); ?>"
                 class="position-absolute">
        <?php endif; ?>

        <div class="hero-title text-white pb-4">
            <?php the_field( 'titolo_hero' ); ?>
        </div>

    </div>

    <?php /* ---- BLOCCO CONTENUTO: recensioni, servizi, testo e CTA ---- */ ?>
    <div class="<?php echo esc_attr( $container ); ?> text-center py-3">

        <?php /* Recensioni Google */ ?>
        <div class="trustindex mb-4">
            <?php echo do_shortcode( '[trustindex no-registration="google"]' ); ?>
        </div>

        <?php /* Lista servizi: icona + titolo per ogni voce */ ?>
        <?php if ( have_rows( 'servizi_hero' ) ) : ?>
            <div class="servizi-hero d-flex justify-content-between flex-wrap">
                <?php while ( have_rows( 'servizi_hero' ) ) : the_row();
                    $titolo   = get_sub_field( 'titolo_servizio' );
                    $immagine = get_sub_field( 'immagine_servizio_hero' );
                ?>
                    <div class="servizio-item d-flex flex-column align-items-center text-center px-3 mb-4">

                        <?php if ( $titolo ) : ?>
                            <div class="servizio-titolo mb-3">
                                <strong><?php echo esc_html( $titolo ); ?></strong>
                            </div>
                        <?php endif; ?>

                        <?php if ( $immagine ) : ?>
                            <div class="servizio-img">
                                <img src="<?php echo esc_url( $immagine['url'] ); ?>"
                                     alt="<?php echo esc_attr( $immagine['alt'] ); ?>"
                                     class="img-fluid">
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php /* Testo descrittivo in corsivo */ ?>
        <div class="hero-text fst-italic mt-2 mb-4">
            <?php the_field( 'descrizione_hero' ); ?>
        </div>

        <?php /* CTA a larghezza piena con freccia */ ?>
        <?php if ( ! empty( $cta['url'] ) ) : ?>
            <a class="btn btn-primary ps-3 w-100 rounded-pill d-inline-flex justify-content-between align-items-center"
               href="<?php echo esc_url( $cta['url'] ); ?>"
               target="<?php echo esc_attr( $cta['target'] ?: '_self' ); ?>">
                <strong><?php echo esc_html( $cta['title'] ); ?></strong>
                <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </a>
        <?php endif; ?>

    </div>

</section>
