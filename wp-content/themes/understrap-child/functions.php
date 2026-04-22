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
 * META BOX: IMMAGINE IN EVIDENZA PER I PROGETTI
 * ============================================================
 * Aggiunge la meta box per l'immagine in evidenza al custom
 * post type "progetto", posizionata nella sidebar laterale.
 * ============================================================
 */
function child_register_progetto_thumbnail_meta_box() {
    add_meta_box(
        'postimagediv',
        __( 'Immagine in evidenza' ),
        'post_thumbnail_meta_box',
        'progetto',
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'child_register_progetto_thumbnail_meta_box' );
