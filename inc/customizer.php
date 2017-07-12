<?php
/**
 * FlyMag Theme Customizer
 *
 * @package FlyMag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flymag_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Class Flymag_Titles
	 */
	class Flymag_Titles extends WP_Customize_Control {

		/**
		 * Type of control.
		 *
		 * @var string $type Control type.
		 */
		public $type = 'titles';

		/**
		 * Control label
		 *
		 * @var string $label Control label
		 */
		public $label = '';

		/**
		 * Render content for this control.
		 */
		public function render_content() {
			?>
			<h3 style="padding: 10px; border: 1px solid #DF7B7B; color: #DF7B7B;"><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}

	/**
	 * Class Flymag_Categories_Dropdown
	 */
	class Flymag_Categories_Dropdown extends WP_Customize_Control {

		/**
		 * Render content for this control.
		 */
		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( '&mdash; Select &mdash;', 'flymag' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}

	/**
	 * Class Flymag_Divider
	 */
	class Flymag_Divider extends WP_Customize_Control {

		/**
		 * Render content for this control.
		 */
		public function render_content() {
			echo '<hr style="margin: 15px 0;border-top: 1px dashed #919191;" />';
		}
	}

	require_once( 'class/flymag-info.php' );
	require_once( 'class/flymag-text-control.php' );

	$wp_customize->add_section( 'flymag_theme_info', array(
		'title'    => __( 'View theme info', 'flymag' ),
		'priority' => 0,
	) );

	$wp_customize->add_setting( 'flymag_theme_info', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'flymag_sanitize_text',
	) );

	$wp_customize->add_control( new Flymag_Info( $wp_customize, 'flymag_theme_info', array(
		'section'  => 'flymag_theme_info',
		'priority' => 10,
	) ) );

	// ___General___//
	$wp_customize->add_section(
		'flymag_general',array(
			'title'    => __( 'General', 'flymag' ),
			'priority' => 9,
	) );

	// Logo Upload
	$wp_customize->add_setting('site_logo',array(
			'default-image'     => '',
			'sanitize_callback' => 'esc_url_raw',

	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'site_logo',array(
			'label'    => __( 'Upload your logo', 'flymag' ),
			'type'     => 'image',
			'section'  => 'flymag_general',
			'settings' => 'site_logo',
			'priority' => 11,
		)
	) );
	// Logo size
	$wp_customize->add_setting('logo_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '200',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'logo_size', array(
		'type'        => 'number',
		'priority'    => 12,
		'section'     => 'flymag_general',
		'label'       => __( 'Logo size', 'flymag' ),
		'description' => __( 'Max-width for the logo. Default 200px', 'flymag' ),
		'input_attrs' => array(
			'min'   => 50,
			'max'   => 600,
			'step'  => 5,
		),
	) );
	// Logo style
	$wp_customize->add_setting('logo_style',array(
			'default'           => 'hide-title',
			'sanitize_callback' => 'flymag_sanitize_logo_style',
	) );
	$wp_customize->add_control( 'logo_style',array(
			'type'        => 'radio',
			'label'       => __( 'Logo style', 'flymag' ),
			'description' => __( 'This option applies only if you are using a logo', 'flymag' ),
			'section'     => 'flymag_general',
			'priority'    => 13,
			'choices'     => array(
				'hide-title' => __( 'Only logo', 'flymag' ),
				'show-title' => __( 'Logo plus site title&amp;description', 'flymag' ),
			),
	) );
	// Padding
	$wp_customize->add_setting('branding_padding',array(
			'sanitize_callback' => 'absint',
			'default'           => '30',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'branding_padding', array(
		'type'        => 'number',
		'priority'    => 14,
		'section'     => 'flymag_general',
		'label'       => __( 'Padding', 'flymag' ),
		'description' => __( 'Top&amp;bottom padding for the branding. Default: 150px', 'flymag' ),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 350,
			'step'  => 5,
		),
	) );

	$wp_customize->add_setting( 'flymag_view_pro', array(
		'sanitize_callback' => 'flymag_sanitize_text',
	) );

	$wp_customize->add_control( new Flymag_Message( $wp_customize, 'flymag_view_pro',array(
			'section'         => 'flymag_general',
			'priority'        => 100,
			'upsell_link_url' => esc_url( 'https://themeisle.com/themes/flymag-pro/' ),
			'link_text'       => __( 'View pro version', 'flymag' ),
			'control_text'    => __( 'It adds extra widget areas, the ability to change footer credits and a featured area.', 'flymag' ),
		)
	) );

	// ___Latest news___//
	$wp_customize->add_section( 'flymag_latest_news',array(
			'title'    => __( 'Latest news', 'flymag' ),
			'priority' => 12,
	) );

	// Display
	$wp_customize->add_setting('latest_news_display',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 1,
	) );

	$wp_customize->add_control( 'latest_news_display',array(
			'type'     => 'checkbox',
			'label'    => __( 'Check this box to display the latest news ribbon.', 'flymag' ),
			'section'  => 'flymag_latest_news',
			'priority' => 10,
	) );
	// Category
	$wp_customize->add_setting( 'latest_news_cat', array(
		'default'           => '',
		'sanitize_callback' => 'flymag_sanitize_int',
	) );

	$wp_customize->add_control( new Flymag_Categories_Dropdown( $wp_customize, 'latest_news_cat', array(
		'label'    => __( 'Select which category to show in the slider', 'flymag' ),
		'section'  => 'flymag_latest_news',
		'settings' => 'latest_news_cat',
		'priority' => 11,
	) ) );
	// Number of posts
	$wp_customize->add_setting('latest_news_number',array(
			'default'           => '6',
			'sanitize_callback' => 'flymag_sanitize_int',
	) );
	$wp_customize->add_control( 'latest_news_number',array(
			'label'    => __( 'Enter the number of posts you want to show', 'flymag' ),
			'section'  => 'flymag_latest_news',
			'type'     => 'text',
			'priority' => 12,
	) );
	// ___Carousel___//
	$wp_customize->add_section(
		'flymag_carousel',array(
			'title'    => __( 'Carousel', 'flymag' ),
			'priority' => 13,
	) );
	// Display: Front page
	$wp_customize->add_setting('carousel_display_front',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'carousel_display_front',array(
			'type'     => 'checkbox',
			'label'    => __( 'Show carousel on front page?', 'flymag' ),
			'section'  => 'flymag_carousel',
			'priority' => 8,
	) );
	// Display: Home and archives
	$wp_customize->add_setting('carousel_display_archives',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 1,
	) );
	$wp_customize->add_control( 'carousel_display_archives',array(
			'type'     => 'checkbox',
			'label'    => __( 'Show carousel on blog index/archives/etc?', 'flymag' ),
			'section'  => 'flymag_carousel',
			'priority' => 9,
	) );
	// Display: Singular
	$wp_customize->add_setting('carousel_display_singular',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'carousel_display_singular',array(
			'type'     => 'checkbox',
			'label'    => __( 'Show carousel on single posts and pages?', 'flymag' ),
			'section'  => 'flymag_carousel',
			'priority' => 10,
	) );
	// Category
	$wp_customize->add_setting( 'carousel_cat', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new Flymag_Categories_Dropdown( $wp_customize, 'carousel_cat', array(
		'label'    => __( 'Select which category to show in the carousel', 'flymag' ),
		'section'  => 'flymag_carousel',
		'settings' => 'carousel_cat',
		'priority' => 11,
	) ) );
	// Autoplay speed
	$wp_customize->add_setting('carousel_speed',array(
			'default'           => '4000',
			'sanitize_callback' => 'flymag_sanitize_int',
	) );
	$wp_customize->add_control( 'carousel_speed',array(
			'label'    => __( 'Enter the carousel speed in miliseconds [Default: 4000]', 'flymag' ),
			'section'  => 'flymag_carousel',
			'type'     => 'text',
			'priority' => 13,
	) );
	// Number of posts
	$wp_customize->add_setting('carousel_number',array(
			'default'           => '6',
			'sanitize_callback' => 'flymag_sanitize_int',
	) );
	$wp_customize->add_control( 'carousel_number',array(
			'label'    => __( 'Enter the number of posts you want to show', 'flymag' ),
			'section'  => 'flymag_carousel',
			'type'     => 'text',
			'priority' => 12,
	) );

	// ___Blog options___//
	$wp_customize->add_section('blog_options',array(
			'title'    => __( 'Blog options', 'flymag' ),
			'priority' => 13,
	) );
	// Index
	$wp_customize->add_setting( 'flymag_options[titles]', array(
		'type'              => 'titles_control',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new flymag_Titles( $wp_customize, 'index_meta', array(
			'label'    => __( 'Blog page', 'flymag' ),
			'section'  => 'blog_options',
			'settings' => 'flymag_options[titles]',
			'priority' => 9,
	) ) );
	// Blog layout
	$wp_customize->add_setting('blog_layout',array(
			'default'           => 'classic',
			'sanitize_callback' => 'flymag_sanitize_layout',
	) );
	$wp_customize->add_control( 'blog_layout',array(
			'type'     => 'radio',
			'label'    => __( 'Blog layout', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 10,
			'choices'  => array(
				'classic'   => __( 'Classic', 'flymag' ),
				'fullwidth' => __( 'Full width (no sidebar)', 'flymag' ),
				'masonry'   => __( 'Masonry (grid style)', 'flymag' ),
			),
	) );
	// Excerpt
	$wp_customize->add_setting('exc_lenght',array(
			'sanitize_callback' => 'absint',
			'default'           => '55',
	) );
	$wp_customize->add_control( 'exc_lenght', array(
		'type'        => 'number',
		'priority'    => 12,
		'section'     => 'blog_options',
		'label'       => __( 'Excerpt lenght', 'flymag' ),
		'description' => __( 'Choose your excerpt length. Default: 55 words', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 200,
			'step'  => 5,
			'style' => 'padding: 15px;',
		),
	) );
	// Hide date
	$wp_customize->add_setting('flymag_date',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'flymag_date',array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide post date on index?', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 14,
	) );
	// Hide categories
	$wp_customize->add_setting('flymag_cats',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'flymag_cats',array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide post categories on index?', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 15,
	) );
	// Singles
	$wp_customize->add_setting( 'flymag_options[titles]', array(
		'type'              => 'titles_control',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new flymag_Titles( $wp_customize, 'single_meta', array(
			'label'    => __( 'Single posts', 'flymag' ),
			'section'  => 'blog_options',
			'settings' => 'flymag_options[titles]',
			'priority' => 16,
	) ) );
	// Hide date
	$wp_customize->add_setting('flymag_single_date',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'flymag_single_date',array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide post date &amp; author on single posts?', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 17,
	) );
	// Hide categories
	$wp_customize->add_setting('flymag_single_cats',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'flymag_single_cats',array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide post categories on single posts?', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 18,
	) );
	// Hide tags
	$wp_customize->add_setting('flymag_single_tags',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
			'default'           => 0,
	) );
	$wp_customize->add_control( 'flymag_single_tags',array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide post tags on single posts?', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 19,
	) );
	// Full width
	$wp_customize->add_setting('fullwidth_single',array(
			'sanitize_callback' => 'flymag_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'fullwidth_single',array(
			'type'     => 'checkbox',
			'label'    => __( 'Full width single posts?', 'flymag' ),
			'section'  => 'blog_options',
			'priority' => 21,
	) );
	// ___Fonts___//
	$wp_customize->add_section(
		'flymag_fonts',array(
			'title'       => __( 'Fonts', 'flymag' ),
			'priority'    => 15,
			'description' => __( 'You can use any Google Fonts you want for the heading and/or body. See the fonts here: google.com/fonts. See the documentation if you need help with this: docs.themeisle.com/article/310-flymag-documentation', 'flymag' ),
	) );
	// Body fonts title
	$wp_customize->add_setting( 'flymag_options[titles]', array(
		'type'              => 'titles_control',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new flymag_Titles( $wp_customize, 'body_fonts', array(
			'label'    => __( 'Body fonts', 'flymag' ),
			'section'  => 'flymag_fonts',
			'settings' => 'flymag_options[titles]',
			'priority' => 10,
	) ) );
	// Body fonts
	$wp_customize->add_setting('body_font_name',array(
			'default'           => 'Roboto:400,400italic,700,700italic',
			'sanitize_callback' => 'flymag_sanitize_text',
	) );
	$wp_customize->add_control( 'body_font_name',array(
			'label'    => __( 'Font name/style/sets', 'flymag' ),
			'section'  => 'flymag_fonts',
			'type'     => 'text',
			'priority' => 11,
	) );
	// Body fonts family
	$wp_customize->add_setting('body_font_family',array(
			'default'           => '\'Roboto\', sans-serif',
			'sanitize_callback' => 'flymag_sanitize_text',
	) );
	$wp_customize->add_control( 'body_font_family',array(
			'label'    => __( 'Font family', 'flymag' ),
			'section'  => 'flymag_fonts',
			'type'     => 'text',
			'priority' => 12,
	) );
	// Headings fonts title
	$wp_customize->add_setting( 'flymag_options[titles]', array(
		'type'              => 'titles_control',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new flymag_Titles( $wp_customize, 'headings_fonts', array(
			'label'    => __( 'Headings fonts', 'flymag' ),
			'section'  => 'flymag_fonts',
			'settings' => 'flymag_options[titles]',
			'priority' => 13,
	) ) );
	// Headings fonts
	$wp_customize->add_setting('headings_font_name',array(
			'default'           => 'Oswald:400,700',
			'sanitize_callback' => 'flymag_sanitize_text',
	) );
	$wp_customize->add_control( 'headings_font_name',array(
			'label'    => __( 'Font name/style/sets', 'flymag' ),
			'section'  => 'flymag_fonts',
			'type'     => 'text',
			'priority' => 14,
	) );
	// Headings fonts family
	$wp_customize->add_setting('headings_font_family',array(
			'default'           => '\'Oswald\', sans-serif',
			'sanitize_callback' => 'flymag_sanitize_text',
	) );
	$wp_customize->add_control( 'headings_font_family',array(
			'label'    => __( 'Font family', 'flymag' ),
			'section'  => 'flymag_fonts',
			'type'     => 'text',
			'priority' => 15,
	) );
	// Font sizes title
	$wp_customize->add_setting( 'flymag_options[titles]', array(
		'type'              => 'titles_control',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new flymag_Titles( $wp_customize, 'font_sizes_title', array(
			'label'    => __( 'Font sizes', 'flymag' ),
			'section'  => 'flymag_fonts',
			'settings' => 'flymag_options[titles]',
			'priority' => 16,
	) ) );
	// Site title
	$wp_customize->add_setting('site_title_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '52',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'site_title_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'flymag_fonts',
		'label'       => __( 'Site title', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 90,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// Site description
	$wp_customize->add_setting('site_desc_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '20',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'site_desc_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'flymag_fonts',
		'label'       => __( 'Site description', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// Nav menu
	$wp_customize->add_setting('menu_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '16',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'menu_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'flymag_fonts',
		'label'       => __( 'Menu items', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// H1 size
	$wp_customize->add_setting('h1_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '36',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'h1_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'flymag_fonts',
		'label'       => __( 'H1 font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// H2 size
	$wp_customize->add_setting('h2_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '30',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'h2_size', array(
		'type'        => 'number',
		'priority'    => 18,
		'section'     => 'flymag_fonts',
		'label'       => __( 'H2 font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// H3 size
	$wp_customize->add_setting('h3_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '24',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'h3_size', array(
		'type'        => 'number',
		'priority'    => 19,
		'section'     => 'flymag_fonts',
		'label'       => __( 'H3 font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// H4 size
	$wp_customize->add_setting('h4_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '18',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'h4_size', array(
		'type'        => 'number',
		'priority'    => 20,
		'section'     => 'flymag_fonts',
		'label'       => __( 'H4 font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// H5 size
	$wp_customize->add_setting('h5_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '14',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'h5_size', array(
		'type'        => 'number',
		'priority'    => 21,
		'section'     => 'flymag_fonts',
		'label'       => __( 'H5 font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// H6 size
	$wp_customize->add_setting('h6_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '12',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'h6_size', array(
		'type'        => 'number',
		'priority'    => 22,
		'section'     => 'flymag_fonts',
		'label'       => __( 'H6 font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );
	// Body
	$wp_customize->add_setting('body_size',array(
			'sanitize_callback' => 'absint',
			'default'           => '16',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'body_size', array(
		'type'        => 'number',
		'priority'    => 23,
		'section'     => 'flymag_fonts',
		'label'       => __( 'Body font size', 'flymag' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 24,
			'step'  => 1,
			'style' => 'margin-bottom: 15px; padding: 10px;',
		),
	) );

	// ___Colors___//
	// Color scheme
	$wp_customize->add_control( new Flymag_Divider( $wp_customize, 'cs_divider', array(
		'section'  => 'colors',
		'settings' => 'flymag_options[titles]',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'flymag_options[titles]', array(
		'type'              => 'titles_control',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new Flymag_Titles( $wp_customize, 'color_scheme', array(
			'label'    => __( 'Color scheme', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'flymag_options[titles]',
			'priority' => 12,
	) ) );
	$wp_customize->add_setting('color_scheme_1',array(
			'default'           => '#F0696A',
			'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'color_scheme_1',array(
			'label'    => __( 'Color 1 (primary color)', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'color_scheme_1',
			'priority' => 13,
		)
	) );
	$wp_customize->add_setting('color_scheme_2',array(
			'default'           => '#5B8AC0',
			'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'color_scheme_2',array(
			'label'    => __( 'Color 2', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'color_scheme_2',
			'priority' => 14,
		)
	) );
	$wp_customize->add_setting('color_scheme_3',array(
			'default'           => '#ED945D',
			'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'color_scheme_3',array(
			'label'    => __( 'Color 3', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'color_scheme_3',
			'priority' => 15,
		)
	) );
	$wp_customize->add_setting('color_scheme_4',array(
			'default'           => '#9F76CA',
			'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'color_scheme_4',array(
			'label'    => __( 'Color 4', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'color_scheme_4',
			'priority' => 16,
		)
	) );
	$wp_customize->add_setting('color_scheme_5',array(
			'default'           => '#7FC09B',
			'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'color_scheme_5',array(
			'label'    => __( 'Color 5', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'color_scheme_5',
			'priority' => 17,
		)
	) );
	// Divider
	$wp_customize->add_control( new Flymag_Divider( $wp_customize, 'color_scheme_divider', array(
		'section'  => 'colors',
		'settings' => 'color_scheme_5',
		'priority' => 18,
	) ) );
	// Latest news bg
	$wp_customize->add_setting('latest_news_color',array(
			'default'           => '#333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'latest_news_color',array(
			'label'    => __( 'Latest news background', 'flymag' ),
			'section'  => 'colors',
			'priority' => 19,
		)
	) );
	// Header
	$wp_customize->add_setting('header_color',array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'header_color',array(
			'label'    => __( 'Header background', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'header_color',
			'priority' => 21,
		)
	) );
	// Site title
	$wp_customize->add_setting('site_title_color',array(
			'default'           => '#1E262D',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'site_title_color',array(
			'label'    => __( 'Site title', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'site_title_color',
			'priority' => 22,
		)
	) );
	// Site desc
	$wp_customize->add_setting('site_desc_color',array(
			'default'           => '#ABADB2',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'site_desc_color',array(
			'label'    => __( 'Site description', 'flymag' ),
			'section'  => 'colors',
			'priority' => 23,
		)
	) );
	// Menu bg
	$wp_customize->add_setting('menu_bg_color',array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'menu_bg_color',array(
			'label'    => __( 'Menu background', 'flymag' ),
			'section'  => 'colors',
			'priority' => 24,
		)
	) );
	// Menu items
	$wp_customize->add_setting('menu_items_color',array(
			'default'           => '#505559',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'menu_items_color',array(
			'label'    => __( 'Menu items', 'flymag' ),
			'section'  => 'colors',
			'priority' => 25,
		)
	) );
	// Divider
	$wp_customize->add_control( new Flymag_Divider( $wp_customize, 'hc_divider', array(
		'section'  => 'colors',
		'settings' => 'menu_items_color',
		'priority' => 26,
	) ) );
	// Body
	$wp_customize->add_setting('body_text_color',array(
			'default'           => '#989FA8',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'body_text_color',array(
			'label'    => __( 'Body text', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'body_text_color',
			'priority' => 27,
		)
	) );
	// Widget color
	$wp_customize->add_setting('widgets_color',array(
			'default'           => '#989FA8',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'widgets_color',array(
			'label'    => __( 'Widgets color', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'widgets_color',
			'priority' => 28,
		)
	) );
	// Footer
	$wp_customize->add_setting('footer_color',array(
			'default'           => '#333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'footer_color',array(
			'label'    => __( 'Footer', 'flymag' ),
			'section'  => 'colors',
			'settings' => 'footer_color',
			'priority' => 29,
		)
	) );
}

add_action( 'customize_register', 'flymag_customize_register' );

/**
 * Text sanitization
 *
 * @param string $input Control input.
 *
 * @return string
 */
function flymag_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Checkbox sanitization
 *
 * @param int|string $input Control input.
 *
 * @return int|string
 */
function flymag_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Layout sanitization
 *
 * @param string $input Layout type.
 *
 * @return string
 */
function flymag_sanitize_layout( $input ) {
	$valid = array(
		'classic'   => __( 'Classic', 'flymag' ),
		'fullwidth' => __( 'Full width (no sidebar)', 'flymag' ),
		'masonry'   => __( 'Masonry (grid style)', 'flymag' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitization for numeric input.
 *
 * @param int|string $input Control input.
 *
 * @return int
 */
function flymag_sanitize_int( $input ) {
	if ( is_numeric( $input ) ) {
		return (int) $input;
	}
}

/**
 * Sanitization for logo style
 *
 * @param string $input Logo type.
 *
 * @return string
 */
function flymag_sanitize_logo_style( $input ) {
	$valid = array(
		'hide-title' => __( 'Only logo', 'flymag' ),
		'show-title' => __( 'Logo plus site title&amp;description', 'flymag' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flymag_customize_preview_js() {
	wp_enqueue_script( 'flymag_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'flymag_customize_preview_js' );
