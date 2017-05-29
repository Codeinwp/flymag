<?php
/**
 * Carousel template
 *
 * @package FlyMag
 */

/**
 * Enqueue slider scripts
 */
function flymag_slider_scripts() {
	wp_enqueue_script( 'flymag-owl-script', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'flymag-slider-init', get_template_directory_uri() . '/js/slider-init.js', array(), true );

	// Slider speed options
	if ( ! get_theme_mod( 'carousel_speed' ) ) {
		$slideshowspeed = 4000;
	} else {
		$slideshowspeed = intval( get_theme_mod( 'carousel_speed' ) );
	}
	$slider_options = array(
		'slideshowspeed' => $slideshowspeed,
	);
	wp_localize_script( 'flymag-slider-init', 'sliderOptions', $slider_options );
}
	add_action( 'wp_enqueue_scripts', 'flymag_slider_scripts' );

	// Template
if ( ! function_exists( 'flymag_slider_template' ) ) {
	/**
	 * Display slider template
	 */
	function flymag_slider_template() {

		// Get the user choices
		$number     = get_theme_mod( 'carousel_number' );
		$cat        = get_theme_mod( 'carousel_cat' );
		$number     = ( ! empty( $number ) ) ? intval( $number ) : 6;
		$cat        = ( ! empty( $cat ) ) ? intval( $cat ) : '';

		$args = array(
			'posts_per_page'		=> $number,
			'post_status'   		=> 'publish',
			'cat'                   => $cat,
			'ignore_sticky_posts'   => true,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
	?>
	<div class="fly-slider slider-loader">
		<div class="featured-inner clearfix">
			<div class="slider-inner">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="slide">
							<span class="carousel-overlay"></span>
							<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'carousel-thumb' ); ?>
							<?php else : ?>
								<?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/placeholder.png"/>'; ?>
							<?php endif; ?>
							</a>
							<?php the_title( sprintf( '<h1 class="slide-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
							<span class="slide-link"><a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-long-arrow-right"></i></a></span>
						</div>
					<?php endwhile; ?>
			</div>
		</div>
			</div>
			<?php }
		wp_reset_postdata();
	}
}// End if().
