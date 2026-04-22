<?php
/*
 * ============================================================
 * TEMPLATE ARCHIVI (archive.php)
 * ============================================================
 * Mostra la lista dei post per categoria, tag, autore o data.
 * Layout a griglia: 2 colonne su schermi md e superiori.
 * ============================================================
 *
 * @package Understrap
 */

// Impedisce l'accesso diretto al file
defined( 'ABSPATH' ) || exit;

get_header();

// Tipo di container Bootstrap (impostabile dal customizer)
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <?php if ( have_posts() ) : ?>

                <?php /* Intestazione archivio: titolo e descrizione della tassonomia */ ?>
                <div class="col-12">
                    <header class="page-header">
                        <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="taxonomy-description">', '</div>' );
                        ?>
                    </header>
                </div>

                <?php /* Griglia post: 2 colonne su tablet e desktop */ ?>
                <div class="col-12">
                    <div class="row">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="col-md-6 mb-4">
                                <?php get_template_part( 'loop-templates/content', get_post_format() ); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

            <?php else : ?>

                <?php /* Nessun post trovato */ ?>
                <div class="col-12">
                    <?php get_template_part( 'loop-templates/content', 'none' ); ?>
                </div>

            <?php endif; ?>

            <?php /* Paginazione archivio */ ?>
            <div class="col-12">
                <?php understrap_pagination(); ?>
            </div>

            <?php /* Sidebar (se abilitata nelle impostazioni del tema) */ ?>
            <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

        </div>

    </div>

</div>

<?php get_footer(); ?>
