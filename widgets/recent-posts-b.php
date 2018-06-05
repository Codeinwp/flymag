<?php
/**
 * Recent posts type B widget
 *
 * @package FlyMag
 */

/**
 * Class Flymag_Recent_B
 */
class Flymag_Recent_B extends WP_Widget {

	/**
	 * Flymag_Recent_B constructor.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'recent_posts_b clearfix',
			'description' => __( 'Recent posts widget Type B (front page)', 'flymag' ),
		);
		parent::__construct( 'recent_posts_b', __( 'Flymag: Recent posts type B', 'flymag' ), $widget_ops );
		$this->alt_option_name = 'recent_posts_b';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'recent_posts_b', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();

		$title      = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title      = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category   = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$bg_color   = isset( $instance['bg_color'] ) ? esc_attr( $instance['bg_color'] ) : '';
		$text_color = isset( $instance['text_color'] ) ? esc_attr( $instance['text_color'] ) : '';

		$left_query = new WP_Query(
			array(
			'posts_per_page'      => 1,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name'       => $category,

			)
		);

		$right_query = new WP_Query(
			array(
			'offset'              => 1,
			'posts_per_page'      => 5,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name'       => $category,

			)
		);

		if ( $left_query->have_posts() ) :

			if ( ! empty( $args['before_widget'] ) ) {
				echo $args['before_widget'];
			}
			?>

			<div class="widget-inner clearfix" style="background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>">
				<?php
				if ( ! empty( $title ) ) {

					if ( ! empty( $args['before_title'] ) ) {
						echo $args['before_title'];
					}
					echo '<span style="color:' . $text_color . ';">' . $title . '</span>';
					if ( ! empty( $args['after_title'] ) ) {
						echo $args['after_title'];
					}
				}
				?>

				<?php while ( $left_query->have_posts() ) : $left_query->the_post(); ?>

					<div class="recent-post first-post col-md-6 col-sm-6 clearfix">
						<div class="recent-thumb">
							<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'carousel-thumb' ); ?>
							<?php else : ?>
								<?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/placeholder.png"/>'; ?>
							<?php endif; ?>
							</a>
						</div>
						<div class="recent-content">
							<?php the_title( sprintf( '<h3 class="entry-title"><a style="color:' . $text_color . '" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							<div class="entry-meta" style="color: <?php echo $text_color; ?>">
								<?php flymag_posted_on(); ?>
								<?php flymag_post_first_cat(); ?>
							</div>
							<?php the_excerpt(); ?>
						</div>
					</div>

				<?php endwhile; ?>

				<?php while ( $right_query->have_posts() ) : $right_query->the_post(); ?>

					<div class="recent-post col-md-6 col-sm-6 clearfix">
						<div class="recent-thumb col-md-3 col-sm-3 col-xs-3">
							<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'carousel-thumb' ); ?>
							<?php else : ?>
								<?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/placeholder.png"/>'; ?>
							<?php endif; ?>
							</a>
						</div>
						<div class="recent-content col-md-9 col-sm-9 col-xs-9">
							<?php the_title( sprintf( '<h4 class="entry-title"><a style="color:' . $text_color . '" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
							<div class="entry-meta" style="color: <?php echo $text_color; ?>">
								<?php flymag_posted_on(); ?>
								<?php flymag_post_first_cat(); ?>
							</div>
						</div>
					</div>

				<?php endwhile; ?>

			</div>

			<?php

			if ( ! empty( $args['after_widget'] ) ) {
				echo $args['after_widget'];
			}

			wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'recent_posts_b', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['category']   = strip_tags( $new_instance['category'] );
		$instance['bg_color']   = strip_tags( $new_instance['bg_color'] );
		$instance['text_color'] = strip_tags( $new_instance['text_color'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['recent_posts_b'] ) ) {
			delete_option( 'recent_posts_b' );
		}

		return $instance;
	}

	/**
	 * Flush widget cache
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'recent_posts_b', 'widget' );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$category   = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$bg_color   = isset( $instance['bg_color'] ) ? esc_attr( $instance['bg_color'] ) : '';
		$text_color = isset( $instance['text_color'] ) ? esc_attr( $instance['text_color'] ) : '';
		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/></p>

		<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3"/></p>

		<p><label for="<?php echo $this->get_field_id( 'bg_color' ); ?>" style="display:block;"><?php _e( 'Background color', 'flymag' ); ?></label>
			<input class="color-picker" type="text" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo $bg_color; ?>"/></p>

		<p><label for="<?php echo $this->get_field_id( 'text_color' ); ?>" style="display:block;"><?php _e( 'Text color', 'flymag' ); ?></label>
			<input class="color-picker" type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo $text_color; ?>"/></p>

		<?php
	}
}
