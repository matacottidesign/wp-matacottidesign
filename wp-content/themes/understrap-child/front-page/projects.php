<section class="container-fluid mt-5">

    <div class="row">
        <div class="col-12 col-xl-4 mb-3 sticky-xl-top align-self-start" style="top:5.5rem;">

            <h3 class="text-uppercase fs-1">
                <?php echo esc_html( get_field('titolo_sezione_progetti') ); ?>
            </h3>

            <p class="fs-4 fst-italic">"<?php echo esc_html( get_field('descrizione_sezione_progetti') ); ?>"</p>

            <?php
            $image      = get_field('immagine_banner');
            $link       = get_field('link_banner');
            ?>

            <div class="d-none d-xl-flex banner-laterale overflow-hidden px-3 pb-3 pt-4 mt-4"
                <?php if ( !empty($image) ) : ?>
                    style="background-image: url('<?php echo esc_url($image['url']); ?>');"
                <?php endif; ?>>

                <div class="banner-laterale-title">
                    <?php echo esc_html(get_field('titolo_banner')); ?>
                </div>

                <?php if ( $link ) : ?>
                    <a class="btn btn-primary rounded-pill d-inline-flex align-items-center justify-content-between w-100"
                    href="<?php echo esc_url($link['url']); ?>"
                    target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                        <span class="ms-2"><?php echo esc_html($link['title']); ?></span>
                        <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center ms-3">
                            <i class="fa-solid fa-plane" style="color: var(--secondary);"></i>
                        </span>
                    </a>
                <?php endif; ?>

            </div>

        </div>

        <div class="col-12 col-xl-8 mb-3">

            <?php
            $progetti_in_evidenza = get_field('progetti_in_evidenza');
            if ( $progetti_in_evidenza ) : ?>
                <div class="progetti-listing">
                    <?php foreach ( $progetti_in_evidenza as $post ) :
                        setup_postdata($post);
                        $categorie = get_the_terms($post->ID, 'categoria-di-progetto');
                        $permalink = get_permalink();
                        $thumbnail = get_the_post_thumbnail_url($post->ID, 'full');
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
                                    <?php echo wp_trim_words(get_post_field('post_excerpt', $post->ID), 20, ''); ?>
                                </div>

                            </div>

                        </article>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

            <?php else : ?>
                <?php get_template_part('loop-templates/content', 'none'); ?>
            <?php endif; ?>

            <?php
            $image      = get_field('immagine_banner');
            $link       = get_field('link_banner');
            ?>

            <div class="d-flex d-xl-none banner-laterale overflow-hidden px-3 pb-3 pt-4 mt-4"
                <?php if ( !empty($image) ) : ?>
                    style="background-image: url('<?php echo esc_url($image['url']); ?>');"
                <?php endif; ?>>

                <div class="banner-laterale-title">
                    <?php echo esc_html(get_field('titolo_banner')); ?>
                </div>

                <?php if ( $link ) : ?>
                    <a class="btn btn-primary rounded-pill d-inline-flex align-items-center justify-content-between w-100"
                    href="<?php echo esc_url($link['url']); ?>"
                    target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                        <span class="ms-2"><?php echo esc_html($link['title']); ?></span>
                        <span class="cta-arrow bg-white rounded-circle d-flex align-items-center justify-content-center ms-3">
                            <i class="fa-solid fa-plane" style="color: var(--secondary);"></i>
                        </span>
                    </a>
                <?php endif; ?>

            </div>

        </div>
    </div>

</section>