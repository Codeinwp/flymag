<?php
$vendor_file = trailingslashit( get_template_directory() ) . 'vendor/autoload.php';
if ( is_readable( $vendor_file ) ) {
	require_once $vendor_file;
}
add_filter( 'themeisle_sdk_products', 'flymag_load_sdk' );
/**
 * Loads products array.
 *
 * @param array $products All products.
 *
 * @return array Products array.
 */
function flymag_load_sdk( $products ) {
	$products[] = get_template_directory() . '/style.css';

	return $products;
}
/**
 * FlyMag functions and definitions
 *
 * @package FlyMag
 */
if ( ! function_exists( 'flymag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flymag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FlyMag, use a find and replace
		 * to change 'flymag' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'flymag', get_template_directory() . '/languages' );
		// Content width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1160;
		}
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'carousel-thumb', 600, 400, true );
		add_image_size( 'entry-thumb', 820 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
			'primary' => __( 'Primary Menu', 'flymag' ),
			'social'  => __( 'Social', 'flymag' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			)
		);
		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'flymag_custom_background_args', array(
				 'default-color' => 'f5f5f5',
				 'default-image' => '',
				 )
			)
		);

		/**
		 * About page class
		 */
		require_once get_template_directory() . '/ti-about-page/class-ti-about-page.php';

		/*
		 * About page instance
		 */
		$config = array(
			// Menu name under Appearance.
			'menu_name'               => __( 'About Flymag', 'flymag' ),
			// Page title.
			'page_name'               => __( 'About Flymag', 'flymag' ),
			/* translators: %s is theme name */
			'welcome_title'         => sprintf( __( 'Welcome to %s! - Version ', 'flymag' ), esc_html( 'FlyMag' ) ),
			/* translators: %s is theme name */
			'welcome_content'       => esc_html__( 'Flymag is a responsive magazine theme with a modern look. Flymag lets you use any of the 600+ Google Fonts, provides color options for a lot of the theme elements and also offers you some useful page templates. With Flymag you can easily build your front page magazine-layout using the built in widgets specifically designed for this task.','flymag' ),
			/**
			 * Tabs array.
			 *
			 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
			 * the will be the name of the function which will be used to render the tab content.
			 */
			'tabs'                    => array(
				'getting_started'  => __( 'Getting Started', 'flymag' ),
				'recommended_actions' => '',
				'recommended_plugins' => __( 'Recommended Plugins','flymag' ),
				'support'       => __( 'Support', 'flymag' ),
				'changelog'        => __( 'Changelog', 'flymag' ),
				'free_pro'         => __( 'Free VS PRO', 'flymag' ),
			),
			// Support content tab.
			'support_content'      => array(
				'first' => array(
					'title' => esc_html__( 'Contact Support','flymag' ),
					'icon' => 'dashicons dashicons-sos',
					'text' => esc_html__( 'We want to make sure you have the best experience using FlyMag and that is why we gathered here all the necessary informations for you. We hope you will enjoy using FlyMag, as much as we enjoy creating great products.!','flymag' ),
					'button_label' => esc_html__( 'Contact Support','flymag' ),
					'button_link' => esc_url( 'https://themeisle.com/contact/' ),
					'is_button' => true,
					'is_new_tab' => true,
				),
				'second' => array(
					'title' => esc_html__( 'Documentation','flymag' ),
					'icon' => 'dashicons dashicons-book-alt',
					/* translators: %s is theme name */
					'text' => sprintf( esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use %s.','flymag' ), 'FlyMag' ),
					'button_label' => esc_html__( 'Documentation','flymag' ),
					'button_link' => 'http://docs.themeisle.com/article/310-flymag-documentation',
					'is_button' => false,
					'is_new_tab' => true,
				),
				'third' => array(
					'title' => esc_html__( 'Changelog','flymag' ),
					'icon' => 'dashicons dashicons-portfolio',
					'text' => esc_html__( 'Want to get the gist on the latest theme changes? Just consult our changelog below to get a taste of the recent fixes and features implemented.','flymag' ),
					'button_label' => esc_html__( 'Changelog','flymag' ),
					'button_link' => esc_url( admin_url( 'themes.php?page=flymag-welcome&tab=changelog&show=yes' ) ),
					'is_button' => false,
					'is_new_tab' => false,
				),
				'fourth' => array(
					'title' => esc_html__( 'Create a child theme','flymag' ),
					'icon' => 'dashicons dashicons-admin-customizer',
					'text' => esc_html__( "If you want to make changes to the theme's files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.",'flymag' ),
					'button_label' => esc_html__( 'View how to do this','flymag' ),
					'button_link' => 'http://docs.themeisle.com/article/14-how-to-create-a-child-theme',
					'is_button' => false,
					'is_new_tab' => true,
				),
				'fifth' => array(
					'title' => esc_html__( 'Speed up your site','flymag' ),
					'icon' => 'dashicons dashicons-controls-skipforward',
					'text' => esc_html__( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.','flymag' ),
					'button_label' => esc_html__( 'View how to do this','flymag' ),
					'button_link' => 'http://docs.themeisle.com/article/63-speed-up-your-wordpress-site',
					'is_button' => false,
					'is_new_tab' => true,
				),
				'sixth' => array(
					'title' => esc_html__( 'Build a landing page with a drag-and-drop content builder','flymag' ),
					'icon' => 'dashicons dashicons-images-alt2',
					'text' => esc_html__( 'In the below documentation you will find an easy way to build a great looking landing page using a drag-and-drop content builder plugin.','flymag' ),
					'button_label' => esc_html__( 'View how to do this','flymag' ),
					'button_link' => 'http://docs.themeisle.com/article/219-how-to-build-a-landing-page-with-a-drag-and-drop-content-builder',
					'is_button' => false,
					'is_new_tab' => true,
				),
			),
			// Getting started tab
			'getting_started' => array(
				'second' => array(
					'title' => esc_html__( 'Documentation','flymag' ),
					/* translators: %s is theme name */
					'text' => sprintf( esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use %s.','flymag' ), 'FlyMag' ),
					'button_label' => esc_html__( 'Documentation','flymag' ),
					'button_link' => 'http://docs.themeisle.com/article/310-flymag-documentation',
					'is_button' => false,
					'recommended_actions' => false,
					'is_new_tab' => true,
				),
				'third' => array(
					'title' => esc_html__( 'Go to Customizer','flymag' ),
					'text' => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.','flymag' ),
					'button_label' => esc_html__( 'Go to Customizer','flymag' ),
					'button_link' => esc_url( admin_url( 'customize.php' ) ),
					'is_button' => true,
					'recommended_actions' => false,
					'is_new_tab' => true,
				),
			),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => 'FlyMag',
				'pro_theme_name'      => 'FlyMag PRO',
				'pro_theme_link'      => 'https://themeisle.com/themes/flymag-pro/',
				/* translators: %s is theme name */
				'get_pro_theme_label' => sprintf( __( 'Get %s now!', 'flymag' ), 'FlyMag Pro' ),
				'features'            => array(
					array(
						'title'       => __( 'Mobile friendly', 'flymag' ),
						'description' => __( 'Responsive layout. Works on every device.', 'flymag' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => __( 'Unlimited color option', 'flymag' ),
						'description' => __( 'You can change the colors of each section. You have unlimited options.', 'flymag' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => __( 'Background image', 'flymag' ),
						'description' => __( 'You can use any background image you want.', 'flymag' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => __( 'Featured Area', 'flymag' ),
						'description' => __( 'Have access to a new featured area.', 'flymag' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => __( 'Footer credits', 'flymag' ),
						'description' => '',
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => __( 'Extra widgets areas', 'flymag' ),
						'description' => __( 'More widgets areas for your theme.', 'flymag' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => __( 'Support', 'flymag' ),
						'description' => __( 'You will benefit of our full support for any issues you have with the theme.', 'flymag' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),
			// Plugins array.
			'recommended_plugins'        => array(
				'already_activated_message' => esc_html__( 'Already activated', 'flymag' ),
				'version_label' => esc_html__( 'Version: ', 'flymag' ),
				'install_label' => esc_html__( 'Install and Activate', 'flymag' ),
				'activate_label' => esc_html__( 'Activate', 'flymag' ),
				'deactivate_label' => esc_html__( 'Deactivate', 'flymag' ),
				'content'                   => array(
					array(
						'slug'        => 'themeisle-companion',
					),
					array(
						'slug'        => 'pirate-forms',
					),
					array(
						'slug'        => 'intergeo-maps',
					),
				),
			),
			// Required actions array.
			'recommended_actions'        => array(
				'install_label' => esc_html__( 'Install and Activate', 'flymag' ),
				'activate_label' => esc_html__( 'Activate', 'flymag' ),
				'deactivate_label' => esc_html__( 'Deactivate', 'flymag' ),
				'content'            => array(),
			),
		);
		TI_About_Page::init( $config );
	}
endif; // flymag_setup
add_action( 'after_setup_theme', 'flymag_setup' );
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function flymag_widgets_init() {
	register_sidebar(
		array(
		'name'          => __( 'Sidebar', 'flymag' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
		)
	);
	register_sidebar(
		array(
		'name'          => __( 'Home page', 'flymag' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Widgets added here will be displayed on pages using the Front Page template', 'flymag' ),
		'before_widget' => '<aside id="%1$s" class="widget wow fadeIn %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
		)
	);
	register_sidebar(
		array(
		'name'          => __( 'Home page top', 'flymag' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Widgets added here will be displayed above the main content area and sidebar on pages using the Front Page template', 'flymag' ),
		'before_widget' => '<aside id="%1$s" class="widget wow fadeIn %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
		)
	);
	register_sidebar(
		array(
		'name'          => __( 'Footer left', 'flymag' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
		'name'          => __( 'Footer center', 'flymag' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
		'name'          => __( 'Footer right', 'flymag' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);
	// Custom widgets
	register_widget( 'Flymag_Recent_A' );
	register_widget( 'Flymag_Recent_B' );
	register_widget( 'Flymag_Recent_C' );
	register_widget( 'Flymag_Recent_D' );
	register_widget( 'Flymag_Recent_Slider' );
	register_widget( 'Flymag_Video' );
	register_widget( 'Flymag_Recent_Comments' );

}

add_action( 'widgets_init', 'flymag_widgets_init' );
// Custom widgets
require get_template_directory() . '/widgets/recent-posts-a.php';
require get_template_directory() . '/widgets/recent-posts-b.php';
require get_template_directory() . '/widgets/recent-posts-c.php';
require get_template_directory() . '/widgets/recent-posts-d.php';
require get_template_directory() . '/widgets/recent-posts-slider.php';
require get_template_directory() . '/widgets/video-widget.php';
require get_template_directory() . '/widgets/recent-comments.php';
/**
 * Enqueue scripts and styles.
 */
function flymag_scripts() {
	wp_enqueue_style( 'flymag-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), true );
	if ( get_theme_mod( 'body_font_name' ) != '' ) {
		wp_enqueue_style( 'flymag-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'body_font_name' ) ) );
	} else {
		wp_enqueue_style( 'flymag-body-fonts', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic' );
	}
	if ( get_theme_mod( 'headings_font_name' ) != '' ) {
		wp_enqueue_style( 'flymag-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'headings_font_name' ) ) );
	} else {
		wp_enqueue_style( 'flymag-headings-fonts', '//fonts.googleapis.com/css?family=Oswald:400,300,700' );
	}
	wp_enqueue_style( 'flymag-style', get_stylesheet_uri() );
	wp_enqueue_style( 'flymag-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	wp_enqueue_script( 'flymag-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), true );
	wp_enqueue_script( 'flymag-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array(), true );
	wp_enqueue_script( 'flymag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( get_theme_mod( 'blog_layout' ) == 'masonry' ) {
		wp_enqueue_script( 'jquery-masonry' );
		wp_enqueue_script( 'flymag-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), true );
		wp_enqueue_script( 'flymag-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array(), true );
	}
	wp_enqueue_script( 'flymag-ticker', get_template_directory_uri() . '/js/jquery.easy-ticker.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'flymag-animations', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'flymag-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), true );
}

add_action( 'wp_enqueue_scripts', 'flymag_scripts' );
/**
 * Enqueue customizer custom style
 */
function flymag_customizer_custom_css() {
	wp_enqueue_style( 'flymag_customizer_custom_css', get_template_directory_uri() . '/css/flymag_customizer_style.css' );

}

add_action( 'customize_controls_print_styles', 'flymag_customizer_custom_css' );
/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';
/**
 * TGMPA register
 */
function flymag_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Orbit Fox',
			'slug'     => 'themeisle-companion',
			'required' => false,
		),

		array(
			'name'     => 'Pirate Forms',
			'slug'     => 'pirate-forms',
			'required' => false,
		),
	);
	$config  = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);
	tgmpa( $plugins, $config );

}

add_action( 'tgmpa_register', 'flymag_register_required_plugins' );

/**
 * Set custom classes for the top menu items.
 */
function flymag_nav_menu_css_class( $classes = array(), $item, $args ) {
	static $top_level_count = 0;
	if ( $args->theme_location == 'primary' ) {
		if ( $item->menu_item_parent == 0 ) {
			$top_level_count ++;
			if ( $item->menu_order >= 0 ) {
				$classes[] = 'custom-menu-item-' . $top_level_count % 5;
			}
		}
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'flymag_nav_menu_css_class', 10, 3 );
/**
 * Change the excerpt length
 */
function flymag_excerpt_length( $length ) {
	$excerpt = get_theme_mod( 'exc_lenght', '55' );

	return $excerpt;

}

add_filter( 'excerpt_length', 'flymag_excerpt_length', 999 );
/**
 * Menu fallback
 */
function flymag_menu_fallback() {
	echo '<a class="menu-fallback" href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Create your menu here', 'flymag' ) . '</a>';
}

/**
 * Load the color picker script on the widgets screen
 */
function flymag_color_picker( $hook ) {
	if ( 'widgets.php' != $hook ) {
		return;
	}
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'flymag-color-init', get_template_directory_uri() . '/js/color-init.js', array( 'jquery' ), true );
}

add_action( 'admin_enqueue_scripts', 'flymag_color_picker' );
/**
 * Displays first category of post
 */
function flymag_post_first_cat() {
	$category = get_the_category();
	/* translators: %s is category name */
	echo '<span class="post-cat"><i class="fa fa-folder"></i><a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( 'See all posts in %s', 'flymag' ), $category[0]->name ) . '">' . $category[0]->name . '</a></span>';
}

/**
 * Load html5shiv
 */
function flymag_html5shiv() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}

add_action( 'wp_head', 'flymag_html5shiv' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Load slider
 */
require get_template_directory() . '/inc/slider/slider.php';
/**
 * Load ticker
 */
require get_template_directory() . '/inc/ticker.php';
/**
 * Dynamic styles
 */
require get_template_directory() . '/styles.php';
/**
 *  Customizer info
 */
require_once get_template_directory() . '/inc/customizer-info/class/class-singleton-customizer-info-section.php';
