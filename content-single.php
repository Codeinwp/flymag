<?php
/**
 * The template part for displaying single posts
 *
 * @package FlyMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="single-thumb">
			<?php the_post_thumbnail( 'entry-thumb' ); ?>
		</div>	
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( get_theme_mod( 'flymag_single_date' ) != 1 ) : ?>
		<div class="entry-meta">
			<?php flymag_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(
				array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'flymag' ),
				'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php flymag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
