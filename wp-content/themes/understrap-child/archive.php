<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php if ( have_posts() ) : ?>

				<!-- HEADER: COLONNA 12 -->
				<div class="col-12">
					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header>
				</div>

				<!-- POSTS: ROW INTERNA -->
				<div class="col-12">
					<div class="row">

						<?php
						while ( have_posts() ) :
							the_post();
						?>
							<!-- SINGOLO POST: COLONNA 6 -->
							<div class="col-md-6 mb-4">
								<?php
								get_template_part(
									'loop-templates/content',
									get_post_format()
								);
								?>
							</div>
						<?php endwhile; ?>

					</div>
				</div>

			<?php else : ?>

				<div class="col-12">
					<?php get_template_part( 'loop-templates/content', 'none' ); ?>
				</div>

			<?php endif; ?>

			<!-- PAGINAZIONE -->
			<div class="col-12">
				<?php understrap_pagination(); ?>
			</div>

			<?php
			// Sidebar check
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->


<?php
get_footer();
