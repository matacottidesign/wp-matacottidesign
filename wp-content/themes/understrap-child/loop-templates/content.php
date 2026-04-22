<?php
/*
 * ============================================================
 * TEMPLATE SINGOLO POST — LOOP (content.php)
 * ============================================================
 * Renderizza un singolo articolo all'interno del loop WordPress.
 * Utilizzato da archive.php e da altri template che richiamano
 * get_template_part('loop-templates/content').
 * ============================================================
 *
 * @package Understrap
 */

// Impedisce l'accesso diretto al file
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php /* Intestazione: titolo con link permalink e data di pubblicazione */ ?>
    <header class="entry-header">

        <?php
        the_title(
            sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h2>'
        );
        ?>

        <?php /* Metadati visibili solo per i post (non per le pagine) */ ?>
        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php understrap_posted_on(); ?>
            </div>
        <?php endif; ?>

    </header>

    <?php /* Immagine in evidenza del post */ ?>
    <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>

    <?php /* Estratto del post con eventuale link "leggi tutto" */ ?>
    <div class="entry-content">
        <?php
        the_excerpt();
        understrap_link_pages();
        ?>
    </div>

    <?php /* Footer: categorie, tag e altri metadati */ ?>
    <footer class="entry-footer">
        <?php understrap_entry_footer(); ?>
    </footer>

</article>
