<?php
/**
 * Enqueue scripts and styles (Child theme ready)
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_scripts' ) ) {

	function understrap_scripts() {

		// Theme data.
		$the_theme         = wp_get_theme();
		$theme_version     = $the_theme->get( 'Version' );
		$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
		$suffix            = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		/*
		|--------------------------------------------------------------------------
		| GOOGLE FONTS
		|--------------------------------------------------------------------------
		*/
		wp_enqueue_style(
			'md-google-fonts',
			'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
			array(),
			null
		);

		/*
		|--------------------------------------------------------------------------
		| THEME CSS (Parent)
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
			array( 'md-google-fonts' ),
			$css_version
		);

		/*
		|--------------------------------------------------------------------------
		| CHILD THEME CSS (se presente)
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
		|--------------------------------------------------------------------------
		*/
		if ( 'bootstrap4' !== $bootstrap_version && is_admin_bar_showing() ) {
			understrap_offcanvas_admin_bar_inline_styles();
		}

		/*
		|--------------------------------------------------------------------------
		| SCRIPTS
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
		| CUSTOM JS (Child theme)
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
		| COMMENT REPLY
		|--------------------------------------------------------------------------
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );


/**
 * Fix offcanvas admin bar overlap
 */
if ( ! function_exists( 'understrap_offcanvas_admin_bar_inline_styles' ) ) {

	function understrap_offcanvas_admin_bar_inline_styles() {

		$navbar_type = get_theme_mod( 'understrap_navbar_type', 'collapse' );

		if ( 'offcanvas' !== $navbar_type ) {
			return;
		}

		$css = '
		body.admin-bar .offcanvas.show  {
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
