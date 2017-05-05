<?php
/**
 * News ticker template
 *
 * @package FlyMag
 */

if ( ! function_exists( 'flymag_ticker_template' ) ) {

	/**
	 * Ticker template
	 */
	function flymag_ticker_template() {

		// Get the user choices
		$number = get_theme_mod( 'latest_news_number' );
		$cat    = get_theme_mod( 'latest_news_cat' );
		$number = ( ! empty( $number ) ) ? intval( $number ) : 6;
		$cat    = ( ! empty( $cat ) ) ? intval( $cat ) : '';

		// Run the loop
		$args  = array(
			'posts_per_page'      => $number,
			'post_status'         => 'publish',
			'cat'                 => $cat,
			'ignore_sticky_posts' => true,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) { ?>

			<div class="latest-news container">
				<div class="ticker-info col-md-1 col-sm-1 col-xs-1">
					<i class="fa fa-bullhorn"></i>
				</div>
				<div class="news-ticker col-md-11 col-sm-11 col-xs-11">
					<div class="ticker-inner">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php the_title( sprintf( '<h4 class="ticker-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
						<?php endwhile; ?>
					</div>
				</div>
			</div>

		<?php }
		wp_reset_postdata();
	}
}// End if().
