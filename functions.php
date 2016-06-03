<?php
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
	add_image_size('carousel-thumb', 600, 400, true);
	add_image_size('entry-thumb', 820);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 	=> __( 'Primary Menu', 'flymag' ),
		'social' 	=> __( 'Social', 'flymag' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'flymag_custom_background_args', array(
		'default-color' => 'f5f5f5',
		'default-image' => '',
	) ) );
}
endif; // flymag_setup
add_action( 'after_setup_theme', 'flymag_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function flymag_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'flymag' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Home page', 'flymag' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Widgets added here will be displayed on pages using the Front Page template', 'flymag' ),
		'before_widget' => '<aside id="%1$s" class="widget wow fadeIn %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Home page top', 'flymag' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Widgets added here will be displayed above the main content area and sidebar on pages using the Front Page template', 'flymag' ),
		'before_widget' => '<aside id="%1$s" class="widget wow fadeIn %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer left', 'flymag' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer center', 'flymag' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer right', 'flymag' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Custom widgets
	register_widget( 'Flymag_Recent_A' );
	register_widget( 'Flymag_Recent_B' );
	register_widget( 'Flymag_Recent_C' );
	register_widget( 'Flymag_Recent_D' );
	register_widget( 'Flymag_Recent_Slider' );
	register_widget( 'Flymag_Video' );
	register_widget( 'Flymag_Recent_Comments' );

}
add_action( 'widgets_init', 'flymag_widgets_init' );

//Custom widgets
require get_template_directory() . "/widgets/recent-posts-a.php";
require get_template_directory() . "/widgets/recent-posts-b.php";
require get_template_directory() . "/widgets/recent-posts-c.php";
require get_template_directory() . "/widgets/recent-posts-d.php";
require get_template_directory() . "/widgets/recent-posts-slider.php";
require get_template_directory() . "/widgets/video-widget.php";
require get_template_directory() . "/widgets/recent-comments.php";

/**
 * Enqueue scripts and styles.
 */
function flymag_scripts() {

	wp_enqueue_style( 'flymag-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), true );

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'flymag-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) );
	} else {
	    wp_enqueue_style( 'flymag-body-fonts', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'flymag-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) );
	} else {
	    wp_enqueue_style( 'flymag-headings-fonts', '//fonts.googleapis.com/css?family=Oswald:400,300,700');
	}

	wp_enqueue_style( 'flymag-style', get_stylesheet_uri() );

	wp_enqueue_style( 'flymag-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'flymag-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), true );

	wp_enqueue_script( 'flymag-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array(), true );

	wp_enqueue_script( 'flymag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod('blog_layout') == 'masonry' ) {

		wp_enqueue_script( 'jquery-masonry');

		wp_enqueue_script( 'flymag-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), true );

		wp_enqueue_script( 'flymag-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array(), true );
	}

	wp_enqueue_script( 'flymag-ticker', get_template_directory_uri() . '/js/jquery.easy-ticker.min.js', array('jquery'), true );

	wp_enqueue_script( 'flymag-animations', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), true );

	wp_enqueue_script( 'flymag-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );
}
add_action( 'wp_enqueue_scripts', 'flymag_scripts' );


/**
* Enqueue customizer custom style
*/
function flymag_customizer_custom_css() {

    wp_enqueue_style('flymag_customizer_custom_css', get_template_directory_uri() . '/css/flymag_customizer_style.css');

}
add_action('customize_controls_print_styles', 'flymag_customizer_custom_css');

/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function flymag_register_required_plugins() {
		$plugins = array(

			array(
				'name'      => 'WP Product Review',
				'slug'      => 'wp-product-review',
				'required'  => false,
			),

			array(
					'name'      => 'Login customizer',
					'slug'      => 'login-customizer',
					'required'  => false,
			),

			array(
				'name'      => 'Intergeo Maps - Google Maps Plugin',
				'slug'      => 'intergeo-maps',
				'required'  => false
			),

			array(
				'name'     => 'Pirate Forms',
				'slug' 	   => 'pirate-forms',
				'required' => false
			));

	$config = array(
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'flymag' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'flymag' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'flymag' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'flymag' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'flymag' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'flymag' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'flymag' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'flymag' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'flymag' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'flymag' ),
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'flymag' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'flymag' ),
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'flymag' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'flymag' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'flymag' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'flymag' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'flymag' ),
            'nag_type'                        => 'updated'
        )
    );

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'flymag_register_required_plugins' );


/**
 * Set custom classes for the top menu items.
 */
function flymag_nav_menu_css_class( $classes = array(), $item, $args ) {
	static $top_level_count = 0;

    if($args->theme_location == 'primary'){

        if ( $item->menu_item_parent == 0 ) {
			$top_level_count++;

            if ($item->menu_order >= 0) {
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

  $excerpt = get_theme_mod('exc_lenght', '55');
  return $excerpt;

}
add_filter( 'excerpt_length', 'flymag_excerpt_length', 999 );

/**
 * Menu fallback
 */
function flymag_menu_fallback() {
	echo '<a class="menu-fallback" href="' . admin_url('nav-menus.php') . '">' . __( 'Create your menu here', 'flymag' ) . '</a>';
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
	wp_enqueue_script( 'flymag-color-init', get_template_directory_uri() . '/js/color-init.js', array('jquery'), true );
}
add_action( 'admin_enqueue_scripts', 'flymag_color_picker' );

/**
 * Displays first category of post
 */
function flymag_post_first_cat() {
	$category = get_the_category();
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
