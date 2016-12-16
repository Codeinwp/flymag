<?php
/**
 * Class to display upsells.
 *
 * @package WordPress
 * @subpackage Flymag
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Flymag_Info
 */
class Flymag_Info extends WP_Customize_Control {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'info';

	/**
	 * Control label
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $label = '';


	/**
	 * The render function for the controler
	 */
	public function render_content() {
		$links = array(
			array(
				'name' => __( 'Documentation','flymag' ),
				'link' => esc_url( 'http://docs.themeisle.com/article/310-flymag-documentation' ),
			),
			array(
				'name' => __( 'Github','flymag' ),
				'link' => esc_url( 'https://github.com/Codeinwp/flymag' ),
			),
			array(
				'name' => __( 'Leave a review','flymag' ),
				'link' => esc_url( 'https://wordpress.org/support/view/theme-reviews/flymag#postform' ),
			),
		); ?>


		<div class="flymag-theme-info">
			<?php
			foreach ( $links as $item ) {  ?>
				<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
				<hr/>
				<?php
			} ?>
		</div>
		<?php
	}
}
