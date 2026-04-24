<?php
// Impedisce l'accesso diretto al file
defined( 'ABSPATH' ) || exit;

/*
 * ============================================================
 * INCLUDE FILE DI SUPPORTO
 * ============================================================
 * Carica i file aggiuntivi del tema figlio:
 * - enqueue.php: registra Google Fonts, stili CSS e script JS
 * ============================================================
 */
require_once get_stylesheet_directory() . '/inc/enqueue.php';

/*
 * ============================================================
 * WORKAROUND: Font Awesome 5.1.3 + WordPress 6.9.1
 * ============================================================
 * Bug: font-awesome-block-editor dichiara font-awesome-official-admin
 * come dipendenza (hook enqueue_block_assets), ma quel handle viene
 * registrato solo condizionalmente su admin_enqueue_scripts (settings
 * FA, icon chooser attivo, ecc.). Sulle normali pagine di editing
 * la dipendenza non è mai registrata → WP 6.9.1 lancia il Notice.
 *
 * Fix: prima che Font Awesome registri font-awesome-block-editor
 * (priorità 10 su enqueue_block_assets), pre-registriamo
 * font-awesome-official-admin come placeholder (src = false).
 * - Se FA lo aveva già registrato su admin_enqueue_scripts: il check
 *   wp_script_is() è true, non facciamo nulla → FA funziona normalmente.
 * - Se FA non lo ha registrato: il placeholder soddisfa la dipendenza
 *   senza emettere output, eliminando il Notice.
 * ============================================================
 */
add_action( 'enqueue_block_assets', function () {
    if ( is_admin() && ! wp_script_is( 'font-awesome-official-admin', 'registered' ) ) {
        wp_register_script( 'font-awesome-official-admin', false, [], false, false );
    }
}, 1 );

/*
 * ============================================================
 * WIDGET AREA PERSONALIZZATE
 * ============================================================
 * Registra quattro sidebar usate come colonne sticky nei
 * rispettivi template: Home, Single, Bio, Contatti.
 * Supportano l'editor a blocchi (WordPress 5.8+).
 * ============================================================
 */
function child_register_sidebars() {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( $defaults + [
        'name'        => 'Widget Single Post',
        'id'          => 'sidebar-single',
        'description' => 'Colonna sticky nelle pagine singolo progetto.',
    ]);

    register_sidebar( $defaults + [
        'name'        => 'Widget Bio',
        'id'          => 'sidebar-bio',
        'description' => 'Colonna sticky nella pagina Biografia.',
    ]);

    register_sidebar( $defaults + [
        'name'        => 'Widget Contatti',
        'id'          => 'sidebar-contatti',
        'description' => 'Colonna sticky nella pagina Contatti.',
    ]);
}
add_action( 'widgets_init', 'child_register_sidebars' );

/*
 * ============================================================
 * FOOTER: rimuove le classi col-* automatiche di Understrap
 * ============================================================
 * Understrap aggiunge dinamicamente col-md-X a ogni widget
 * nella sidebar footerfull tramite il placeholder dynamic-classes.
 * Questo filtro, eseguito dopo il filtro del parent (priorità 20),
 * sostituisce il before_widget con uno senza classi colonna.
 * ============================================================
 */
/*
 * ============================================================
 * ARCHIVIO PROGETTI — INFINITE SCROLL
 * ============================================================
 */

// 6 post per pagina nell'archivio progetti (lato server)
add_action( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'progetto' ) ) {
        $query->set( 'posts_per_page', 6 );
    }
} );

// Enqueue script e dati solo sull'archivio progetti
add_action( 'wp_enqueue_scripts', function () {
    if ( ! is_post_type_archive( 'progetto' ) ) return;

    global $wp_query;

    $file = get_stylesheet_directory() . '/js/infinite-scroll.js';

    wp_enqueue_script(
        'md-infinite-scroll',
        get_stylesheet_directory_uri() . '/js/infinite-scroll.js',
        [],
        filemtime( $file ),
        true
    );

    wp_localize_script( 'md-infinite-scroll', 'infiniteScrollData', [
        'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
        'nonce'        => wp_create_nonce( 'load_more_progetti' ),
        'totalPosts'   => (int) $wp_query->found_posts,
        'initialCount' => (int) $wp_query->post_count,
    ] );
} );

// Handler AJAX per caricare altri progetti
add_action( 'wp_ajax_load_more_progetti',        'child_load_more_progetti' );
add_action( 'wp_ajax_nopriv_load_more_progetti', 'child_load_more_progetti' );

function child_load_more_progetti() {
    check_ajax_referer( 'load_more_progetti', 'nonce' );

    $offset   = max( 0, intval( $_POST['offset'] ?? 0 ) );
    $per_page = intval( $_POST['per_page'] ?? 6 );
    $per_page = in_array( $per_page, [ 4, 6 ], true ) ? $per_page : 6;

    $query = new WP_Query( [
        'post_type'      => 'progetto',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    ] );

    if ( ! $query->have_posts() ) {
        wp_send_json_success( [ 'html' => '' ] );
    }

    ob_start();
    while ( $query->have_posts() ) : $query->the_post();
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
        <?php
    endwhile;
    wp_reset_postdata();

    wp_send_json_success( [ 'html' => ob_get_clean() ] );
}

/*
 * ============================================================
 * COMMENTI — COMPLETAMENTE DISABILITATI
 * ============================================================
 * Portfolio senza blog: rimuove ogni traccia dei commenti dal
 * frontend, dall'admin e dai feed RSS.
 * ============================================================
 */
add_action( 'init', function () {
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
} );

// Chiude i commenti su tutti i post esistenti e futuri.
add_filter( 'comments_open',   '__return_false', 20, 2 );
add_filter( 'pings_open',      '__return_false', 20, 2 );
add_filter( 'comments_array',  '__return_empty_array', 20, 2 );

// Rimuove la voce Commenti dal menu laterale dell'admin.
add_action( 'admin_menu', function () {
    remove_menu_page( 'edit-comments.php' );
} );

// Rimuove il pallino dei commenti dalla barra superiore dell'admin.
add_action( 'admin_bar_menu', function ( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'comments' );
}, 999 );

// Reindirizza chiunque tenti di accedere direttamente alla pagina commenti.
add_action( 'admin_init', function () {
    global $pagenow;
    if ( $pagenow === 'edit-comments.php' ) {
        wp_safe_redirect( admin_url() );
        exit;
    }
} );

// Rimuove il feed RSS dei commenti.
add_action( 'template_redirect', function () {
    if ( is_comment_feed() ) {
        wp_safe_redirect( home_url(), 301 );
        exit;
    }
} );

/*
 * ============================================================
 * LCP — PRELOAD IMMAGINI HERO
 * ============================================================
 * Emette <link rel="preload"> per ogni breakpoint hero con media
 * query corrispondente: il browser preleva solo l'immagine visibile,
 * anticipando il fetch prima che il parser arrivi al <body>.
 * ============================================================
 */
add_action( 'wp_head', function() {
    if ( ! is_front_page() ) return;

    // Hero mobile e tablet condividono lo stesso campo ACF
    $hero_mobile = get_field( 'immagine_hero_mobile' );
    if ( ! empty( $hero_mobile['url'] ) ) {
        printf(
            '<link rel="preload" as="image" href="%s" media="(max-width:767px)" fetchpriority="high">' . "\n",
            esc_url( $hero_mobile['url'] )
        );
        printf(
            '<link rel="preload" as="image" href="%s" media="(min-width:768px) and (max-width:1399px)" fetchpriority="high">' . "\n",
            esc_url( $hero_mobile['url'] )
        );
    }

    // Hero desktop: post thumbnail della homepage
    $desktop_src = get_the_post_thumbnail_url( get_queried_object_id(), 'large' );
    if ( $desktop_src ) {
        printf(
            '<link rel="preload" as="image" href="%s" media="(min-width:1400px)" fetchpriority="high">' . "\n",
            esc_url( $desktop_src )
        );
    }
}, 1 );

/*
 * ============================================================
 * SEO — INDICIZZAZIONE E META TAG
 * ============================================================
 */

// Salvaguardia server-side: assicura che noindex non venga emesso
// anche in caso di configurazione errata futura in WP > Impostazioni > Lettura.
add_filter( 'wp_robots', function( $robots ) {
    unset( $robots['noindex'] );
    $robots['index']  = true;
    $robots['follow'] = true;
    return $robots;
} );

/*
 * ============================================================
 * FOOTER: rimuove le classi col-* automatiche di Understrap
 * ============================================================
 */
add_filter( 'dynamic_sidebar_params', function( $params ) {
    if ( isset( $params[0]['id'] ) && 'footerfull' === $params[0]['id'] ) {
        $params[0]['before_widget'] = '<div id="%1$s" class="widget %2$s">';
        $params[0]['after_widget']  = '</div>';
    }
    return $params;
}, 20 );
