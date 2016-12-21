<?php
/**
 * Class for messages controls in customizer
 *
 * @package Flymag
 */

/**
 * Class Flymag_Message
 */
class Flymag_Message extends WP_Customize_Control {

	/**
	 * Link for pro version
	 *
	 * @var string $link Link for pro version.
	 */
	private $link = '';

	/**
	 * Text between a tags.
	 *
	 * @var string $link_text The text for link.
	 */
	private $link_text = '';

	/**
	 * Text for the rest of message.
	 *
	 * @var string $control_text The text the rest of message.
	 */
	private $control_text = '';

	/**
	 * Flymag_Message constructor.
	 *
	 * @param string  $manager Manager.
	 * @param integer $id Id.
	 * @param array   $args Array of arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['upsell_link_url'] ) ) {
			$this->link = $args['upsell_link_url'];
		}
		if ( ! empty( $args['link_text'] ) ) {
			$this->link_text = $args['link_text'];
		}
		if ( ! empty( $args['control_text'] ) ) {
			$this->control_text = $args['control_text'];
		}
	}

	/**
	 * The render function for the controler
	 */
	public function render_content() {
		?>
		<a href="<?php echo esc_url( $this->link ); ?>">
			<?php echo esc_html( $this->link_text ); ?>
		</a>
		<?php echo esc_html( $this->control_text );
	}
}

