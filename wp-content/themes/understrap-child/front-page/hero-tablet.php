<?php
/*
 * ============================================================
 * HERO — VERSIONE TABLET (768px – 1399px)
 * ============================================================
 * Visibile su schermi da md a xl (Bootstrap 5: d-none d-md-block d-xxl-none).
 * Layout a due colonne: testo a sinistra, immagine a destra.
 * Sotto la riga principale: descrizione e lista servizi orizzontale.
 *
 * Riceve i dati tramite $args passati da front-page.php:
 * - container: tipo di container Bootstrap
 * - cta: array ACF con url, title, target
 * - hero_mobile: array ACF con immagine per schermi piccoli
 * ============================================================
 */

$container   = $args['container'] ?? '';
$cta         = $args['cta']       ?? '';
$hero_mobile = $args['hero_mobile'] ?? '';
?>

<?php /* ---- RIGA PRINCIPALE: titolo + immagine ---- */ ?>
<section class="hero hero-tablet d-none d-md-block d-xxl-none">
    <div class="<?php echo esc_attr( $container ); ?> text-center">

        <div class="row align-items-end">

            <?php /* Colonna sinistra: titolo, recensioni e CTA */ ?>
            <div class="col-6">

                <div class="hero-title">
                    <?php the_field( 'titolo_hero' ); ?>
                </div>

                <div class="trustindex my-3">
                    <?php echo do_shortcode( '[trustindex no-registration="google"]' ); ?>
                </div>

                <?php if ( ! empty( $cta['url'] ) ) : ?>
                    <a class="btn btn-primary rounded-pill d-inline-flex align-items-center mb-5"
                       href="<?php echo esc_url( $cta['url'] ); ?>"
                       target="<?php echo esc_attr( $cta['target'] ?: '_self' ); ?>">
                        <span class="me-3"><?php echo esc_html( $cta['title'] ); ?></span>
                        <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                <?php endif; ?>

            </div>

            <?php /* Colonna destra: immagine hero */ ?>
            <div class="col-6">
                <?php if ( ! empty( $hero_mobile ) ) : ?>
                    <?php echo wp_get_attachment_image( $hero_mobile['ID'], 'large', false, [
                        'class'         => 'img-fluid',
                        'fetchpriority' => 'high',
                        'loading'       => 'eager',
                        'decoding'      => 'async',
                    ] ); ?>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>

<?php /* ---- SEZIONE SECONDARIA: descrizione + servizi ---- */ ?>
<section class="container d-none d-md-block d-xxl-none">

    <div class="fst-italic fs-3 my-5">
        <?php the_field( 'descrizione_hero' ); ?>
    </div>

    <?php if ( have_rows( 'servizi_hero' ) ) : ?>
        <div class="servizi-hero d-flex justify-content-evenly">
            <?php while ( have_rows( 'servizi_hero' ) ) : the_row(); ?>

                <div class="text-center fs-3">

                    <?php if ( $titolo_servizio = get_sub_field( 'titolo_servizio' ) ) : ?>
                        <strong><?php echo wp_kses_post( $titolo_servizio ); ?></strong>
                    <?php endif; ?>

                    <?php if ( $image = get_sub_field( 'immagine_servizio_hero' ) ) : ?>
                        <div class="servizio-img mt-3">
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

</section>
