<?php
/**
 * The template for displaying image attachments.
 *
 * @package FlyMag
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<div class="entry-meta">
						<?php flymag_posted_on(); ?>
						<span class="image-parent">
							<?php
							$metadata = wp_get_attachment_metadata();
							/* translators: %1$s is post url, %2$s is post title */
							printf( __( '<i class="fa fa-pencil"></i> Image posted in: <a href="%1$s" title="Return to %2$s" rel="gallery">%2$s</a>', 'flymag' ),
								get_permalink( $post->post_parent ),
								get_the_title( $post->post_parent )
							);
							?>
							</span>
					</div>
				</header>

				<div class="entry-content">

					<div class="entry-thumb">
						<div class="entry-attachment">
							<?php echo wp_get_attachment_image( $post->ID, 'entry-thumb' ); ?>
						</div>
						<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php the_content(); ?>
					<?php wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'flymag' ),
						'after' => '</div>',
					) ); ?>
				</div>
				<div class="images-sizes">
					<?php _e( 'Image available in:', 'flymag' ); ?>
					<?php
					$images      = array();
					$image_sizes = get_intermediate_image_sizes();
					array_unshift( $image_sizes, 'full' );
					foreach ( $image_sizes as $image_size ) {
						$image    = wp_get_attachment_image_src( get_the_ID(), $image_size );
						$name     = $image[1] . 'x' . $image[2];
						$images[] = '<a href="' . $image[0] . '">' . $name . '</a>';
					}

					echo implode( ' / ', $images );
					?>
				</div>
				<nav class="image-navigation">
					<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'flymag' ) ); ?></span>
					<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'flymag' ) ); ?></span>
				</nav>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
