<?php
/**
 * Video Widget
 *
 * @package FlyMag
 */

/**
 * Class Flymag_Video
 */
class Flymag_Video extends WP_Widget {

	/**
	 * Flymag_Video constructor.
	 */
	public function __construct() {
		$widget_ops = array(
				'classname' => 'flymag_video_widget',
			'description' => __( 'Display an oEmbed video.', 'flymag' ),
		);
		parent::__construct( 'flymag_video', __( 'Flymag: Video', 'flymag' ), $widget_ops );
		$this->alt_option_name = 'flymag_video';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {

		// Check values
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url   = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Paste the URL of the video (only from a network that supports oEmbed, like Youtube, Vimeo etc.):', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" size="3"/></p>

		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url']   = esc_url_raw( $new_instance['url'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['flymag_video'] ) ) {
			delete_option( 'flymag_video' );
		}

		return $instance;
	}

	/**
	 * Flush widget cache
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'flymag_video', 'widget' );
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
			$cache = wp_cache_get( 'flymag_video', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';

		if ( ! empty( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}

		if ( ! empty( $title ) ) {

			if ( ! empty( $args['before_title'] ) ) {
				echo $args['before_title'];
			}
			echo $title;
			if ( ! empty( $args['after_title'] ) ) {
				echo $args['after_title'];
			}
		}

		if ( $url ) {
			echo wp_oembed_get( $url );
		}

		if ( ! empty( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'flymag_video', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

}
