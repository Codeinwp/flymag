<?php
/**
 * Template Name: Front page - fullwidt
 *
 * @package FlyMag
 */

get_header(); ?>

	<div class="home-widgets fullwidth">
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
		<?php endif; ?>	

		<div id="primary" class="fullwidth">
			<main id="main" class="site-main" role="main">

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
				<?php endif; ?>	

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php get_footer(); ?>
