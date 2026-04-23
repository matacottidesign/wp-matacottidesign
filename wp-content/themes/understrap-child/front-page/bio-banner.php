<?php
/*
 * ============================================================
 * SEZIONE BIO BANNER — HOMEPAGE
 * ============================================================
 * Mostra un banner con sfondo fotografico, titolo, descrizione
 * e link CTA. Utilizza tre immagini di sfondo distinte per
 * desktop, tablet e mobile, con le relative classi Bootstrap.
 *
 * Campi ACF richiesti:
 * - background_banner_biografia_desktop
 * - background_banner_biografia_tablet
 * - background_banner_biografia_mobile
 * - titolo_banner_biografia
 * - descrizione_banner_biografia
 * - link_banner_biografia
 * ============================================================
 */

// Recupero dei campi ACF
$bg_desktop  = get_field( 'background_banner_biografia_desktop' );
$bg_tablet   = get_field( 'background_banner_biografia_tablet' );
$bg_mobile   = get_field( 'background_banner_biografia_mobile' );
$titolo      = get_field( 'titolo_banner_biografia' );
$descrizione = get_field( 'descrizione_banner_biografia' );
$link        = get_field( 'link_banner_biografia' );
?>

<?php /* ---- VERSIONE DESKTOP (≥ 1400px) ---- */ ?>
<?php if ( ! empty( $bg_desktop ) ) : ?>
    <section class="container-fluid">
        <div class="bio-banner position-relative d-none d-xxl-block px-5"
             style="background-image: url('<?php echo esc_url( $bg_desktop['url'] ); ?>');">
            <div class="row">
                <div class="col-12 col-md-5">

                    <?php if ( $titolo ) : ?>
                        <div class="bio-banner-title h1 text-white mt-5">
                            <?php echo wp_kses_post( $titolo ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $descrizione ) : ?>
                        <div class="bio-banner-description fs-4 text-white mb-5">
                            <?php echo wp_kses_post( $descrizione ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $link ) : ?>
                        <a class="btn btn-primary rounded-pill d-inline-flex align-items-center mb-5"
                           href="<?php echo esc_url( $link['url'] ); ?>"
                           target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>">
                            <span class="me-3"><?php echo esc_html( $link['title'] ); ?></span>
                            <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php /* ---- VERSIONE TABLET (768px – 1399px) ---- */ ?>
<?php if ( ! empty( $bg_tablet ) ) : ?>
    <section class="bio-banner position-relative d-none d-md-block d-xxl-none"
             style="background-image: url('<?php echo esc_url( $bg_tablet['url'] ); ?>');">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">

                    <?php if ( $titolo ) : ?>
                        <div class="bio-banner-title">
                            <?php echo wp_kses_post( $titolo ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $descrizione ) : ?>
                        <div class="bio-banner-description">
                            <?php echo wp_kses_post( $descrizione ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $link ) : ?>
                        <a class="btn btn-primary rounded-pill d-inline-flex align-items-center"
                           href="<?php echo esc_url( $link['url'] ); ?>"
                           target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>">
                            <span class="me-3"><?php echo esc_html( $link['title'] ); ?></span>
                            <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php /* ---- VERSIONE MOBILE (< 768px) ---- */ ?>
<?php if ( ! empty( $bg_mobile ) ) : ?>
    <section class="bio-banner position-relative d-block d-md-none"
             style="background-image: url('<?php echo esc_url( $bg_mobile['url'] ); ?>');">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <?php if ( $titolo ) : ?>
                        <div class="bio-banner-title my-5">
                            <?php echo wp_kses_post( $titolo ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $descrizione ) : ?>
                        <div class="bio-banner-description">
                            <?php echo wp_kses_post( $descrizione ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $link ) : ?>
                        <a class="btn btn-primary rounded-pill d-inline-flex align-items-center"
                           href="<?php echo esc_url( $link['url'] ); ?>"
                           target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>">
                            <span class="me-3"><?php echo esc_html( $link['title'] ); ?></span>
                            <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
