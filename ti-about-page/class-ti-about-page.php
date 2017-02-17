<?php
/**
 * ThemeIsle - About page class
 *
 * Example of config array with all parameters ( This needs to be defined in the theme's functions.php:
 *
 *        TI About page register example.
 *
 *        $config = array(
 *            // Menu name under Appearance.
 *            'menu_name'               => __( 'About Flymag', 'flymag' ),
 *            // Page title.
 *            'page_name'               => __( 'Flymag Intro', 'flymag' ),
 *            // Small description of the theme.
 *            'theme_short_description' => __( 'Our best free magazine WordPress theme, FlyMag!', 'flymag' ),
 *            // Url of the documentation.
 *            'documentation'           => 'http://docs.themeisle.com/article/310-flymag-documentation',
 *            // Github repository url
 *            'github'                  => 'https://github.com/Codeinwp/flymag',
 *            // Translation url.
 *            'translations_wporg'      => 'https://translate.wordpress.org/projects/wp-themes/flymag',
 *            // Review url.
 *            'review_wporg'            => 'https://wordpress.org/support/view/theme-reviews/flymag',
 *             //Tabs array.
 *             //
 *             // The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
 *             // the will be the name of the function which will be used to render the tab content.
 *            'tabs'                    => array(
 *                'getting_started'  => __( 'Getting started', 'flymag' ),
 *                'actions_required' => __( 'Actions required', 'flymag' ),
 *                'child_themes'     => __( 'Child themes', 'flymag' ),
 *                'contribute'       => __( 'Contribute', 'flymag' ),
 *                'changelog'        => __( 'Changelog', 'flymag' ),
 *                'free_pro'         => __( 'Free VS PRO', 'flymag' ),
 *            ),
 *            // Contribute content tab.
 *            'contribute_content'      => array(
 *                'title'               => __( 'How can I contribute?', 'flymag' ),
 *                'github_content'      => '<p><strong>' . __( 'Found a bug? Want to contribute with a fix or create a new feature?', 'flymag' ) . '</strong></p><p>' . __( 'GitHub is the place to go!', 'flymag' ) . '</p><p><a href="https://github.com/Codeinwp/flymag" class="github-button button button-primary">' . sprintf( __( '%s on GitHub', 'flymag' ), 'FlyMag' ) . '</a></p>',
 *                'translation_content' => '<p><strong>' . sprintf( __( 'Are you a polyglot? Want to translate %s into your own language?', 'flymag' ), 'FlyMag' ) . '</strong></p><p>' . __( 'Get involved at WordPress.org.', 'flymag' ) . '</p><p><a href="https://translate.wordpress.org/projects/wp-themes/flymag" class="translate-button button button-primary">' . sprintf( __( 'Translate %s', 'flymag' ), 'FlyMag' ) . '</a></p>',
 *                'review_content'      => '<h4>' . sprintf( __( 'Are you enjoying %s?', 'flymag' ), 'FlyMag' ) . '</h4><p class="review-link">' . sprintf( __( 'Rate our theme on %1$sWordPress.org%2$s. We\'d really appreciate it!', 'flymag' ), '<a href="https://wordpress.org/support/view/theme-reviews/flymag">', '</a>' ) . '</p><p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>',
 *            ),
 *            // Getting started tab content.
 *            'getting_started_content' => array(
 *                'welcome_title'         => sprintf( __( 'Welcome to %s', 'flymag' ), 'FlyMag' ),
 *                'welcome_content'       => sprintf( __( 'We want to make sure you have the best experience using %1$s and that is why we gathered here all the necessary informations for you. We hope you will enjoy using %2$s, as much as we enjoy creating great products.', 'flymag' ), 'FlyMag', 'FlyMag' ),
 *                'customizer_content'    => '<h1>' . __( 'Getting started', 'flymag' ) . '</h1><h4>' . __( 'Customize everything in a single place.', 'flymag' ) . '</h4><p>' . __( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'flymag' ) . '</p><p><a href="' . esc_url( admin_url( 'customize.php' ) ) . '" class="button button-primary">' . __( 'Go to Customizer', 'flymag' ) . '</a></p>',
 *                'documentation_content' => '<h1>' . __( 'View full documentation', 'flymag' ) . '</h1><p>' . sprintf( __( 'Need more details? Please check our full documentation for detailed information on how to use %s.', 'flymag' ), 'FlyMag' ) . '</p><p><a href="' . esc_url( 'http://docs.themeisle.com/article/310-flymag-documentation' ) . '" class="button button-primary">' . __( 'Read full documentation', 'flymag' ) . '</a></p>',
 *            ),
 *            // Child themes array.
 *            'child_themes'            => array(
 *                'title'                 => __( 'List of child themes to use with Flymag', 'flymag' ),
 *                'download_button_label' => 'Download',
 *                'preview_button_label'  => 'Live preview',
 *                'content'               => array(
 *                    array(
 *                        'title'         => 'Flymag child theme 1',
 *                        'image'         => 'https://github.com/Codeinwp/zerif-lite/blob/production/inc/admin/welcome-screen/img/zblackbeard.jpg?raw=true',
 *                        'image_alt'     => 'Image of the child theme',
 *                        'description'   => 'Description',
 *                        'download_link' => 'Download link',
 *                        'preview_link'  => 'Preview link',
 *                    ),
 *                    array(
 *                        'title'         => 'Flymag child theme 2',
 *                        'image'         => 'https://github.com/Codeinwp/zerif-lite/blob/production/inc/admin/welcome-screen/img/zblackbeard.jpg?raw=true',
 *                        'image_alt'     => 'Image of the child theme',
 *                        'description'   => 'Description',
 *                        'download_link' => 'Download link',
 *                        'preview_link'  => 'Preview link',
 *                    ),
 *                ),
 *            ),
 *            // Free vs pro array.
 *            'free_pro'                => array(
 *                'free_theme_name'     => 'FlyMag',
 *                'pro_theme_name'      => 'FlyMag PRO',
 *                'pro_theme_link'      => 'https://themeisle.com/themes/flymag-pro/',
 *                'get_pro_theme_label' => sprintf( __( 'Get %s now!', 'flymag' ), 'FlyMag Pro' ),
 *                'features'            => array(
 *                    array(
 *                        'title'       => __( 'Mobile friendly', 'flymag' ),
 *                        'description' => __( 'Responsive layout. Works on every device.', 'flymag' ),
 *                        'is_in_lite'  => 'true',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Unlimited color option', 'flymag' ),
 *                        'description' => __( 'You can change the colors of each section. You have unlimited options.', 'flymag' ),
 *                        'is_in_lite'  => 'true',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Background image', 'flymag' ),
 *                        'description' => __( 'You can use any background image you want.', 'flymag' ),
 *                        'is_in_lite'  => 'true',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Featured Area', 'flymag' ),
 *                        'description' => __( 'Have access to a new featured area.', 'flymag' ),
 *                        'is_in_lite'  => 'false',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Footer credits', 'flymag' ),
 *                        'description' => '',
 *                        'is_in_lite'  => 'false',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Extra widgets areas', 'flymag' ),
 *                        'description' => __( 'More widgets areas for your theme.', 'flymag' ),
 *                        'is_in_lite'  => 'false',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Support', 'flymag' ),
 *                        'description' => __( 'You will benefit of our full support for any issues you have with the theme.', 'flymag' ),
 *                        'is_in_lite'  => 'false',
 *                        'is_in_pro'   => 'true',
 *                    ),
 *                ),
 *            ),
 *            // Important docs array.
 *            'docs'                    => array(
 *                'title'   => __( 'FAQ', 'flymag' ),
 *                'content' => array(
 *                    array(
 *                        'title'       => __( 'Create a child theme', 'flymag' ),
 *                        'description' => __( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below', 'flymag' ),
 *                        'link_url'    => 'http://docs.themeisle.com/article/14-how-to-create-a-child-theme/',
 *                        'link_label'  => __( 'View how to do this', 'flymag' ),
 *                    ),
 *                    array(
 *                        'title'       => __( 'Build a landing page with a drag-and-drop content builder', 'flymag' ),
 *                        'description' => __( 'In the below documentation you will find an easy way to build a great looking landing page using a drag-and-drop content builder plugin.', 'flymag' ),
 *                        'link_url'    => 'http://docs.themeisle.com/article/219-how-to-build-a-landing-page-with-a-drag-and-drop-content-builder',
 *                        'link_label'  => __( 'View how to do this', 'flymag' ),
 *                    ),
 *                    array(
 *                        'title'       => __( 'Speed up your site', 'flymag' ),
 *                        'description' => __( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.', 'flymag' ),
 *                        'link_url'    => 'http://docs.themeisle.com/article/63-speed-up-your-wordpress-site/',
 *                        'link_label'  => __( 'View how to do this', 'flymag' ),
 *                    ),
 *                    array(
 *                        'title'       => __( 'How to Internationalize Your Website', 'flymag' ),
 *                        'description' => __( 'Although English is the most used language on the internet, you should consider all your web users as well. Find out what it takes to make your website ready for foreign markets from this document.', 'flymag' ),
 *                        'link_url'    => 'http://docs.themeisle.com/article/80-how-to-translate-zerif',
 *                        'link_label'  => __( 'View how to do this', 'flymag' ),
 *                    ),
 *                ),
 *            ),
 *            // Plugins array.
 *            'plugins'                 => array(
 *                'title'                     => __( 'Recommended plugins', 'flymag' ),
 *                'already_activated_message' => __( 'Already activated', 'flymag' ),
 *                'content'                   => array(
 *                    array(
 *                        'title'       => __( 'Pirate Forms', 'flymag' ),
 *                        'description' => __( 'Makes your contact page more engaging by creating a good-looking contact form on your website. The interaction with your visitors was never easier.', 'flymag' ),
 *                        'link_label'  => __( 'Install Pirate Forms', 'flymag' ),
 *                        'check'       => defined( 'PIRATE_FORMS_VERSION' ),
 *                        'slug'        => 'pirate-forms',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Easy Content Types', 'flymag' ),
 *                        'description' => __( 'Custom Post Types, Taxonomies and Metaboxes in Minutes.', 'flymag' ),
 *                        'link_label'  => __( 'Download Easy Content Types', 'flymag' ),
 *                        'check'       => defined( 'ECPT_PLUGIN_VERSION' ),
 *                        'link'        => 'http://themeisle.com/plugins/easy-content-types/',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Page Builder by SiteOrigin', 'flymag' ),
 *                        'description' => __( 'Build responsive page layouts using the widgets you know and love using this simple drag and drop page builder.', 'flymag' ),
 *                        'link_label'  => __( 'Install Page Builder by SiteOrigin', 'flymag' ),
 *                        'check'       => defined( 'SITEORIGIN_PANELS_VERSION' ),
 *                        'slug'        => 'siteorigin-panels',
 *                    ),
 *                    array(
 *                        'title'       => __( 'Intergeo Maps - Google Maps Plugin', 'flymag' ),
 *                        'description' => '',
 *                        'link_label'  => __( 'Install Intergeo Maps', 'flymag' ),
 *                        'check'       => defined( 'INTERGEO_PLUGIN_NAME' ),
 *                        'slug'        => 'intergeo-maps',
 *                    ),
 *                ),
 *            ),
 *            // Required actions array.
 *            'required_actions'        => array(
 *                'title'              => sprintf( __( 'Keep up with %s\'s latest news', 'flymag' ), 'FlyMag' ),
 *                'no_actions_message' => __( 'Hooray! There are no required actions for you right now.', 'flymag' ),
 *                'content'            => array(
 *                    'pirate-forms' => array(
 *                        'title'       => __( 'Pirate Forms', 'flymag' ),
 *                        'description' => __( 'Makes your contact page more engaging by creating a good-looking contact form on your website. The interaction with your visitors was never easier.', 'flymag' ),
 *                        'link_label'  => __( 'Install Pirate Forms', 'flymag' ),
 *                        'check'       => defined( 'PIRATE_FORMS_VERSION' ),
 *                        'id'          => 'pirate-forms',
 *                    ),
 *                ),
 *            ),
 *        );
 *        TI_About_Page::init( $config );
 *
 * @package Themeisle
 * @subpackage Admin
 * @since 1.0.0
 */
if ( ! class_exists( 'TI_About_Page' ) ) {
	/**
	 * Singleton class used for generating the about page of the theme.
	 */
	class TI_About_Page {
		/**
		 * Define the version of the class.
		 *
		 * @var string $version The TI_About_Page class version.
		 */
		private $version = '1.0.0';
		/**
		 * Used for loading the texts and setup the actions inside the page.
		 *
		 * @var array $config The configuration array for the theme used.
		 */
		private $config;
		/**
		 * Get the theme name using wp_get_theme.
		 *
		 * @var string $theme_name The theme name.
		 */
		private $theme_name;
		/**
		 * Get the theme slug ( theme folder name ).
		 *
		 * @var string $theme_slug The theme slug.
		 */
		private $theme_slug;
		/**
		 * The current theme object.
		 *
		 * @var WP_Theme $theme The current theme.
		 */
		private $theme;
		/**
		 * Holds the theme version.
		 *
		 * @var string $theme_version The theme version.
		 */
		private $theme_version;
		/**
		 * Define the menu item name for the page.
		 *
		 * @var string $menu_name The name of the menu name under Appearance settings.
		 */
		private $menu_name;
		/**
		 * Define the page title name.
		 *
		 * @var string $page_name The title of the About page.
		 */
		private $page_name;
		/**
		 * Define the page tabs.
		 *
		 * @var array $tabs The page tabs.
		 */
		private $tabs;
		/**
		 * Define the html notification content displayed upon activation.
		 *
		 * @var string $notification The html notification content.
		 */
		private $notification;
		/**
		 * The single instance of TI_About_Page
		 *
		 * @var TI_About_Page $instance The  TI_About_Page instance.
		 */
		private static $instance;

		/**
		 * The Main TI_About_Page instance.
		 *
		 * We make sure that only one instance of TI_About_Page exists in the memory at one time.
		 *
		 * @param array $config The configuration array.
		 */
		public static function init( $config ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof TI_About_Page ) ) {
				self::$instance = new TI_About_Page;
				if ( ! empty( $config ) && is_array( $config ) ) {
					self::$instance->config = $config;
					self::$instance->setup_config();
					self::$instance->setup_actions();
				}
			}

		}

		/**
		 * Setup the class props based on the config array.
		 */
		public function setup_config() {
			$theme = wp_get_theme();
			if ( is_child_theme() ) {
				$this->theme_name = $theme->parent()->get( 'Name' );
				$this->theme      = $theme->parent();
			} else {
				$this->theme_name = $theme->get( 'Name' );
				$this->theme      = $theme->parent();
			}
			$this->theme_version = $theme->get( 'Version' );
			$this->theme_slug    = $theme->get_template();
			$this->menu_name     = isset( $this->config['menu_name'] ) ? $this->config['menu_name'] : 'About ' . $this->theme_name;
			$this->page_name     = isset( $this->config['page_name'] ) ? $this->config['page_name'] : 'About ' . $this->theme_name;
			$this->notification  = isset( $this->config['notification'] ) ? $this->config['notification'] : ( '<p>' . sprintf( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%3$s.', $this->theme_name, '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-welcome' ) ) . '">', '</a>' ) . '</p><p><a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-welcome' ) ) . '" class="button" style="text-decoration: none;">' . sprintf( 'Get started with %s', $this->theme_name ) . '</a></p>' );
			$this->tabs          = isset( $this->config['tabs'] ) ? $this->config['tabs'] : array();

		}

		/**
		 * Validate the tabs.
		 *
		 * Some tabs dont need to show up if some actions have been done so we use this to
		 * keep only the valid ones.
		 *
		 * @param array $tabs Defined tabs.
		 *
		 * @return array The valid tabs.
		 */
		public function validate_tabs( $tabs = array() ) {
			$new_tabs = array();
			foreach ( $tabs as $tab_key => $tab_title ) {
				$show = apply_filters( 'ti_about_tab_show', true, $tab_key );
				if ( $show ) {
					$new_tabs[ $tab_key ] = $tab_title;
				}
			}

			return $new_tabs;
		}

		/**
		 * Setup the actions used for this page.
		 */
		public function setup_actions() {
			add_filter( 'ti_about_tab_show', array( $this, 'hide_required' ), 11, 2 );
			add_filter( 'ti_about_tab_show', array( $this, 'hide_childs' ), 12, 2 );
			add_filter( 'ti_about_tab_show', array( $this, 'hide_free_pro' ), 13, 2 );
			add_action( 'admin_menu', array( $this, 'register' ) );
			/* activation notice */
			add_action( 'load-themes.php', array( $this, 'activation_admin_notice' ) );
			/* enqueue script and style for about page */
			add_action( 'admin_enqueue_scripts', array( $this, 'style_and_scripts' ) );
			$this->tabs = $this->validate_tabs( $this->tabs );
			/* load main content for about page */
			$i = 0;
			foreach ( $this->tabs as $tab_key => $tab_title ) {
				$i ++;
				if ( method_exists( $this, $tab_key ) ) {
					add_action( 'ti_about_page', array( $this, $tab_key ), 10 * $i );
				} else {
					// Render custom tabs outside the class.
					if ( function_exists( $tab_key ) ) {
						add_action( 'ti_about_page', $tab_key, 10 * $i );
					}
				}
			}
			add_action( 'wp_ajax_ti_about_page_dismiss_required_action', array(
				$this,
				'dismiss_required_action_callback',
			) );
		}

		/**
		 * Hide required tab if no actions present.
		 *
		 * @return bool Either hide the tab or not.
		 */
		public function hide_required( $value, $tab ) {
			if ( $tab != 'actions_required' ) {
				return $value;
			}
			$required = $this->get_required_actions();
			if ( count( $required ) == 0 ) {
				return false;
			} else {
				return true;
			}
		}

		/**
		 * Hide child themes if empty.
		 *
		 * @return bool Either hide the tab or not.
		 */
		public function hide_childs( $value, $tab ) {
			if ( $tab != 'child_themes' ) {
				return $value;
			}
			$required = isset( $this->config['child_themes'] ) ? $this->config['child_themes'] : array();
			$required = isset( $required['content'] ) ? $required['content'] : array();
			if ( count( $required ) == 0 ) {
				return false;
			} else {
				return true;
			}
		}
		/**
		 * Hide free pro tab if empty.
		 *
		 * @return bool Either hide the tab or not.
		 */
		public function hide_free_pro( $value, $tab ) {
			if ( $tab != 'free_pro' ) {
				return $value;
			}
			$required = isset( $this->config['free_pro'] ) ? $this->config['free_pro'] : array();
			$required = isset( $required['features'] ) ? $required['features'] : array();
			if ( count( $required ) == 0 ) {
				return false;
			} else {
				return true;
			}
		}

		/**
		 * Register the menu page under Appearance menu.
		 */
		function register() {
			if ( ! empty( $this->menu_name ) && ! empty( $this->page_name ) ) {
				add_theme_page( $this->menu_name, $this->page_name, 'activate_plugins', $this->theme_slug . '-welcome', array(
					$this,
					'ti_about_page_render',
				) );
			}
		}

		/**
		 * Adds an admin notice upon successful activation.
		 */
		public function activation_admin_notice() {
			global $pagenow;
			if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
				add_action( 'admin_notices', array( $this, 'ti_about_page_welcome_admin_notice' ), 99 );
			}
		}

		/**
		 * Display an admin notice linking to the about page
		 */
		public function ti_about_page_welcome_admin_notice() {
			if ( ! empty( $this->notification ) ) {
				echo '<div class="updated notice is-dismissible">';
				echo wp_kses_post( $this->notification );
				echo '</div>';
			}
		}

		/**
		 * Render the main content page.
		 */
		public function ti_about_page_render() {
			if ( ! empty( $this->tabs ) ) {
				?>
				<ul class="ti-about-page-nav-tabs" role="tablist">
					<?php
					foreach ( $this->tabs as $tab_key => $tab_name ) {
						?>
						<li role="presentation" id="<?php echo $tab_key; ?>_handle"><a href="#<?php echo $tab_key; ?>"
						                                                               aria-controls="<?php echo $tab_key; ?>"
						                                                               role="tab"
						                                                               data-toggle="tab"><?php echo esc_html( $tab_name ); ?></a>
						</li>
					<?php } ?>
				</ul>
				<div class="ti-about-page-tab-content">
					<?php
					/**
					 * Render the tabs panels.
					 */
					do_action( 'ti_about_page' );
					?>
				</div>
				<?php
			}

		}

		/**
		 * Render getting started content.
		 */
		public function getting_started() {
			if ( ! empty( $this->config['getting_started_content'] ) ) {
				$getting_started = $this->config['getting_started_content'];
				echo '<div id="getting_started" class="ti-about-page-tab-pane active">';
				echo '<div class="ti-about-page-tab-pane-center">';
				if ( ! empty( $getting_started['welcome_title'] ) ) {
					echo '<h1 class="ti-about-page-welcome-title">';
					echo esc_html( $getting_started['welcome_title'] );
					if ( ! empty( $this->theme_version ) ) {
						echo '<sup id="ti-about-page-theme-version">' . esc_html( $this->theme_version ) . ' </sup>';
					}
					echo '</h1>';
				}
				if ( ! empty( $this->config['theme_short_description'] ) ) {
					echo '<p>' . wp_kses_post( $this->config['theme_short_description'] ) . '</p>';
				}
				if ( ! empty( $getting_started['welcome_content'] ) ) {
					echo '<p>' . wp_kses_post( $getting_started['welcome_content'] ) . '</p>';
				}
				echo '</div>';
				echo '<hr />';
				if ( ! empty( $getting_started['customizer_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-center">';
					echo wp_kses_post( $getting_started['customizer_content'] );
					echo '</div>';
					echo '<hr />';
				}
				/* DOCS */
				$this->docs_display();
				echo '<div class="ti-about-page-clear"></div>';
				echo '<hr />';
				/* Documentation */
				$this->page_documentation();
				echo '<hr />';
				/* PLUGINS */
				$this->plugins_display();
				echo '<div class="ti-about-page-clear"></div>';
				echo '</div>';
			} // End if().
		}

		/**
		 * Actions required tab
		 */
		public function actions_required() {
			$req_actions = isset( $this->config['required_actions'] ) ? $this->config['required_actions'] : array();
			if ( ! empty( $req_actions ) ) {
				echo '<div id="actions_required" class="ti-about-page-tab-pane">';
				if ( ! empty( $req_actions['title'] ) ) {
					echo '<h1>' . esc_html( $req_actions['title'] ) . '</h1>';
					echo '<hr />';

				}
				$actions = $this->get_required_actions();
				if ( ! empty( $actions ) && is_array( $actions ) ) {
					foreach ( $actions as $action_key => $action_value ) {
						echo '<div class="ti-about-page-action-required-box">';
						echo '<span class="dashicons dashicons-no-alt ti-about-page-dismiss-required-action" id="' . esc_attr( $action_value['id'] ) . '"></span>';
						echo '<h4>' . ( $action_key + 1 ) . '.';
						if ( ! empty( $action_value['title'] ) ) {
							echo wp_kses_post( $action_value['title'] );
						}
						echo '</h4>';
						echo '<p>';
						if ( ! empty( $action_value['description'] ) ) {
							echo wp_kses_post( $action_value['description'] );
						}
						echo '</p>';
						if ( ! empty( $action_value['plugin_slug'] ) ) {
							echo '<p>';
							echo '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $action_value['plugin_slug'] ), 'install-plugin_' . $action_value['plugin_slug'] ) ) . '" class="button button-primary">';
							if ( ! empty( $action_value['title'] ) ) {
								echo wp_kses_post( $action_value['title'] );
							}
							echo '</a>';
							echo '</p>';
						}
						echo '<hr/>';
						echo '</div>';
					}
				}
				if ( count( $actions ) == 0 && ! empty( $req_actions['no_actions_message'] ) ) {
					echo '<p>' . wp_kses_post( $req_actions['no_actions_message'] ) . '</p>';
				}
				echo '</div>';
			} // End if().
		}

		/**
		 * Child themes
		 */
		public function child_themes() {
			echo '<div id="child_themes" class="ti-about-page-tab-pane">';
			$child_themes = isset( $this->config['child_themes'] ) ? $this->config['child_themes'] : array();
			if ( ! empty( $child_themes ) ) {
				if ( ! empty( $child_themes['content'] ) && is_array( $child_themes['content'] ) ) {
					if ( ! empty( $child_themes['title'] ) ) {
						echo '<div class="ti-about-page-tab-pane-center">';
						echo esc_html( $child_themes['title'] );
						echo '</div>';
					}
					echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
					for ( $i = 0; $i < count( $child_themes['content'] ); $i ++ ) {
						if ( $i == ceil( count( $child_themes['content'] ) / 2 ) ) {
							echo '</div>';
							echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
						}
						$child = $child_themes['content'][ $i ];
						if ( ! empty( $child['image'] ) ) {
							echo '<div class="ti-about-page-child-theme-container">';
							echo '<div class="ti-about-page-child-theme-image-container">';
							echo '<img src="' . esc_url( $child['image'] ) . '" alt="' . ( ! empty( $child['image_alt'] ) ? esc_html( $child['image_alt'] ) : '' ) . '" />';
							if ( ! empty( $child['description'] ) ) {
								echo '<div class="ti-about-page-child-theme-description">';
								echo '<h2>' . wp_kses_post( $child['description'] ) . '</h2>';
								echo '</div>';
							}
							if ( ! empty( $child['title'] ) ) {
								echo '<div class="ti-about-page-child-theme-details">';
								if ( $child['title'] != $this->theme_name ) {
									echo '<div class="theme-details">';
									echo '<span class="theme-name">' . $child['title'] . '</span>';
									if ( ! empty( $child['download_link'] ) && ! empty( $child_themes['download_button_label'] ) ) {
										echo '<a href="' . esc_url( $child['download_link'] ) . '" class="button button-primary install right">' . esc_html( $child_themes['download_button_label'] ) . '</a>';
									}
									if ( ! empty( $child['preview_link'] ) && ! empty( $child_themes['preview_button_label'] ) ) {
										echo '<a class="button button-secondary preview right" target="_blank" href="' . $child['preview_link'] . '">' . esc_html( $child_themes['preview_button_label'] ) . '</a>';
									}
									echo '<div class="ti-about-page-clear"></div>';
									echo '</div>';
								}
								echo '</div>';
							}
							echo '</div><!-- .ti-about-page-child-theme-image-container -->';
							echo '</div><!-- .ti-about-page-child-theme-container -->';
						}// End if().
					}// End for().
					echo '</div>';
				}// End if().
			}// End if().
			echo '</div>';
		}

		/**
		 * Contribute tab
		 */
		public function contribute() {
			echo '<div id="contribute" class="ti-about-page-tab-pane">';
			if ( ! empty( $this->config['contribute_content'] ) ) {
				if ( ! empty( $this->config['contribute_content']['title'] ) ) {
					echo '<h1>' . wp_kses_post( $this->config['contribute_content']['title'] ) . '</h1><hr />';
				}
			}
			$this->github();
			$this->wporg_translations();
			$this->wporg_reviews();
			echo '</div>';
		}

		/**
		 * Changelog tab
		 */
		public function changelog() {
			echo '<div class="ti-about-page-tab-pane" id="changelog">';
			echo '<div class="ti-about-page-tab-pane-center">';
			echo '<h1>' . esc_html( $this->theme_name );
			echo '<sup id="ti-about-page-theme-version">' . esc_attr( $this->theme_version ) . '</sup>';
			echo '</h1>';
			echo '</div>';
			$changelog = $this->parse_changelog();
			foreach ( $changelog as $release ) {
				echo ' <hr /><h1>' . $release['title'] . ' </h1 > ';
				echo implode( '<br/>', $release['changes'] );
			}
			echo '</div > ';

		}

		/**
		 * Return the releases changes array.
		 *
		 * @return array The releases array.
		 */
		private function parse_changelog() {
			WP_Filesystem();
			global $wp_filesystem;
			$changelog = $wp_filesystem->get_contents( get_template_directory() . '/CHANGELOG.md' );
			if ( is_wp_error( $changelog ) ) {
				$changelog = '';
			}
			$changelog = explode( PHP_EOL, $changelog );
			$releases  = array();
			foreach ( $changelog as $changelog_line ) {
				if ( strpos( $changelog_line, '**Changes:**' ) !== false || empty( $changelog_line ) ) {
					continue;
				}
				if ( substr( $changelog_line, 0, 3 ) === '###' ) {
					if ( isset( $release ) ) {
						$releases[] = $release;
					}
					$release = array(
						'title'   => substr( $changelog_line, 3 ),
						'changes' => array(),
					);
				} else {
					$release['changes'][] = $changelog_line;
				}
			}

			return $releases;
		}

		/**
		 * Free vs PRO tab
		 */
		public function free_pro() {
			$free_pro = isset( $this->config['free_pro'] ) ? $this->config['free_pro'] : array();
			if ( ! empty( $free_pro ) ) {
				if ( ! empty( $free_pro['free_theme_name'] ) && ! empty( $free_pro['pro_theme_name'] ) && ! empty( $free_pro['features'] ) && is_array( $free_pro['features'] ) ) {
					echo '<div id="free_pro" class="ti-about-page-tab-pane ti-about-page-fre-pro">';
					echo '<table>';
					echo '<thead>';
					echo '<tr>';
					echo '<th></th>';
					echo '<th>' . esc_html( $free_pro['free_theme_name'] ) . '</th>';
					echo '<th>' . esc_html( $free_pro['pro_theme_name'] ) . '</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					foreach ( $free_pro['features'] as $feature ) {
						echo '<tr>';
						if ( ! empty( $feature['title'] ) || ! empty( $feature['description'] ) ) {
							echo '<td>';
							if ( ! empty( $feature['title'] ) ) {
								echo '<h3>' . wp_kses_post( $feature['title'] ) . '</h3>';
							}
							if ( ! empty( $feature['description'] ) ) {
								echo '<p>' . wp_kses_post( $feature['description'] ) . '</p>';
							}
							echo '</td>';
						}
						if ( ! empty( $feature['is_in_lite'] ) && ( $feature['is_in_lite'] == 'true' ) ) {
							echo '<td><span class="dashicons-before dashicons-yes"></span></td>';
						} else {
							echo '<td><span class="dashicons-before dashicons-no-alt"></span></td>';
						}
						if ( ! empty( $feature['is_in_pro'] ) && ( $feature['is_in_pro'] == 'true' ) ) {
							echo '<td><span class="dashicons-before dashicons-yes"></span></td>';
						} else {
							echo '<td><span class="dashicons-before dashicons-no-alt"></span></td>';
						}
						echo '</tr>';

					}
					if ( ! empty( $free_pro['pro_theme_link'] ) && ! empty( $free_pro['get_pro_theme_label'] ) ) {
						echo '<tr class="ti-about-page-text-center">';
						echo '<td colspan="3"><a href="' . esc_url( $free_pro['pro_theme_link'] ) . '" target="_blank" class="button button-primary">' . wp_kses_post( $free_pro['get_pro_theme_label'] ) . '</a></td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					echo '</div>';

				}// End if().
			}// End if().
		}

		/**
		 * Recommended docs section
		 */
		public function docs_display() {
			$docs = isset( $this->config['docs'] ) ? $this->config['docs'] : array();
			if ( ! empty( $docs ) ) {
				if ( ! empty( $docs ['content'] ) && is_array( $docs ['content'] ) ) {
					if ( ! empty( $docs['title'] ) ) {
						echo '<div class="ti-about-page-tab-pane-center">';
						echo '<h1>' . wp_kses_post( $docs['title'] ) . '</h1>';
						echo '</div>';
					}
					echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
					for ( $i = 0; $i < count( $docs['content'] ); $i ++ ) {
						$doc = $docs['content'][ $i ];
						if ( $i == ceil( count( $docs['content'] ) / 2 ) ) {
							echo '</div>';
							echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
						}
						if ( ! empty( $doc['title'] ) ) {
							echo '<h4>' . wp_kses_post( $doc['title'] ) . '</h4>';
						}
						if ( ! empty( $doc['description'] ) ) {
							echo '<p>' . wp_kses_post( $doc['description'] ) . '</p>';
						}
						if ( ! empty( $doc['link_url'] ) && ! empty( $doc['link_label'] ) ) {
							echo '<p><a target="_blank" href="' . esc_url( $doc['link_url'] ) . '" class="button">' . esc_html( $doc['link_label'] ) . '</a></p>';
						}
					}
					echo '</div>';
				}
			}

		}

		/**
		 * Recommended plugins section.
		 */
		public function plugins_display() {
			$plugins = $this->config['plugins'];
			if ( ! empty( $plugins ) ) {
				if ( ! empty( $plugins['content'] ) && is_array( $plugins['content'] ) ) {
					if ( ! empty( $plugins['title'] ) ) {
						echo '<div class="ti-about-page-tab-pane-center">';
						echo '<h1>' . wp_kses_post( $plugins['title'] ) . '</h1>';
						echo '</div>';
					}
					echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
					for ( $i = 0; $i < count( $plugins['content'] ); $i ++ ) {
						$plugin = $plugins['content'][ $i ];
						if ( $i == ceil( count( $plugins['content'] ) / 2 ) ) {
							echo '</div>';
							echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
						}
						if ( ! empty( $plugin['title'] ) ) {
							echo '<h4>' . wp_kses_post( $plugin['title'] ) . '</h4>';
						}
						if ( ! empty( $plugin['description'] ) ) {
							echo '<p>' . wp_kses_post( $plugin['description'] ) . '</p>';
						}
						if ( isset( $plugin['check'] ) && ! empty( $plugin['link_label'] ) ) {
							if ( $plugin['check'] ) {
								if ( ! empty( $plugins['already_activated_message'] ) ) {
									echo '<p><span class="ti-about-page-w-activated button">' . esc_html( $plugins['already_activated_message'] ) . '</span></p>';
								}
							} else {
								if ( ! empty( $plugin['slug'] ) ) {
									echo '<p><a target="_blank"  href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $plugin['slug'] ), 'install-plugin_' . $plugin['slug'] ) ) . '" class="button button-primary">' . esc_html( $plugin['link_label'] ) . '</a></p>';
								} elseif ( ! empty( $plugin['link'] ) ) {
									echo '<p><a  target="_blank" href="' . esc_url( $plugin['link'] ) . '" class="button button-primary">' . esc_html( $plugin['link_label'] ) . '</a></p>';
								}
							}
						}
					}
					echo '</div>';
				}
			}// End if().
		}

		/**
		 * Documentation section
		 */
		public function page_documentation() {
			if ( ! empty( $this->config['documentation'] ) && ! empty( $this->config['getting_started_content'] ) ) {
				if ( ! empty( $this->config['getting_started_content']['documentation_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-center">';
					echo wp_kses_post( $this->config['getting_started_content']['documentation_content'] );
					echo '</div>';
				}
			}
		}

		/**
		 * Github section
		 */
		public function github() {
			if ( ! empty( $this->config['github'] ) && ! empty( $this->config['contribute_content'] ) ) {
				if ( ! empty( $this->config['contribute_content']['github_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
					echo wp_kses_post( $this->config['contribute_content']['github_content'] );
					echo '<hr>';
					echo '</div>';
				}
			}
		}

		/**
		 * WordPress.org translations section
		 */
		public function wporg_translations() {
			if ( ! empty( $this->config['translations_wporg'] ) && ! empty( $this->config['contribute_content'] ) ) {
				if ( ! empty( $this->config['contribute_content']['translation_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-half">';
					echo wp_kses_post( $this->config['contribute_content']['translation_content'] );
					echo '<hr>';
					echo '</div>';
				}
			}
		}

		/**
		 * WordPress.org ratings section
		 */
		public function wporg_reviews() {
			if ( ! empty( $this->config['review_wporg'] ) && ! empty( $this->config['contribute_content'] ) ) {
				if ( ! empty( $this->config['contribute_content']['review_content'] ) ) {
					echo '<div>';
					echo wp_kses_post( $this->config['contribute_content']['review_content'] );
					echo '<hr>';
					echo '</div>';
				}
			}
		}

		/**
		 * Load css and scripts for the about page
		 */
		public function style_and_scripts( $hook_suffix ) {
			if ( 'appearance_page_' . $this->theme_slug . '-welcome' == $hook_suffix ) {
				wp_enqueue_style( 'ti-about-page-css', get_template_directory_uri() . '/ti-about-page/css/ti_about_page_css.css' );
				wp_enqueue_script( 'ti-about-page-js', get_template_directory_uri() . '/ti-about-page/js/ti_about_page_scripts.js', array( 'jquery' ) );
				$required_actions         = isset( $this->config['required_actions'] ) ? $this->config['required_actions'] : array();
				$no_required_actions_text = '';
				if ( ! empty( $required_actions ) ) {
					if ( ! empty( $required_actions['no_actions_message'] ) ) {
						$no_required_actions_text = esc_html( $required_actions['no_actions_message'] );
					}
				}
				$required_actions = $this->get_required_actions();
				wp_localize_script( 'ti-about-page-js', 'tiAboutPageObject', array(
					'nr_actions_required'      => count( $required_actions ),
					'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
					'nonce'                    => wp_create_nonce( 'ti_about_nonce' ),
					'template_directory'       => get_template_directory_uri(),
					'no_required_actions_text' => $no_required_actions_text,
				) );

			}

		}

		/**
		 * Return the valid array of required actions.
		 *
		 * @return array The valid array of required actions.
		 */
		private function get_required_actions() {
			$saved_actions = get_option( $this->theme_slug . '_required_actions' );
			if ( ! is_array( $saved_actions ) ) {
				$saved_actions = array();
			}
			$req_actions = isset( $this->config['required_actions'] ) ? $this->config['required_actions'] : array();
			$valid       = array();
			foreach ( $req_actions['content'] as $req_action ) {
				if ( ( ! isset( $req_action['check'] ) || ( isset( $req_action['check'] ) && ( $req_action['check'] == false ) ) ) && ( ! isset( $saved_actions[ $req_action['id'] ] ) ) ) {
					$valid[] = $req_action;
				}
			}

			return $valid;
		}

		/**
		 * Dismiss required actions
		 */
		public function dismiss_required_action_callback() {
			check_ajax_referer( 'ti_about_nonce', 'nonce' );
			$id = ( isset( $_POST['dismiss_id'] ) ) ? $_POST['dismiss_id'] : 0;
			if ( ! empty( $id ) ) {
				$saved_actions = get_option( $this->theme_slug . '_required_actions' );
				if ( ! is_array( $saved_actions ) ) {
					$saved_actions = array();
				}
				$saved_actions[ $id ] = 'yes';
				update_option( $this->theme_slug . '_required_actions', $saved_actions );
				wp_send_json_success( array( 'id' => $id ) );
			}
			die(); // this is required to return a proper result
		}

	}
}// End if().
