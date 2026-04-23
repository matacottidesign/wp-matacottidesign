<?php
/*
 * ============================================================
 * TEMPLATE SINGLE PROGETTO (single-progetto.php)
 * ============================================================
 * Layout a due colonne:
 * - Sinistra (8/12): contenuto del progetto
 * - Destra (4/12, sticky): banner contatto con CTA mail
 * ============================================================
 */

defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-progetto-wrapper">

    <section class="container mt-5">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="row">

                <?php /* ---- COLONNA PRINCIPALE: contenuto progetto ---- */ ?>
                <div class="col-12 col-xl-8 mb-5">

                    <?php /* Immagine di copertina */ ?>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="progetto-cover mb-4"
                             style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>');">
                        </div>
                    <?php endif; ?>

                    <?php /* Badge categorie */ ?>
                    <?php
                    $categorie = get_the_terms( get_the_ID(), 'categoria-di-progetto' );
                    if ( ! empty( $categorie ) && ! is_wp_error( $categorie ) ) :
                    ?>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <?php foreach ( $categorie as $cat ) : ?>
                                <span class="progetto-tag badge rounded-pill border text-primary fw-normal">
                                    <?php echo esc_html( $cat->name ); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="text-uppercase fs-1 mb-4">
                        <?php the_title(); ?>
                    </h1>

                    <hr>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $recenti = new WP_Query([
                        'post_type'      => 'progetto',
                        'posts_per_page' => 2,
                        'post__not_in'   => [ get_the_ID() ],
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ]);

                    if ( $recenti->have_posts() ) :
                    ?>

                    <hr class="mt-5">

                    <h2 class="text-uppercase mt-4 mb-4">Progetti recenti</h2>

                    <div class="row">

                        <?php while ( $recenti->have_posts() ) : $recenti->the_post();

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

                        <?php endwhile; wp_reset_postdata(); ?>

                    </div>

                    <?php endif; ?>

                </div>

                <?php /* ---- COLONNA LATERALE: Widget Single Post sticky ---- */ ?>
                <div class="col-12 col-xl-4 sticky-xl-top align-self-start" style="top: 5.5rem;">
                    <?php dynamic_sidebar( 'sidebar-single' ); ?>
                </div>

            </div>

        <?php endwhile; endif; ?>

    </section>

</div>

<?php get_footer(); ?>
