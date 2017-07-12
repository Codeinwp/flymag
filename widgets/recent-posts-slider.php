<?php
/**
 * Recent posts type A widget
 *
 * @package FlyMag
 */

/**
 * Class Flymag_Recent_Slider
 */
class Flymag_Recent_Slider extends WP_Widget {

	/**
	 * Flymag_Recent_Slider constructor.
	 */
	public function __construct() {
		$widget_ops = array(
				'classname' => 'recent_posts_slider clearfix',
			'description' => __( 'Recent posts slider (front page)', 'flymag' ),
		);
		parent::__construct( 'recent_posts_slider', __( 'Flymag: Recent posts slider', 'flymag' ), $widget_ops );
		$this->alt_option_name = 'recent_posts_slider';

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
			$cache = wp_cache_get( 'recent_posts_slider', 'widget' );
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

		$title    = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title    = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$number   = ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : 4;
		if ( ! $number ) {
			$number = 4;
		}
		$bg_color    = isset( $instance['bg_color'] ) ? esc_attr( $instance['bg_color'] ) : '';
		$title_color = isset( $instance['title_color'] ) ? esc_attr( $instance['title_color'] ) : '';

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name'       => $category,
			'posts_per_page'      => $number,
		) ) );

		if ( $r->have_posts() ) :

			if ( ! empty( $args['before_widget'] ) ) {
				echo $args['before_widget'];
			}
			?>

			<div class="widget-inner clearfix" style="background-color: <?php echo $bg_color; ?>">
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
				<div class="posts-slider">
					<div class="posts-slider-inner clearfix">
						<?php while ( $r->have_posts() ) : $r->the_post(); ?>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="recent-post">
									<span class="carousel-overlay"></span>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
									<?php the_title( sprintf( '<h3 class="slide-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
									<span class="slide-link"><a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-long-arrow-right"></i></a></span>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				</div>
			</div><!-- .widget-inner -->
			<?php

			if ( ! empty( $args['after_widget'] ) ) {
				echo $args['after_widget'];
			}

			wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'recent_posts_slider', $cache, 'widget' );
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
		$instance                = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['category']    = strip_tags( $new_instance['category'] );
		$instance['number']      = absint( $new_instance['number'] );
		$instance['bg_color']    = strip_tags( $new_instance['bg_color'] );
		$instance['title_color'] = strip_tags( $new_instance['title_color'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['recent_posts_slider'] ) ) {
			delete_option( 'recent_posts_slider' );
		}

		return $instance;
	}

	/**
	 * Flush widget cache
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'recent_posts_slider', 'widget' );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$category    = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$number      = isset( $instance['number'] ) ? intval( $instance['number'] ) : 4;
		$bg_color    = isset( $instance['bg_color'] ) ? esc_attr( $instance['bg_color'] ) : '';
		$title_color = isset( $instance['title_color'] ) ? esc_attr( $instance['title_color'] ) : '';
		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/></p>

		<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3"/></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'flymag' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3"/></p>

		<p><label for="<?php echo $this->get_field_id( 'bg_color' ); ?>" style="display:block;"><?php _e( 'Background color', 'flymag' ); ?></label>
			<input class="color-picker" type="text" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo $bg_color; ?>"/></p>

		<p><label for="<?php echo $this->get_field_id( 'title_color' ); ?>" style="display:block;"><?php _e( 'Title color', 'flymag' ); ?></label>
			<input class="color-picker" type="text" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $title_color; ?>"/></p>


		<?php
	}
}
