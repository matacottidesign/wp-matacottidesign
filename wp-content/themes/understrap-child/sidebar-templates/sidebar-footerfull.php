<?php
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'footerfull' ) ) {
    return;
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<footer id="colophon" class="site-footer">
    <div class="<?php echo esc_attr( $container ); ?>">
        <?php dynamic_sidebar( 'footerfull' ); ?>
    </div>
</footer>
