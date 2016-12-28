<?php
/**
 * ThemeIsle - About page class
 *
 * Example of config array with all parameters ( This needs to be defined in the theme's functions.php:
 *
 * $config = array(
 *
 *      === General infos ===
 *
 *      'theme_name' => 'Theme name',
 *		'theme_slug' => 'Theme slug',
 *		'text_domain' => 'Text domain',
 *		'theme_short_description' => 'Theme short description',
 *		'documentation' => 'Documentation link',
 *		'github' => 'Github link',
 *		'translations_wporg' => 'Wporg translations link',
 *		'review_wporg' => 'Leave a review link',
 *      'tabs_titles' => array (
 *         'id1' => 'Title1',
 *         'id2' => 'Title2'
 *      ),
 *
 *      'contribute_content' => array(
 *			'title' => 'Title for the Contribute section',
 *			'github_content' => 'Github subsection content',
 *			'translation_content' => 'Translations subsection content',
 *			'review_content' => 'Leave a review subsection content'
 *		),
 *
 *      'notification' => 'Notification content',
 *
 *      'getting_started_content' => array(
 *          'welcome_title' => 'Main welcome title',
 *			'welcome_content' => 'Welcome content',
 *          'customizer_content' => 'Go to Customizer - Content',
 *          'documentation_content' => 'Documentation - Content'
 *      ),
 *
 *      === Getting started tab - FAQ section ===
 *
 *	    'docs' => array(
 *          'title' => 'Section title',
 *          'content' => array (
 *			    array(
 *				    'title' => 'Title',
 *				    'description' => 'Description',
 *				    'link_url' => 'Doc link',
 *				    'link_label' => 'Button label'
 *			    )
 *          )
 *		),
 *
 *      === Getting started tab - Recommended plugins section ===
 *
 *		'plugins' => array(
 *          'title' => 'Section title',
 *          'already_activated_message' => 'Message that appears when the recommended plugin is already installed',
 *		    'content' => array (
 *              array(
 *			        'title' => 'Title',
 *			        'description' => 'Description',
 *			        'link_label' => 'Button label',
 *			        'check' => 'Check to see if the plugin is installed or not',
 *			        'slug' => 'Slug for wporg plugins',
 *                  'link' => 'Download link for non wporg plugins'
 *		        )
 *          )
 *	    )
 *
 *
 *      === Actions required tab ===
 *
 *		'required_actions' => array(
 *          'title' => 'Title',
 *          'no_actions_message' => 'Message that appears when no required action exists',
 *			'content' => array(
 *              array(
 *				    'id' => 'Id',
 *				    'title' => 'Title',
 *				    'description' => 'Description',
 *				    'check' => 'Check to see if the action is needed or not',
 *				    'plugin_slug' => 'Plugin slug - if a the required action needs a plugin install'
 *			    )
 *		    ),
 *      )
 *
 *      === Child themes ===
 *
 *      'child_themes' => array(
 *          'title' => 'Title',
 *          'download_button_label' => 'Label for the download/install button',
 *          'preview_button_label' => 'Label for the live preview button',
 *          'current_theme_label' => 'Label for the current theme',
 *          'current_theme_customize_label' => 'Label for the current theme customization',
 *          'content' => array(
 *			    array(
 *				    'title' => 'Title',
 *                  'image' => 'Image',
 *                  'image_alt' => 'Alternative text for image',
 *				    'description' => 'Description',
 *				    'download_link' => 'Download link',
 *				    'preview_link' => 'Preview link'
 *			    )
 *         )
 *		),
 *
 *      === Free VS Pro tab ===
 *
 *		'free_pro' => array(
 *			'free_theme_name' => 'Free theme name',
 *			'pro_theme_name' => 'Pro theme name',
 *			'pro_theme_link' => 'Pro theme link',
 *          'get_pro_theme_label' => 'Get Pro theme button label'
 *
 *           Array of features for the Free VS Pro table
 *
 *		    'features' => array(
 *			    array(
 *					'title' => 'Feature title',
 *					'description' => 'Feature description',
 *					'is_in_lite' => '(Boolean) If feature is available in lite version',
 *					'is_in_pro' => '(Boolean) If feature is available in pro version',
 *				)
 *			)
 *		)
 * );
 */

if ( ! class_exists( 'TI_About_Page' ) ) {

	class TI_About_Page {

		private $config;

		private $theme_name;

		private $theme_slug;

		private $documentation;

		private $docs;

		private $plugins;

		private $theme_short_description;

		private $free_pro;

		private $child_themes;

		private $github;

		private $translations_wporg;

		private $review_wporg;

		private $tabs_titles;

		private $contribute_content;

		private $getting_started_content;

		private $required_actions;

		private $notification;

		public function __construct( $config ) {

			if ( ! empty( $config ) && is_array( $config ) ) {

				$this->config = $config; /* array of config parameters */

				$this->theme_slug = 'ti-about-page';

				$this->theme_name = 'About page';

				if ( ! empty( $config['theme_name'] ) ) {
					$this->theme_name = $config['theme_name']; /* name of the theme */
				}

				if ( ! empty( $config['theme_slug'] ) ) {
					$this->theme_slug = $config['theme_slug']; /* slug of the theme */
				}

				if ( ! empty( $config['documentation'] ) ) {
					$this->documentation = $config['documentation']; /* documentation link */
				}

				if ( ! empty( $config['docs'] ) ) {
					$this->docs = $config['docs']; /* array of recommended docs */
				}

				if ( ! empty( $config['plugins'] ) ) {
					$this->plugins = $config['plugins']; /* array of recommended plugins */
				}

				if ( ! empty( $config['theme_short_description'] ) ) {
					$this->theme_short_description = $config['theme_short_description']; /* short description */
				}

				if ( ! empty( $config['free_pro'] ) ) {
					$this->free_pro = $config['free_pro']; /* free vs pro array */
				}

				if ( ! empty( $config['child_themes'] ) ) {
					$this->child_themes = $config['child_themes']; /* array of child themes */
				}

				if ( ! empty( $config['github'] ) ) {
					$this->github = $config['github']; /* github link */
				}

				if ( ! empty( $config['translations_wporg'] ) ) {
					$this->translations_wporg = $config['translations_wporg']; /* wordpress.org translations page link */
				}

				if ( ! empty( $config['review_wporg'] ) ) {
					$this->review_wporg = $config['review_wporg']; /* Leave a review link on wordpress.org */
				}

				if ( ! empty( $config['tabs_titles'] ) ) {
					$this->tabs_titles = $config['tabs_titles']; /* Tabs titles */
				}

				if ( ! empty( $config['contribute_content'] ) ) {
					$this->contribute_content = $config['contribute_content']; /* Contribute tab - content */
				}

				if ( ! empty( $config['getting_started_content'] ) ) {
					$this->getting_started_content = $config['getting_started_content']; /* Getting started tab - content */
				}

				if ( ! empty( $config['required_actions'] ) ) {
					$this->required_actions = $config['required_actions']; /* Array of required actions */
				}

				if ( ! empty( $config['notification'] ) ) {
					$this->notification = $config['notification']; /* Notification */
				}

				/* register the new page */
				add_action( 'admin_menu', array( $this, 'ti_about_page_register' ) );

				/* activation notice */
				add_action( 'load-themes.php', array( $this, 'ti_about_page_activation_admin_notice' ) );

				/* enqueue script and style for about page */
				add_action( 'admin_enqueue_scripts', array( $this, 'ti_about_page_style_and_scripts' ) );

				/* load main content for about page */
				add_action( 'ti_about_page', array( $this, 'ti_about_page_getting_started' ),	10 );
				add_action( 'ti_about_page', array( $this, 'ti_about_page_actions_required' ), 	20 );
				add_action( 'ti_about_page', array( $this, 'ti_about_page_child_themes' ), 	   	30 );
				add_action( 'ti_about_page', array( $this, 'ti_about_page_contribute' ), 		40 );
				add_action( 'ti_about_page', array( $this, 'ti_about_page_changelog' ), 		50 );
				add_action( 'ti_about_page', array( $this, 'ti_about_page_free_pro' ), 			60 );

				/* ajax callback for dismissable required actions */
				add_action( 'wp_ajax_ti_about_page_dismiss_required_action', array( $this, 'ti_about_page_dismiss_required_action_callback' ) );
				add_action( 'wp_ajax_nopriv_ti_about_page_dismiss_required_action', array( $this, 'ti_about_page_dismiss_required_action_callback' ) );

			}

		}

		/**
		 * Register the new page
		 */
		public function ti_about_page_register() {

			if ( ! empty( $this->config ) && is_array( $this->config ) ) {

				if ( ! empty( $this->theme_name ) ) {
					add_theme_page( 'About ' . $this->theme_name, 'About ' . $this->theme_name, 'activate_plugins', $this->theme_slug . '-welcome',  array( $this, 'ti_about_page_render' ) );
				}
			}

		}

		/**
		 * Adds an admin notice upon successful activation.
		 */
		public function ti_about_page_activation_admin_notice() {

			global $pagenow;

			if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
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
		 * Main page content
		 */
		public function ti_about_page_render() {

			require_once( ABSPATH . 'wp-load.php' );
			require_once( ABSPATH . 'wp-admin/admin.php' );
			require_once( ABSPATH . 'wp-admin/admin-header.php' );

			if ( ! empty( $this->tabs_titles ) ) {

				echo '<ul class="ti-about-page-nav-tabs" role="tablist">';

				if ( ! empty( $this->tabs_titles['getting_started'] ) ) {
					echo '<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab">' . esc_html( $this->tabs_titles['getting_started'] ) . '</a></li>';
				}

				if ( ! empty( $this->tabs_titles['actions_required'] ) ) {
					echo '<li role="presentation" class="ti-about-page-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab">' . esc_html( $this->tabs_titles['actions_required'] ) . '</a></li>';
				}

				if ( ! empty( $this->tabs_titles['child_themes'] ) && ! empty( $this->child_themes ) ) {
					echo '<li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab">' . esc_html( $this->tabs_titles['child_themes'] ) . '</a></li>';
				}

				if ( ! empty( $this->tabs_titles['github'] ) ) {
					echo '<li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab">' . esc_html( $this->tabs_titles['github'] ) . '</a></li>';
				}

				if ( ! empty( $this->tabs_titles['changelog'] ) ) {
					echo '<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab">' . esc_html( $this->tabs_titles['changelog'] ) . '</a></li>';
				}
				if ( ! empty( $this->tabs_titles['free_pro'] ) && ! empty( $this->free_pro ) ) {
					echo '<li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab">' . esc_html( $this->tabs_titles['free_pro'] ) . '</a></li>';
				}
				echo '</ul>';

				?>

				<div class="ti-about-page-tab-content">

					<?php
					/**
					 * @hooked ti_about_page_getting_started - 10
					 * @hooked ti_about_page_actions_required - 20
					 * @hooked ti_about_page_child_themes - 30
					 * @hooked ti_about_page_contribute - 40
					 * @hooked ti_about_page_changelog - 50
					 * @hooked ti_about_page_free_pro - 60
					 */
					do_action( 'ti_about_page' );
					?>

				</div>
				<?php
			}

		}

		/**
		 * Getting started
		 */
		public function ti_about_page_getting_started() {
			$theme_obj = wp_get_theme( $this->theme_slug );

			echo '<div id="getting_started" class="ti-about-page-tab-pane active">';

				echo '<div class="ti-about-page-tab-pane-center">';
			if ( ! empty( $this->getting_started_content ) ) {

				if ( ! empty( $this->getting_started_content['welcome_title'] ) ) {
					echo '<h1 class="ti-about-page-welcome-title">';

						echo esc_html( $this->getting_started_content['welcome_title'] );
					if ( ! empty( $theme_obj['Version'] ) ) {
						echo '<sup id="ti-about-page-theme-version">' . esc_html( $theme_obj['Version'] ) . ' </sup>';
					}
					echo '</h1>';
				}
			}

			if ( ! empty( $this->theme_short_description ) ) {
				echo '<p>' . wp_kses_post( $this->theme_short_description ) . '</p>';
			}

			if ( ! empty( $this->getting_started_content ) ) {
				if ( ! empty( $this->getting_started_content['welcome_content'] ) ) {
					echo '<p>' . wp_kses_post( $this->getting_started_content['welcome_content'] ) . '</p>';
				}
			}

				echo '</div>';

				echo '<hr />';

			if ( ! empty( $this->getting_started_content ) ) {

				if ( ! empty( $this->getting_started_content['customizer_content'] ) ) {

					echo '<div class="ti-about-page-tab-pane-center">';
						echo wp_kses_post( $this->getting_started_content['customizer_content'] );
					echo '</div>';

					echo '<hr />';
				}
			}

				/* DOCS */
				$this->ti_about_page_docs_display();

				echo '<div class="ti-about-page-clear"></div>';

				echo '<hr />';

				/* Documentation */
				$this->ti_about_page_documentation();

				echo '<hr />';

				/* PLUGINS */
				$this->ti_about_page_plugins_display();

				echo '<div class="ti-about-page-clear"></div>';

			echo '</div>';
		}

		/**
		 * Actions required tab
		 */
		public function ti_about_page_actions_required() {

			echo '<div id="actions_required" class="ti-about-page-tab-pane">';

			if ( ! empty( $this->required_actions ) ) {

				if ( ! empty( $this->required_actions['title'] ) ) {

					echo '<h1>' . esc_html( $this->required_actions['title'] ) . '</h1>';

					echo '<hr />';

				}
			}

			if ( ! empty( $this->required_actions ) ) {

				if ( ! empty( $this->required_actions['content'] ) && is_array( $this->required_actions['content'] ) ) {

					/* ti_about_page_show_required_actions is an array of true/false for each required action that was dismissed */
					$ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );

					foreach ( $this->required_actions['content'] as $ti_about_page_required_action_key => $ti_about_page_required_action_value ) {

						if ( @$ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] === false ) {
							continue;
						}
						if ( @$ti_about_page_required_action_value['check'] ) {
							continue;
						}

						echo '<div class="ti-about-page-action-required-box">';
						echo '<span class="dashicons dashicons-no-alt ti-about-page-dismiss-required-action" id="' . esc_attr( $ti_about_page_required_action_value['id'] ) . '"></span>';
						$ti_about_page_required_action_key_plus = $ti_about_page_required_action_key + 1;
						echo '<h4>' . $ti_about_page_required_action_key_plus . '.';
						if ( ! empty( $ti_about_page_required_action_value['title'] ) ) {
							echo wp_kses_post( $ti_about_page_required_action_value['title'] );
						}
						echo '</h4>';
						echo '<p>';
						if ( ! empty( $ti_about_page_required_action_value['description'] ) ) {
							echo wp_kses_post( $ti_about_page_required_action_value['description'] );
						}
						echo '</p>';

						if ( ! empty( $ti_about_page_required_action_value['plugin_slug'] ) ) {
							echo '<p>';
								echo '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $ti_about_page_required_action_value['plugin_slug'] ), 'install-plugin_' . $ti_about_page_required_action_value['plugin_slug'] ) ) . '" class="button button-primary">';
							if ( ! empty( $ti_about_page_required_action_value['title'] ) ) {
								echo wp_kses_post( $ti_about_page_required_action_value['title'] );
							}
								echo '</a>';
							echo '</p>';
						}

						echo '<hr/>';
						echo '</div>';
					}
				}
			}

				$nr_actions_required = 0;

				/* get number of required actions */
			if ( get_option( 'ti_about_page_show_required_actions' ) ) {
				$ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );
			} else {
				$ti_about_page_show_required_actions = array();
			}

			if ( ! empty( $this->required_actions['content'] ) ) {
				foreach ( $this->required_actions['content'] as $ti_about_page_required_action_value ) {
					if ( ( ! isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ( ( isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) && ( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] == true ) ) || ! isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) ) ) {
						$nr_actions_required++;
					}
				}
			}

			if ( $nr_actions_required == 0 && ! empty( $this->required_actions['no_actions_message'] ) ) {
				echo '<p>' . wp_kses_post( $this->required_actions['no_actions_message'] ) . '</p>';
			}

			echo '</div>';
		}
		/**
		 * Child themes
		 */
		public function ti_about_page_child_themes() {

			echo '<div id="child_themes" class="ti-about-page-tab-pane">';

			if ( ! empty( $this->child_themes ) ) {

				if ( ! empty( $this->child_themes['content'] ) && is_array( $this->child_themes['content'] ) ) {

					$child_length = count( $this->child_themes['content'] );

					if ( function_exists( 'array_slice' ) ) {
						$child_firsthalf  = array_slice( $this->child_themes['content'], 0, round( $child_length / 2 ) );
						$child_secondhalf = array_slice( $this->child_themes['content'], round( $child_length / 2 ) );
					}

					if ( ! empty( $this->child_themes['title'] ) ) {
						echo '<div class="ti-about-page-tab-pane-center">';
							echo esc_html( $this->child_themes['title'] );
						echo '</div>';
					}

					if ( ! empty( $child_firsthalf ) ) {
						$this->ti_about_page_child_themes_display_column( $child_firsthalf );
					}
					if ( ! empty( $child_secondhalf ) ) {
						$this->ti_about_page_child_themes_display_column( $child_secondhalf );
					}
				}
			}

			echo '</div>';
		}

		/**
		 * Contribute tab
		 */
		public function ti_about_page_contribute() {

			echo '<div id="github" class="ti-about-page-tab-pane">';

			if ( ! empty( $this->contribute_content ) ) {

				if ( ! empty( $this->contribute_content['title'] ) ) {
					echo '<h1>' . wp_kses_post( $this->contribute_content['title'] ) . '</h1><hr />';
				}
			}

				$this->ti_about_page_github();

				$this->ti_about_page_wporg_translations();

				$this->ti_about_page_wporg_reviews();

			echo '</div>';
		}
		/**
		 * Changelog tab
		 */
		public function ti_about_page_changelog() {

			$theme_obj = wp_get_theme( $this->theme_slug );

			echo '<div class="ti-about-page-tab-pane" id="changelog">';

				echo '<div class="ti-about-page-tab-pane-center">';

					echo '<h1>' . esc_html( $this->theme_name );

			if ( ! empty( $theme_obj['Version'] ) ) {
				echo '<sup id="ti-about-page-theme-version">' . esc_attr( $theme_obj['Version'] ) . '</sup>';
			}
					echo '</h1>';

				echo '</div>';

				WP_Filesystem();
				global $wp_filesystem;
				$ti_about_page_changelog = $wp_filesystem->get_contents( get_template_directory() . '/CHANGELOG.md' );
				$ti_about_page_changelog_lines = explode( PHP_EOL, $ti_about_page_changelog );
			foreach ( $ti_about_page_changelog_lines as $ti_about_page_changelog_line ) {
				if ( substr( $ti_about_page_changelog_line, 0, 3 ) === '###' ) {
					echo '<hr /><h1>' . substr( $ti_about_page_changelog_line,3 ) . '</h1>';
				} else {
					echo $ti_about_page_changelog_line . '<br/>';
				}
			}

			echo '</div>';

		}
		/**
		 * Free vs PRO tab
		 */
		public function ti_about_page_free_pro() {

			if ( ! empty( $this->free_pro ) ) {

				if ( ! empty( $this->free_pro['free_theme_name'] ) && ! empty( $this->free_pro['pro_theme_name'] ) && ! empty( $this->free_pro['features'] ) && is_array( $this->free_pro['features'] ) ) {

					echo '<div id="free_pro" class="ti-about-page-tab-pane ti-about-page-fre-pro">';

						echo '<table>';

							echo '<thead>';
								echo '<tr>';
									echo '<th></th>';
									echo '<th>' . esc_html( $this->free_pro['free_theme_name'] ) . '</th>';
									echo '<th>' . esc_html( $this->free_pro['pro_theme_name'] ) . '</th>';
								echo '</tr>';
							echo '</thead>';

							echo '<tbody>';

					foreach ( $this->free_pro['features'] as $feature ) {

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

					if ( ! empty( $this->free_pro['pro_theme_link'] ) && ! empty( $this->free_pro['get_pro_theme_label'] ) ) {
						echo '<tr class="ti-about-page-text-center">';
						echo '<td colspan="3"><a href="' . esc_url( $this->free_pro['pro_theme_link'] ) . '" target="_blank" class="button button-primary">' . wp_kses_post( $this->free_pro['get_pro_theme_label'] ) . '</a></td>';
						echo '</tr>';
					}

							echo '</tbody>';

						echo '</table>';

					echo '</div>';

				}
			}
		}

		/**
		 * Recommended docs section
		 */
		public function ti_about_page_docs_display() {

			if ( ! empty( $this->docs ) ) {

				if ( ! empty( $this->docs['content'] ) && is_array( $this->docs['content'] ) ) {

					$docs_length = count( $this->docs['content'] );

					if ( function_exists( 'array_slice' ) ) {
						$docs_firsthalf  = array_slice( $this->docs['content'], 0, round( $docs_length / 2 ) );
						$docs_secondhalf = array_slice( $this->docs['content'], round( $docs_length / 2 ) );
					}

					if ( ! empty( $this->docs['title'] ) ) {
						echo '<div class="ti-about-page-tab-pane-center">';
							echo '<h1>' . wp_kses_post( $this->docs['title'] ) . '</h1>';
						echo '</div>';
					}

					if ( ! empty( $docs_firsthalf ) ) {
						$this->ti_about_page_docs_display_column( $docs_firsthalf );
					}

					if ( ! empty( $docs_secondhalf ) ) {
						$this->ti_about_page_docs_display_column( $docs_secondhalf );
					}
				}
			}

		}

		/**
		 * Display recommended docs - one column
		 */
		public function ti_about_page_docs_display_column( $ti_about_page_docs_array ) {

			if ( ! empty( $ti_about_page_docs_array ) ) {
				echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
				foreach ( $ti_about_page_docs_array as $doc ) {

					if ( ! empty( $doc['title'] ) ) {
						echo '<h4>' . wp_kses_post( $doc['title'] ) . '</h4>';
					}
					if ( ! empty( $doc['description'] ) ) {
						echo '<p>' . wp_kses_post( $doc['description'] ) . '</p>';
					}
					if ( ! empty( $doc['link_url'] ) && ! empty( $doc['link_label'] ) ) {
						echo '<p><a href="' . esc_url( $doc['link_url'] ) . '" class="button">' . esc_html( $doc['link_label'] ) . '</a></p>';
					}
				}
				echo '</div>';

			}

		}

		/**
		 * Recommended plugins section
		 */
		public function ti_about_page_plugins_display() {
			if ( ! empty( $this->plugins ) ) {

				if ( ! empty( $this->plugins['content'] ) && is_array( $this->plugins['content'] ) ) {
					$plugins_length = count( $this->plugins['content'] );

					if ( function_exists( 'array_slice' ) ) {
						$plugins_firsthalf  = array_slice( $this->plugins['content'], 0, round( $plugins_length / 2 ) );
						$plugins_secondhalf = array_slice( $this->plugins['content'], round( $plugins_length / 2 ) );
					}

					if ( ! empty( $this->plugins['title'] ) ) {
						echo '<div class="ti-about-page-tab-pane-center">';
							echo '<h1>' . wp_kses_post( $this->plugins['title'] ) . '</h1>';
						echo '</div>';
					}

					if ( ! empty( $plugins_firsthalf ) ) {
						$this->ti_about_page_plugins_display_column( $plugins_firsthalf );
					}

					if ( ! empty( $plugins_secondhalf ) ) {
						$this->ti_about_page_plugins_display_column( $plugins_secondhalf );
					}
				}
			}
		}

		/**
		 * Display recommended plugins - one column
		 *
		 * title - Title of plugin
		 * description - Description of plugin
		 * link_label - Install button label
		 * check - condition to check if the plugin is installed
		 * slug - wordpress.org slug of the plugin
		 * link - external link of the recommended plugin (for non wporg plugins)
		 */
		public function ti_about_page_plugins_display_column( $ti_about_page_plugins_array ) {
			if ( ! empty( $ti_about_page_plugins_array ) ) {
				echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
				foreach ( $ti_about_page_plugins_array as $plugin ) {

					if ( ! empty( $plugin['title'] ) ) {
						echo '<h4>' . wp_kses_post( $plugin['title'] ) . '</h4>';
					}
					if ( ! empty( $plugin['description'] ) ) {
						echo '<p>' . wp_kses_post( $plugin['description'] ) . '</p>';
					}
					if ( isset( $plugin['check'] ) && ! empty( $plugin['link_label'] ) ) {
						if ( $plugin['check'] ) {
							if ( ! empty( $this->plugins['already_activated_message'] ) ) {
								echo '<p><span class="ti-about-page-w-activated button">' . esc_html( $this->plugins['already_activated_message'] ) . '</span></p>';
							}
						} else {
							if ( ! empty( $plugin['slug'] ) ) {
								echo '<p><a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $plugin['slug'] ), 'install-plugin_' . $plugin['slug'] ) ) . '" class="button button-primary">' . esc_html( $plugin['link_label'] ) . '</a></p>';
							} elseif ( ! empty( $plugin['link'] ) ) {
								echo '<p><a href="' . esc_url( $plugin['link'] ) . '" class="button button-primary">' . esc_html( $plugin['link_label'] ) . '</a></p>';
							}
						}
					}
				}
				echo '</div>';
			}
		}

		/**
		 * Documentation section
		 */
		public function ti_about_page_documentation() {

			if ( ! empty( $this->documentation ) && ! empty( $this->getting_started_content ) ) {

				if ( ! empty( $this->getting_started_content['documentation_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-center">';
						echo wp_kses_post( $this->getting_started_content['documentation_content'] );
					echo '</div>';
				}
			}
		}

		/**
		 * Github section
		 */
		public function ti_about_page_github() {

			if ( ! empty( $this->github ) && ! empty( $this->contribute_content ) ) {

				if ( ! empty( $this->contribute_content['github_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
						echo wp_kses_post( $this->contribute_content['github_content'] );
						echo '<hr>';
					echo '</div>';
				}
			}
		}

		/**
		 * WordPress.org translations section
		 */
		public function ti_about_page_wporg_translations() {

			if ( ! empty( $this->translations_wporg ) && ! empty( $this->contribute_content ) ) {

				if ( ! empty( $this->contribute_content['translation_content'] ) ) {
					echo '<div class="ti-about-page-tab-pane-half">';
						echo wp_kses_post( $this->contribute_content['translation_content'] );
						echo '<hr>';
					echo '</div>';
				}
			}
		}

		/**
		 * WordPress.org ratings section
		 */
		public function ti_about_page_wporg_reviews() {

			if ( ! empty( $this->review_wporg ) && ! empty( $this->contribute_content ) ) {

				if ( ! empty( $this->contribute_content['review_content'] ) ) {
					echo '<div>';
						echo wp_kses_post( $this->contribute_content['review_content'] );
						echo '<hr>';
					echo '</div>';
				}
			}
		}

		/**
		 * Display child themes - one column
		 *
		 * title - Name of child theme
		 * image - Image
		 * image_alt - Alternative text for image
		 * description - Description
		 * download_link - Download link
		 * preview_link - Preview link
		 */
		public function ti_about_page_child_themes_display_column( $ti_about_page_child_array ) {

			if ( ! empty( $ti_about_page_child_array ) ) {

				$current_theme = wp_get_theme();

				echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
				foreach ( $ti_about_page_child_array as $child ) {

					if ( ! empty( $child['image'] ) ) {
						echo '<div class="ti-about-page-child-theme-container">';

						echo '<div class="ti-about-page-child-theme-image-container">';
						echo '<img src="' . esc_url( $child['image'] ) . '" alt="' . ( ! empty( $child['image_alt'] ) ? esc_html( $child['image_alt'] ) : '') . '" />';

						if ( ! empty( $child['description'] ) ) {
							echo '<div class="ti-about-page-child-theme-description">';
							echo '<h2>' . wp_kses_post( $child['description'] ) . '</h2>';
							echo '</div>';
						}
						if ( ! empty( $child['title'] ) ) {
							echo '<div class="ti-about-page-child-theme-details">';
							if ( $child['title'] != $current_theme['Name'] ) {
								echo '<div class="theme-details">';
								echo '<span class="theme-name">' . $child['title'] . '</span>';
								if ( ! empty( $child['download_link'] ) && ! empty( $this->child_themes['download_button_label'] ) ) {
									echo '<a href="' . esc_url( $child['download_link'] ) . '" class="button button-primary install right">' . esc_html( $this->child_themes['download_button_label'] ) . '</a>';
								}
								if ( ! empty( $child['preview_link'] ) && ! empty( $this->child_themes['preview_button_label'] ) ) {
									echo '<a class="button button-secondary preview right" target="_blank" href="' . $child['preview_link'] . '">' . esc_html( $this->child_themes['preview_button_label'] ) . '</a>';
								}
								echo '<div class="ti-about-page-clear"></div>';
								echo '</div>';
							} else {
								echo '<div class="theme-details active">';
								echo '<span class="theme-name">' . $this->theme_name;
								if ( ! empty( $this->child_themes['current_theme_label'] ) ) {
									echo ' - ' . esc_html( $this->child_themes['current_theme_label'] );
								}
								echo '</span>';

								if ( ! empty( $this->child_themes['current_theme_customize_label'] ) ) {
									echo '<a class="button button-secondary customize right" target="_blank" href="' . get_site_url() . '/wp-admin/customize.php">' . esc_html( $this->child_themes['current_theme_customize_label'] ) . '</a>';
								}
								echo '<div class="ti-about-page-clear"></div>';
								echo '</div>';
							}
							echo '</div>';
						}

						echo '</div><!-- .ti-about-page-child-theme-image-container -->';

						echo '</div><!-- .ti-about-page-child-theme-container -->';
					}
				}

				echo '</div>';
			}
		}

		/**
		 * Load css and scripts for the about page
		 */
		public function ti_about_page_style_and_scripts( $hook_suffix ) {

			if ( 'appearance_page_' . $this->theme_slug . '-welcome' == $hook_suffix ) {

				wp_enqueue_style( 'ti-about-page-css', get_template_directory_uri() . '/ti-about-page/css/ti_about_page_css.css' );
				wp_enqueue_script( 'ti-about-page-js', get_template_directory_uri() . '/ti-about-page/js/ti_about_page_scripts.js', array( 'jquery' ) );

				$nr_actions_required = 0;
				/* get number of required actions */
				if ( get_option( 'ti_about_page_show_required_actions' ) ) {
					$ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );
				} else {
					$ti_about_page_show_required_actions = array();
				}
				if ( ! empty( $this->required_actions['content'] ) ) {
					foreach ( $this->required_actions['content'] as $ti_about_page_required_action_value ) {
						if ( ( ! isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ( ( isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) && ( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] == true ) ) || ! isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) ) ) {
							$nr_actions_required ++;
						}
					}
				}

				$no_required_actions_text = '';
				if ( ! empty( $this->required_actions ) ) {

					if ( ! empty( $this->required_actions['no_actions_message'] ) ) {
						$no_required_actions_text = esc_html( $this->required_actions['no_actions_message'] );
					}
				}
				wp_localize_script( 'ti-about-page-js', 'tiAboutPageObject', array(
					'nr_actions_required' => $nr_actions_required,
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'template_directory' => get_template_directory_uri(),
					'no_required_actions_text' => $no_required_actions_text,
				) );

			}

		}
		/**
		 * Load css and scripts for customizer page
		 */
		public function ti_about_page_css_and_scripts_for_customizer() {

			wp_enqueue_style( 'ti-about-page-customizer-css', get_template_directory_uri() . '/ti-about-page/css/ti_about_page_css_customizer.css' );

			$nr_actions_required = 0;
			/* get number of required actions */
			if ( get_option( 'ti_about_page_show_required_actions' ) ) {
				$ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );
			} else {
				$ti_about_page_show_required_actions = array();
			}
			if ( ! empty( $this->required_actions ) ) {
				foreach ( $this->required_actions as $ti_about_page_required_action_value ) {
					if ( ( ! isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ( ( isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) && ( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] == true ) ) || ! isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) ) ) {
						$nr_actions_required ++;
					}
				}
			}

		}

		/**
		 * Dismiss required actions
		 */
		public function ti_about_page_dismiss_required_action_callback() {

			$ti_about_page_dismiss_id = ( isset( $_GET['dismiss_id'] ) ) ? $_GET['dismiss_id'] : 0;
			echo $ti_about_page_dismiss_id; /* this is needed and it's the id of the dismissable required action */
			if ( ! empty( $ti_about_page_dismiss_id ) ) {
				/* if the option exists, update the record for the specified id */
				if ( get_option( 'ti_about_page_show_required_actions' ) ) {
					$ti_about_page_show_required_actions                              = get_option( 'ti_about_page_show_required_actions' );
					$ti_about_page_show_required_actions[ $ti_about_page_dismiss_id ] = false;
					update_option( 'ti_about_page_show_required_actions', $ti_about_page_show_required_actions );
					/* create the new option,with false for the specified id */
				} else {
					$ti_about_page_show_required_actions_new = array();
					if ( ! empty( $this->required_actions ) ) {
						foreach ( $this->required_actions as $ti_about_page_required_action ) {
							if ( $ti_about_page_required_action['id'] == $ti_about_page_dismiss_id ) {
								$ti_about_page_show_required_actions_new[ $ti_about_page_required_action['id'] ] = false;
							} else {
								$ti_about_page_show_required_actions_new[ $ti_about_page_required_action['id'] ] = true;
							}
						}
						update_option( 'ti_about_page_show_required_actions', $ti_about_page_show_required_actions_new );
					}
				}
			}
			die(); // this is required to return a proper result
		}

	}
}

?>
