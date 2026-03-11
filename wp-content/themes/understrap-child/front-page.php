<?php
defined( 'ABSPATH' ) || exit;

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$cta         = get_field('cta_hero');
$hero_mobile = get_field('immagine_hero_mobile');

$args = [
    'container'   => $container,
    'cta'         => $cta,
    'hero_mobile' => $hero_mobile,
];

?>

<div id="front-page-wrapper">

    <!-- H1 SEO -->
    <h1 class="sr-only">
        Aiuto privati e aziende a risolvere problemi di comunicazione del brand
    </h1>

    <?php get_template_part('front-page/hero', 'desktop', $args); ?>
    <?php get_template_part('front-page/hero', 'tablet', $args); ?>
    <?php get_template_part('front-page/hero', 'mobile', $args); ?>
    
    <section class="<?php echo esc_attr($container); ?> mt-5">

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <h3 class="text-uppercase">
                    Una piccola selezione di progetti
                </h3>
                <p>“Ogni progetto è diverso ma alcuni li ricordo con grande affetto”</p>
            </div>

            <div class="col-12 col-lg-8 mb-3">

                <?php
                $progetti = new WP_Query([
                    'post_type'      => 'progetto',
                    'posts_per_page' => 3,
                    'no_found_rows'  => true,
                ]);

                if ( $progetti->have_posts() ) : ?>
                    <div class="progetti-listing">
                        <?php while ( $progetti->have_posts() ) : $progetti->the_post();
                            $categorie = get_the_terms(get_the_ID(), 'categoria-di-progetto');
                            $permalink = get_permalink();
                            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        ?>
                            <article class="progetto-card position-relative mb-3">

                                <?php if ( $thumbnail ) : ?>
                                    <div class="progetto-cover"
                                        style="background-image: url('<?php echo esc_url($thumbnail); ?>');">
                                    </div>
                                <?php endif; ?>

                                <div class="progetto-body bg-white py-3 px-4">

                                    <div class="progetto-meta d-flex align-items-center flex-wrap gap-2">

                                        <h2 class="progetto-titolo mb-0 pt-1">
                                            <a href="<?php echo esc_url($permalink); ?>" class="text-primary text-decoration-none stretched-link">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>

                                        <?php if ( !empty($categorie) && !is_wp_error($categorie) ) : ?>
                                            <div class="progetto-categorie d-flex flex-wrap gap-2">
                                                <?php foreach ( $categorie as $cat ) : ?>
                                                    <span class="progetto-tag badge rounded-pill border text-primary fw-normal">
                                                        <?php echo esc_html($cat->name); ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="progetto-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                </div>

                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                <?php else : ?>
                    <?php get_template_part('loop-templates/content', 'none'); ?>
                <?php endif; ?>

            </div>
        </div>

    </section>

</div>

<?php get_footer(); ?>