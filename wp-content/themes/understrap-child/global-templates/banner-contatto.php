<?php
/*
 * ============================================================
 * SIDEBAR CONTATTO — template part riutilizzabile
 * ============================================================
 * Replica il widget originale della pagina Contatti:
 * tagline → heading → foto → label → CTA mail.
 * Usato in page-contatti.php e single-progetto.php.
 *
 * Campi ACF richiesti sulla pagina "contatti":
 * - tagline_sidebar   (Text)  — es. "fai volare il tuo progetto"
 * - titolo_sidebar    (Text)  — es. "Prenota una consulenza gratuita al volo"
 * - immagine_sidebar  (Image) — la foto
 * - label_cta         (Text)  — es. "Preferisci scrivermi una mail?"
 * - link_cta_mail     (Link)  — { url: "mailto:...", title: "Raccontami il tuo progetto" }
 * ============================================================
 */

$contatti_page = get_page_by_path( 'contatti' );
$cid           = $contatti_page ? (int) $contatti_page->ID : 0;

$tagline  = $cid ? get_field( 'tagline_sidebar',  $cid ) : '';
$titolo   = $cid ? get_field( 'titolo_sidebar',   $cid ) : '';
$immagine = $cid ? get_field( 'immagine_sidebar', $cid ) : null;
$label    = $cid ? get_field( 'label_cta',        $cid ) : '';
$cta      = $cid ? get_field( 'link_cta_mail',    $cid ) : null;

$cta_url  = $cta ? $cta['url']   : 'mailto:' . get_option( 'admin_email' );
$cta_text = $cta ? $cta['title'] : 'Raccontami il tuo progetto';
?>

<div class="contatto-sidebar">

    <?php if ( $tagline ) : ?>
        <p class="contatto-sidebar-tagline"><?php echo esc_html( $tagline ); ?></p>
    <?php endif; ?>

    <?php if ( $titolo ) : ?>
        <h2 class="contatto-sidebar-titolo"><?php echo esc_html( $titolo ); ?></h2>
    <?php endif; ?>

    <?php if ( $immagine ) : ?>
        <div class="contatto-sidebar-foto"
             style="background-image: url('<?php echo esc_url( $immagine['url'] ); ?>');"
             role="img"
             aria-label="<?php echo esc_attr( $immagine['alt'] ); ?>">
        </div>
    <?php endif; ?>

    <?php if ( $label ) : ?>
        <p class="contatto-sidebar-label"><?php echo esc_html( $label ); ?></p>
    <?php endif; ?>

    <a class="btn btn-primary rounded-pill d-inline-flex align-items-center justify-content-between w-100"
       href="<?php echo esc_url( $cta_url ); ?>">
        <span class="ms-2"><?php echo esc_html( $cta_text ); ?></span>
        <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center ms-3">
            <i class="fa-solid fa-envelope"></i>
        </span>
    </a>

</div>
