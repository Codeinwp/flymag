<?php
/**
 * The template part for displaying content
 *
 * @package FlyMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumb col-md-4">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
				<?php the_post_thumbnail( 'entry-thumb' ); ?>
			</a>			
		</div>
		<?php $thumb = 'col-md-8'; ?>
	<?php else : ?>
		<?php $thumb = ''; ?>	
	<?php endif; ?>

	<div class="post-wrapper <?php echo $thumb; ?>">
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() && (get_theme_mod( 'flymag_date' ) != 1) ) : ?>
			<div class="entry-meta">
				<?php flymag_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
			<?php
				wp_link_pages(
					array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'flymag' ),
					'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<?php if ( get_theme_mod( 'flymag_cats' ) != 1 ) : ?>
		<footer class="entry-footer">
			<?php flymag_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
