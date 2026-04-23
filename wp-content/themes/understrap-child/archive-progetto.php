<?php
/*
 * ============================================================
 * TEMPLATE ARCHIVIO PROGETTI (archive-progetto.php)
 * ============================================================
 * Lista di tutti i progetti pubblicati.
 * Usa lo stesso markup e stili delle card in evidenza in home.
 * ============================================================
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="archive-progetto-wrapper">

    <section class="container mt-5">

        <?php if ( have_posts() ) : ?>

            <div class="row">

                <?php /* ---- Intestazione archivio ---- */ ?>
                <div class="col-12 mb-4">
                    <h1 class="text-uppercase fs-1">
                        <?php post_type_archive_title(); ?>
                    </h1>
                </div>

                <?php /* ---- Griglia progetti: 2 colonne ---- */ ?>
                <div class="col-12">

                    <div class="row progetti-listing">

                        <?php while ( have_posts() ) : the_post();

                            $categorie = get_the_terms( get_the_ID(), 'categoria-di-progetto' );
                            $permalink = get_permalink();
                            $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        ?>

                            <div class="col-12 col-md-6 mb-3">

                                <article class="progetto-card position-relative h-100">

                                    <?php if ( $thumbnail ) : ?>
                                        <div class="progetto-cover"
                                             style="background-image: url('<?php echo esc_url( $thumbnail ); ?>');">
                                        </div>
                                    <?php endif; ?>

                                    <div class="progetto-body bg-white py-3 px-4">

                                        <div class="progetto-meta d-flex align-items-center flex-wrap gap-2">

                                            <h2 class="progetto-titolo mb-0 pt-1">
                                                <a href="<?php echo esc_url( $permalink ); ?>"
                                                   class="text-primary text-decoration-none stretched-link">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>

                                            <?php if ( ! empty( $categorie ) && ! is_wp_error( $categorie ) ) : ?>
                                                <div class="progetto-categorie d-flex flex-wrap gap-2">
                                                    <?php foreach ( $categorie as $cat ) : ?>
                                                        <span class="progetto-tag badge rounded-pill border text-primary fw-normal">
                                                            <?php echo esc_html( $cat->name ); ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                        <div class="progetto-excerpt">
                                            <?php echo wp_trim_words( get_post_field( 'post_excerpt', get_the_ID() ), 20, '' ); ?>
                                        </div>

                                    </div>

                                </article>

                            </div>

                        <?php endwhile; ?>

                    </div>

                    <div id="infinite-sentinel"></div>

                </div>

            </div>

        <?php else : ?>

            <?php get_template_part( 'loop-templates/content', 'none' ); ?>

        <?php endif; ?>

    </section>

</div>

<?php get_footer(); ?>
