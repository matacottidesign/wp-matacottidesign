<?php
/*
 * ============================================================
 * REGISTRAZIONE STILI E SCRIPT — TEMA FIGLIO
 * ============================================================
 * Questo file sovrascrive la funzione understrap_scripts()
 * del tema padre, gestendo in modo centralizzato:
 * - Google Fonts
 * - CSS del tema padre e figlio
 * - jQuery e script Bootstrap
 * - Script personalizzati del tema figlio
 * ============================================================
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_scripts' ) ) {

    function understrap_scripts() {

        // Dati del tema attivo (nome, versione, variante Bootstrap)
        $the_theme         = wp_get_theme();
        $theme_version     = $the_theme->get( 'Version' );
        $bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
        $suffix            = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        /*
        |--------------------------------------------------------------------------
        | CSS DEL TEMA PADRE
        | Seleziona il file CSS corretto in base alla versione Bootstrap attiva.
        | Google Fonts è rimosso dalle dipendenze perché caricato in modo
        | asincrono via wp_head (vedi md_google_fonts_async sotto).
        |--------------------------------------------------------------------------
        */
        $theme_styles  = "/css/theme{$suffix}.css";
        $theme_scripts = "/js/theme{$suffix}.js";

        if ( 'bootstrap4' === $bootstrap_version ) {
            $theme_styles  = "/css/theme-bootstrap4{$suffix}.css";
            $theme_scripts = "/js/theme-bootstrap4{$suffix}.js";
        }

        $css_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_styles );

        wp_enqueue_style(
            'understrap-styles',
            get_template_directory_uri() . $theme_styles,
            array(),
            $css_version
        );

        /*
        |--------------------------------------------------------------------------
        | CSS DEL TEMA FIGLIO
        | Carica style.css del tema figlio dopo il CSS del padre
        |--------------------------------------------------------------------------
        */
        if ( is_child_theme() ) {
            wp_enqueue_style(
                'understrap-child-styles',
                get_stylesheet_uri(),
                array( 'understrap-styles' ),
                filemtime( get_stylesheet_directory() . '/style.css' )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FIX OFFCANVAS + ADMIN BAR
        | Aggiunge stile inline per evitare sovrapposizione con la admin bar
        |--------------------------------------------------------------------------
        */
        if ( 'bootstrap4' !== $bootstrap_version && is_admin_bar_showing() ) {
            understrap_offcanvas_admin_bar_inline_styles();
        }

        /*
        |--------------------------------------------------------------------------
        | JQUERY E SCRIPT DEL TEMA PADRE
        |--------------------------------------------------------------------------
        */
        wp_enqueue_script( 'jquery' );

        $js_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_scripts );

        wp_enqueue_script(
            'understrap-scripts',
            get_template_directory_uri() . $theme_scripts,
            array( 'jquery' ),
            $js_version,
            true
        );

        /*
        |--------------------------------------------------------------------------
        | SCRIPT PERSONALIZZATI DEL TEMA FIGLIO
        | Carica js/custom.js se presente nella directory del tema figlio
        |--------------------------------------------------------------------------
        */
        if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/js/custom.js' ) ) {
            wp_enqueue_script(
                'md-custom-script',
                get_stylesheet_directory_uri() . '/js/custom.js',
                array( 'jquery' ),
                filemtime( get_stylesheet_directory() . '/js/custom.js' ),
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SCRIPT RISPOSTE AI COMMENTI
        | Necessario solo su post singoli con commenti annidati attivi
        |--------------------------------------------------------------------------
        */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );


/*
 * ============================================================
 * GOOGLE FONTS — CARICAMENTO ASINCRONO (non bloccante)
 * ============================================================
 * Il pattern rel="preload" + onload="this.rel='stylesheet'" carica
 * il foglio di stile senza bloccare il rendering della pagina.
 * Il tag <noscript> garantisce il fallback per browser senza JS.
 * I due <link rel="preconnect"> riducono il DNS lookup time.
 * ============================================================
 */
add_action( 'wp_head', function() {
    $fonts_url = 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap';
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="<?php echo esc_url( $fonts_url ); ?>" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="<?php echo esc_url( $fonts_url ); ?>"></noscript>
    <?php
}, 1 );

/*
 * ============================================================
 * SCRIPT DEFER — Bootstrap JS e script tema figlio
 * ============================================================
 * Aggiunge l'attributo defer agli script non critici caricati
 * nel footer: il browser li scarica in parallelo ma li esegue
 * solo dopo il parsing del documento.
 * jQuery è escluso per compatibilità con i plugin.
 * ============================================================
 */
add_filter( 'script_loader_tag', function( $tag, $handle ) {
    $defer_handles = [ 'understrap-scripts', 'md-custom-script', 'md-infinite-scroll' ];
    if ( in_array( $handle, $defer_handles, true ) ) {
        return str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}, 10, 2 );

/*
 * ============================================================
 * FIX OFFCANVAS + ADMIN BAR
 * ============================================================
 * Aggiunge stile inline per correggere la sovrapposizione
 * tra l'offcanvas e la barra di amministrazione di WordPress.
 * ============================================================
 */
if ( ! function_exists( 'understrap_offcanvas_admin_bar_inline_styles' ) ) {

    function understrap_offcanvas_admin_bar_inline_styles() {

        $navbar_type = get_theme_mod( 'understrap_navbar_type', 'collapse' );

        if ( 'offcanvas' !== $navbar_type ) {
            return;
        }

        $css = '
        body.admin-bar .offcanvas.show {
            margin-top: 32px;
        }
        @media screen and ( max-width: 782px ) {
            body.admin-bar .offcanvas.show {
                margin-top: 46px;
            }
        }';

        wp_add_inline_style( 'understrap-styles', $css );
    }
}
