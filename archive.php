<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package FlyMag
 */

get_header(); ?>

	<?php if ( get_theme_mod( 'blog_layout', 'classic' ) == 'fullwidth' ) {
		$layout = 'fullwidth';
} else {
	$layout = '';
} ?>
	<?php if ( get_theme_mod( 'blog_layout', 'classic' ) == 'masonry' ) {
		$masonry = 'home-masonry';
} else {
	$masonry = '';
} ?>

	<div id="primary" class="content-area <?php echo $layout; ?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				if ( is_author() ) :
					echo get_avatar( get_the_author_meta( 'ID' ), 60, '' );
					endif;
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<div class="home-wrapper <?php echo $masonry; ?>">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
			</div>

			<?php flymag_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( get_theme_mod( 'blog_layout', 'classic' ) != 'fullwidth' ) {
	get_sidebar();
} ?>
<?php get_footer(); ?>
