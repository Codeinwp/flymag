<?php
/**
 * Recent comments
 *
 * @package FlyMag
 */

/**
 * Class Flymag_Recent_Comments
 */
class Flymag_Recent_Comments extends WP_Widget {

	/**
	 * Flymag_Recent_Comments constructor.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'flymag_recent_comments',
			'description' => __( 'Display your site&#8217;s recent comments with avatars.', 'flymag' ),
		);
		parent::__construct( 'recent-comments', __( 'Flymag: Recent Comments', 'flymag' ), $widget_ops );
		$this->alt_option_name = 'flymag_recent_comments';

		add_action( 'comment_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'edit_comment', array( $this, 'flush_widget_cache' ) );
		add_action( 'transition_comment_status', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'flymag_recent_comments', 'widget' );
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

		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments', 'flymag' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}

		$comments = get_comments(
			apply_filters(
				'widget_comments_args', array(
				 'number'      => $number,
				 'status'      => 'approve',
				 'post_status' => 'publish',
				 )
			)
		);

		if ( ! empty( $args['before_widget'] ) ) {
			$output .= $args['before_widget'];
		}
		if ( ! empty( $title ) ) {

			if ( ! empty( $args['before_title'] ) ) {
				$output .= $args['before_title'];
			}
			$output .= $title;
			if ( ! empty( $args['after_title'] ) ) {
				$output .= $args['after_title'];
			}
		}

		$output .= '<ul class="list-group">';
		if ( $comments ) {
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment ) {
				$output .= '<li class="list-group-item"><div class="recent-comment clearfix">' . get_avatar( $comment, 60 ) . '<div class="recent-comment-meta"><span>' . /* translators: comments widget: 1: comment author, 2: post link */
						   sprintf( __( '%1$s on %2$s', 'flymag' ), get_comment_author_link(), '</span><a class="post-title" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a></div>' ) . '</div></li>';
			}
		}
		$output .= '</ul>';

		if ( ! empty( $args['after_widget'] ) ) {
			$output .= $args['after_widget'];
		}

		echo $output;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = $output;
			wp_cache_set( 'flymag_recent_comments', $cache, 'widget' );
		}
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['flymag_recent_comments'] ) ) {
			delete_option( 'flymag_recent_comments' );
		}

		return $instance;
	}

	/**
	 * Flush widget cache
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'flymag_recent_comments', 'widget' );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flymag' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:', 'flymag' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3"/></p>

		<?php
	}
}
