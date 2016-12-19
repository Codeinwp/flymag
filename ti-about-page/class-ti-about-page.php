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
 *
 *      === Getting started tab - FAQ section ===
 *
 *	    'docs' => array(
 *			array(
 *				'title' => 'Title',
 *				'description' => 'Description',
 *				'link_url' => 'Doc link',
 *				'link_label' => 'Button label'
 *			)
 *		),
 *
 *      === Getting started tab - Recommended plugins section ===
 *
 *		'plugins' => array(
 *		    array(
 *			    'title' => 'Title',
 *			    'description' => 'Description',
 *			    'link_label' => 'Button label',
 *			    'check' => 'Check to see if the plugin is installed or not',
 *			    'slug' => 'Slug for wporg plugins',
 *              'link' => 'Download link for non wporg plugins'
 *		    )
 *	    )
 *
 *
 *      === Actions required tab ===
 *
 *		'required_actions' => array(
 *			array(
 *				'id' => 'Id',
 *				'title' => 'Title',
 *				'description' => 'Description',
 *				'check' => 'Check to see if the action is needed or not'
 *				'plugin_slug' => 'Plugin slug - if a the required action needs a plugin install'
 *			)
 *		),
 *
 *      === Child themes ===
 *
 *      'child_themes' => array(
 *			array(
 *				'title' => 'Title',
 *              'image' => 'Image',
 *              'image_alt' => 'Alternative text for image',
 *				'description' => 'Description',
 *				'download_link' => 'Download link'
 *				'preview_link' => 'Preview link'
 *			)
 *		),
 *
 *      === Free VS Pro tab ===
 *
 *		'free_pro' => array(
 *			'free_theme_name' => 'Free theme name',
 *			'pro_theme_name' => 'Pro theme name',
 *			'pro_theme_link' => 'Pro theme link',
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

        private $text_domain;

        private $documentation;

        private $docs;

        private $plugins;

        private $theme_short_description;

        private $free_pro;

        private $child_themes;

        private $github;

        private $translations_wporg;

        private $review_wporg;

        private $required_actions;

        public function __construct($config) {

            if( ! empty( $config ) && is_array( $config ) ) {

                $this->config = $config; /* array of config parameters */

                $this->theme_slug = 'ti-about-page';

                $this->text_domain = 'ti-about-page';

                $this->theme_name = 'About page';

                if( !empty( $config['theme_name'] ) ) {
                    $this->theme_name = $config['theme_name']; /* name of the theme */
                }

                if( !empty( $config['theme_slug'] ) ) {
                    $this->theme_slug = $config['theme_slug']; /* slug of the theme */
                }

                if( !empty( $config['text_domain'] ) ) {
                    $this->text_domain = $config['text_domain']; /* text domain */
                }

                if( !empty( $config['documentation'] ) ) {
                    $this->documentation = $config['documentation']; /* documentation link */
                }

                if( !empty( $config['docs'] ) ) {
                    $this->docs = $config['docs']; /* array of recommended docs */
                }

                if( !empty( $config['plugins'] ) ) {
                    $this->plugins = $config['plugins']; /* array of recommended plugins */
                }

                if( !empty($config['theme_short_description']) ) {
                    $this->theme_short_description = $config['theme_short_description']; /* short description */
                }

                if( !empty($config['free_pro']) ) {
                    $this->free_pro = $config['free_pro']; /* free vs pro array */
                }

                if( !empty($config['child_themes']) ) {
                    $this->child_themes = $config['child_themes']; /* array of child themes */
                }

                if( !empty($config['github']) ) {
                    $this->github = $config['github']; /* github link */
                }

                if( !empty($config['translations_wporg']) ) {
                    $this->translations_wporg = $config['translations_wporg']; /* wordpress.org translations page link */
                }

                if( !empty($config['review_wporg']) ) {
                    $this->review_wporg = $config['review_wporg']; /* Leave a review link on wordpress.org */
                }

                if( !empty($config['required_actions']) ) {
                    $this->required_actions = $config['required_actions']; /* Array of required actions */
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
                add_action( 'wp_ajax_ti_about_page_dismiss_required_action', array( $this, 'ti_about_page_dismiss_required_action_callback') );
                add_action( 'wp_ajax_nopriv_ti_about_page_dismiss_required_action', array($this, 'ti_about_page_dismiss_required_action_callback') );

            }

        }

        /**
         * Register the new page
         */
        public function ti_about_page_register() {

            if( ! empty( $this->config ) && is_array( $this->config ) ) {

                if( !empty( $this->theme_name ) ) {
                    add_theme_page( 'About '.$this->theme_name, 'About '.$this->theme_name, 'activate_plugins', $this->theme_slug.'-welcome',  array( $this, 'ti_about_page_render') );
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
            ?>
            <div class="updated notice is-dismissible">
                <p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%2$s.', $this->text_domain ), $this->theme_name, '<a href="' . esc_url( admin_url( 'themes.php?page='.$this->theme_slug.'-welcome' ) ) . '">', '</a>' ); ?></p>
                <p><a href="<?php echo esc_url( admin_url( 'themes.php?page='.$this->theme_slug.'-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php printf( __('Get started with %s', $this->text_domain), $this->theme_name ); ?></a></p>
            </div>
            <?php
        }

        /**
         * Main page content
         */
        public function ti_about_page_render() {

            require_once( ABSPATH . 'wp-load.php' );
            require_once( ABSPATH . 'wp-admin/admin.php' );
            require_once( ABSPATH . 'wp-admin/admin-header.php' );

            ?>

            <ul class="ti-about-page-nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started',$this->text_domain ); ?></a></li>
                <li role="presentation" class="ti-about-page-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions required',$this->text_domain ); ?></a></li>
                <?php if ( !empty( $this->child_themes ) ) { ?>
                    <li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Child themes',$this->text_domain ); ?></a></li>
                <?php } ?>
                <li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute',$this->text_domain ); ?></a></li>
                <li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog',$this->text_domain ); ?></a></li>
                <?php if ( !empty( $this->free_pro ) ) { ?>
                    <li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab"><?php esc_html_e( 'Free VS PRO',$this->text_domain ); ?></a></li>
                <?php } ?>
            </ul>

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

        /**
         * Getting started
         */
        public function ti_about_page_getting_started() {
            $customizer_url = admin_url() . 'customize.php' ;
            $theme_obj = wp_get_theme( $this->theme_slug );

            echo '<div id="getting_started" class="ti-about-page-tab-pane active">';

                echo '<div class="ti-about-page-tab-pane-center">';
                    echo '<h1 class="ti-about-page-welcome-title">Welcome to ';
                        if( !empty($this->theme_name) ) {
                            echo $this->theme_name;
                        }
                        if( !empty($theme_obj['Version']) ) {
                            echo '<sup id="ti-about-page-theme-version">'. $theme_obj['Version'].' </sup>';
                        }
                    echo '</h1>';

                    if( !empty($this->theme_short_description) ) {
                        echo '<p>'.$this->theme_short_description.'</p>';
                    }

                    echo '<p>'.sprintf( __('We want to make sure you have the best experience using %1$s and that is why we gathered here all the necessary informations for you. We hope you will enjoy using %2$s, as much as we enjoy creating great products.', $this->text_domain), $this->theme_name, $this->theme_name ).'</p>';

                echo '</div>';

                echo '<hr />';

                echo '<div class="ti-about-page-tab-pane-center">';
                    echo '<h1>'.__( 'Getting started', $this->text_domain ).'</h1>';
                    echo '<h4>'.__( 'Customize everything in a single place.' ,$this->text_domain ).'</h4>';
                    echo '<p>'.__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', $this->text_domain ).'</p>';
                    echo '<p><a href="'.esc_url( $customizer_url ).'" class="button button-primary">'.__( 'Go to Customizer', $this->text_domain ).'</a></p>';
                echo '</div>';
            
                echo '<hr />';

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

                echo '<h1>'.sprintf( __( 'Keep up with %s\'s latest news' ,$this->text_domain ), $this->theme_name ).'</h1>';

                echo '<hr />';

                if( !empty($this->required_actions) && is_array($this->required_actions) ) {

                    /* ti_about_page_show_required_actions is an array of true/false for each required action that was dismissed */
                    $ti_about_page_show_required_actions = get_option("ti_about_page_show_required_actions");

                    foreach ($this->required_actions as $ti_about_page_required_action_key => $ti_about_page_required_action_value) {

                        if (@$ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']] === false) continue;
                        if (@$ti_about_page_required_action_value['check']) continue;

                        echo '<div class="ti-about-page-action-required-box">';
                            echo '<span class="dashicons dashicons-no-alt ti-about-page-dismiss-required-action" id="'.$ti_about_page_required_action_value['id'].'"></span>';
                            $ti_about_page_required_action_key_plus = $ti_about_page_required_action_key + 1;
                            echo '<h4>'.$ti_about_page_required_action_key_plus.'.';
                                if (!empty($ti_about_page_required_action_value['title'])) {
                                    echo $ti_about_page_required_action_value['title'];
                                }
                            echo '</h4>';
                            echo '<p>';
                                if ( !empty($ti_about_page_required_action_value['description'])) {
                                    echo $ti_about_page_required_action_value['description'];
                                }
                            echo '</p>';

                            if (!empty($ti_about_page_required_action_value['plugin_slug'])) {
                                echo '<p>';
                                    echo '<a href="'.esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $ti_about_page_required_action_value['plugin_slug']), 'install-plugin_' . $ti_about_page_required_action_value['plugin_slug'])).'" class="button button-primary">';
                                        if (!empty($ti_about_page_required_action_value['title'])) {
                                            echo $ti_about_page_required_action_value['title'];
                                        }
                                    echo '</a>';
                                echo '</p>';
                            }

                            echo '<hr/>';
                        echo '</div>';
                    }
                }

                $nr_actions_required = 0;

                /* get number of required actions */
                if( get_option( 'ti_about_page_show_required_actions' ) ) {
                    $ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );
                } else {
                    $ti_about_page_show_required_actions = array();
                }

                if( !empty( $this->required_actions ) ) {
                    foreach ( $this->required_actions as $ti_about_page_required_action_value ) {
                        if ( ( !isset( $ti_about_page_required_action_value['check'] ) || ( isset($ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ( ( isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) && ( $ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']] == true ) ) || !isset( $ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']] ) ) ) {
                            $nr_actions_required++;
                        }
                    }
                }

                if( $nr_actions_required == 0 ) {
                    echo '<p>'.__( 'Hooray! There are no required actions for you right now.', $this->text_domain ).'</p>';
                }

            echo '</div>';
        }
        /**
         * Child themes
         */
        public function ti_about_page_child_themes() {

            echo '<div id="child_themes" class="ti-about-page-tab-pane">';

                if( !empty( $this->child_themes ) && is_array( $this->child_themes ) ) {

                    $child_length = count( $this->child_themes );

                    if( function_exists( 'array_slice' ) ) {
                        $child_firsthalf = array_slice( $this->child_themes, 0, round( $child_length / 2 ) );
                        $child_secondhalf = array_slice( $this->child_themes, round( $child_length / 2 ) );
                    }

                    echo '<div class="ti-about-page-tab-pane-center">';
                        echo '<h1>'.__( 'Get a whole new look for your site', $this->text_domain ).'</h1>';
                        echo '<p>'.sprintf( __( 'Below you will find a selection of %s child themes that will totally transform the look of your site.', $this->text_domain ), $this->theme_name ).'</p>';
                    echo '</div>';

                    if( !empty( $child_firsthalf ) ) {
                        $this->ti_about_page_child_themes_display_column( $child_firsthalf );
                    }
                    if( !empty( $child_secondhalf ) ) {
                        $this->ti_about_page_child_themes_display_column( $child_secondhalf );
                    }

                }

            echo '</div>';
        }

        /**
         * Contribute tab
         */
        public function ti_about_page_contribute() {

            echo '<div id="github" class="ti-about-page-tab-pane">';

                echo '<h1>'.__( 'How can I contribute?', $this->text_domain ).'</h1>';

                echo '<hr/>';

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

                    echo '<h1>'.$this->theme_name;
                        if( !empty( $theme_obj['Version'] ) ){
                            echo '<sup id="ti-about-page-theme-version">'.esc_attr( $theme_obj['Version'] ).'</sup>';
                        }
                    echo '</h1>';

                echo '</div>';

                WP_Filesystem();
                global $wp_filesystem;
                $ti_about_page_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
                $ti_about_page_changelog_lines = explode( PHP_EOL, $ti_about_page_changelog );
                foreach( $ti_about_page_changelog_lines as $ti_about_page_changelog_line ){
                    if(substr( $ti_about_page_changelog_line, 0, 3 ) === "###"){
                        echo '<hr /><h1>'.substr( $ti_about_page_changelog_line,3 ).'</h1>';
                    } else {
                        echo $ti_about_page_changelog_line.'<br/>';
                    }
                }

            echo '</div>';

        }
        /**
         * Free vs PRO tab
         */
        public function ti_about_page_free_pro() {

            if ( !empty( $this->free_pro['free_theme_name'] ) && !empty( $this->free_pro['pro_theme_name' ]) && !empty( $this->free_pro['features'] ) && is_array( $this->free_pro['features'] ) ) {

                echo '<div id="free_pro" class="ti-about-page-tab-pane ti-about-page-fre-pro">';

                    echo '<table>';

                        echo '<thead>';
                            echo '<tr>';
                                echo '<th></th>';
                                echo '<th>' . $this->free_pro['free_theme_name'] . '</th>';
                                echo '<th>' . $this->free_pro['pro_theme_name'] . '</th>';
                            echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        foreach ( $this->free_pro['features'] as $feature ) {

                            echo '<tr>';
                            if ( !empty( $feature['title'] ) || !empty( $feature['description'] ) ) {
                                echo '<td>';
                                if ( !empty( $feature['title'] ) ) {
                                    echo '<h3>' . $feature['title'] . '</h3>';
                                }
                                if ( !empty( $feature['description'] ) ) {
                                    echo '<p>' . $feature['description'] . '</p>';
                                }
                                echo '</td>';
                            }
                            if ( !empty( $feature['is_in_lite'] ) && ( $feature['is_in_lite'] == 'true' ) ) {
                                echo '<td><span class="dashicons-before dashicons-yes"></span></td>';
                            } else {
                                echo '<td><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            if ( !empty( $feature['is_in_pro'] ) && ( $feature['is_in_pro'] == 'true' ) ) {
                                echo '<td><span class="dashicons-before dashicons-yes"></span></td>';
                            } else {
                                echo '<td><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            echo '</tr>';

                        }

                        echo '</tbody>';

                     echo '</table>';

                echo '</div>';

            }
        }

        /**
         * Recommended docs section
         */
        public function ti_about_page_docs_display() {

            if( !empty( $this->docs ) && is_array( $this->docs ) ) {

                $docs_length = count( $this->docs );

                if( function_exists( 'array_slice' ) ) {
                    $docs_firsthalf = array_slice( $this->docs, 0, round( $docs_length / 2 ));
                    $docs_secondhalf = array_slice( $this->docs, round( $docs_length / 2 ));
                }

                echo '<div class="ti-about-page-tab-pane-center">';
                    echo '<h1>'.__( 'FAQ', $this->text_domain ).'</h1>';
                echo '</div>';

                if( !empty( $docs_firsthalf ) ) {
                    $this->ti_about_page_docs_display_column( $docs_firsthalf );
                }

                if( !empty( $docs_secondhalf ) ) {
                    $this->ti_about_page_docs_display_column( $docs_secondhalf );
                }

            }

        }

        /**
         * Display recommended docs - one column
         */
        public function ti_about_page_docs_display_column( $ti_about_page_docs_array ) {

            if ( !empty( $ti_about_page_docs_array ) ) {
                echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
                foreach ( $ti_about_page_docs_array as $doc ) {

                    if ( !empty( $doc['title'] ) ) {
                        echo '<h4>' . $doc['title'] . '</h4>';
                    }
                    if ( !empty( $doc['description'] ) ) {
                        echo '<p>' . $doc['description'] . '</p>';
                    }
                    if ( !empty( $doc['link_url'] ) && !empty( $doc['link_label'] ) ) {
                        echo '<p><a href="' . esc_url($doc['link_url']) . '" class="button">' . $doc['link_label'] . '</a></p>';
                    }

                }
                echo '</div>';

            }

        }

        /**
         * Recommended plugins section
         */
        public function ti_about_page_plugins_display() {
            if( !empty( $this->plugins ) && is_array( $this->plugins ) ) {

                $plugins_length = count( $this->plugins );

                if( function_exists('array_slice') ) {
                    $plugins_firsthalf = array_slice( $this->plugins, 0, round( $plugins_length / 2 ) );
                    $plugins_secondhalf = array_slice( $this->plugins, round( $plugins_length / 2 ) );
                }

                echo '<div class="ti-about-page-tab-pane-center">';
                    echo '<h1>'.__( 'Recommended plugins', $this->text_domain ).'</h1>';
                echo '</div>';

                if( !empty( $plugins_firsthalf ) ) {
                    $this->ti_about_page_plugins_display_column( $plugins_firsthalf );
                }

                if( !empty( $plugins_secondhalf ) ) {
                    $this->ti_about_page_plugins_display_column( $plugins_secondhalf );
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
         *
         */
        public function ti_about_page_plugins_display_column( $ti_about_page_plugins_array ) {
            if( !empty( $ti_about_page_plugins_array ) ) {
                echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
                foreach ( $ti_about_page_plugins_array as $plugin ) {

                    if( !empty( $plugin['title'] ) ) {
                        echo '<h4>'.$plugin['title'].'</h4>';
                    }
                    if( !empty( $plugin['description'] ) ) {
                        echo '<p>'.$plugin['description'].'</p>';
                    }
                    if( isset($plugin['check']) && !empty($plugin['link_label']) ) {
                        if( $plugin['check'] ) {
                            echo '<p><span class="ti-about-page-w-activated button">'.__( 'Already activated', $this->text_domain ).'</span></p>';
                        }
                        else {
                            if( !empty( $plugin['slug'] ) ) {
                                echo '<p><a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $plugin['slug'] ), 'install-plugin_' . $plugin['slug'] ) ) . '" class="button button-primary">' . $plugin['link_label'] . '</a></p>';
                            } elseif( !empty( $plugin['link'] ) ) {
                                echo '<p><a href="' . esc_url( $plugin['link'] ) . '" class="button button-primary">' . $plugin['link_label'] . '</a></p>';
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

            if( !empty( $this->documentation ) ) {
                echo '<div class="ti-about-page-tab-pane-center">';
                    echo '<h1>'.__( 'View full documentation', $this->text_domain ).'</h1>';
                    echo '<p>'.sprintf( __( 'Need more details? Please check our full documentation for detailed information on how to use %s.', $this->text_domain ), $this->theme_name ).'</p>';
                    echo '<p><a href="'.esc_url( $this->documentation ).'" class="button button-primary">'.__( 'Read full documentation', $this->text_domain ).'</a></p>';
                echo '</div>';
            }
        }

        /**
         * Github section
         */
        public function ti_about_page_github() {

            if( !empty( $this->github ) ) {

                echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
                    echo '<p><strong>'.__( 'Found a bug? Want to contribute with a fix or create a new feature?',$this->text_domain).'</strong></p>';
                    echo '<p>'.__( 'GitHub is the place to go!',$this->text_domain ).'</p>';
                    echo '<p><a href="'.$this->github.'" class="github-button button button-primary">'.sprintf( __( '%s on GitHub', $this->text_domain ),$this->theme_name ).'</a></p>';
                    echo '<hr>';
                echo '</div>';

            }
        }

        /**
         * WordPress.org translations section
         */
        public function ti_about_page_wporg_translations() {

            if( !empty( $this->translations_wporg ) ) {

                echo '<div class="ti-about-page-tab-pane-half">';
                    echo '<p><strong>'.sprintf( __( 'Are you a polyglot? Want to translate %s into your own language?', $this->text_domain ), $this->theme_name ).'</strong></p>';
                    echo '<p>'.__( 'Get involved at WordPress.org.', $this->text_domain ).'</p>';
                    echo '<p><a href="'.$this->translations_wporg.'" class="translate-button button button-primary">'.sprintf( __( 'Translate %s', $this->text_domain ), $this->theme_name ).'</a></p>';
                    echo '<hr>';
                echo '</div>';

            }
        }

        /**
         * WordPress.org ratings section
         */
        public function ti_about_page_wporg_reviews() {

            if( !empty( $this->review_wporg ) ) {
                echo '<div>';
                    echo '<h4>'.sprintf( __( 'Are you enjoying %s?', $this->text_domain ),$this->theme_name ).'</h4>';
                    echo '<p class="review-link">'.sprintf( __( 'Rate our theme on %sWordPress.org%s. We\'d really appreciate it!', $this->text_domain ), '<a href="'.$this->review_wporg.'">', '</a>' ).'</p>';
                    echo '<p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>';
                echo '</div>';
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
         *
         */
        public function ti_about_page_child_themes_display_column( $ti_about_page_child_array ) {

            if( !empty($ti_about_page_child_array) ) {

                $current_theme = wp_get_theme();

                echo '<div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">';
                foreach ($ti_about_page_child_array as $child) {

                    if (!empty($child['image'])) {
                        echo '<div class="ti-about-page-child-theme-container">';

                        echo '<div class="ti-about-page-child-theme-image-container">';
                        echo '<img src="' . $child['image'] . '" alt="' . (!empty($child['image_alt']) ? $child['image_alt'] : "") . '" />';

                        if (!empty($child['description'])) {
                            echo '<div class="ti-about-page-child-theme-description">';
                            echo '<h2>' . $child['description'] . '</h2>';
                            echo '</div>';
                        }
                        if (!empty($child['title'])) {
                            echo '<div class="ti-about-page-child-theme-details">';
                            if ($child['title'] != $current_theme['Name']) {
                                echo '<div class="theme-details">';
                                echo '<span class="theme-name">' . $child['title'] . '</span>';
                                if (!empty($child['download_link'])) {
                                    echo '<a href="' . $child['download_link'] . '" class="button button-primary install right">' . __( 'Get now', $this->text_domain ) . '</a>';
                                }
                                if (!empty($child['preview_link'])) {
                                    echo '<a class="button button-secondary preview right" target="_blank" href="' . $child['preview_link'] . '">' . __( 'Live Preview', $this->text_domain ) . '</a>';
                                }
                                echo '<div class="ti-about-page-clear"></div>';
                                echo '</div>';
                            } else {
                                echo '<div class="theme-details active">';
                                echo '<span class="theme-name">' . $this->theme_name . ' - ' . __( 'Current theme', $this->text_domain ) . '</span>';
                                echo '<a class="button button-secondary customize right" target="_blank" href="' . get_site_url() . '/wp-admin/customize.php">' . __( 'Customize', $this->text_domain ) . '</a>';
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

            if ( 'appearance_page_'.$this->theme_slug.'-welcome' == $hook_suffix ) {

                wp_enqueue_style( 'ti-about-page-css', get_template_directory_uri() . '/ti-about-page/css/ti_about_page_css.css' );
                wp_enqueue_script( 'ti-about-page-js', get_template_directory_uri() . '/ti-about-page/js/ti_about_page_scripts.js', array('jquery') );

                $nr_actions_required = 0;
                /* get number of required actions */
                if( get_option('ti_about_page_show_required_actions') ) {
                    $ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );
                } else {
                    $ti_about_page_show_required_actions = array();
                }
                if( !empty( $this->required_actions ) ) {
                    foreach ( $this->required_actions as $ti_about_page_required_action_value ) {
                        if ( ( ! isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ( ( isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) && ( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] == true ) ) || ! isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) ) ) {
                            $nr_actions_required ++;
                        }
                    }
                }
                wp_localize_script( 'ti-about-page-js', 'tiAboutPageObject', array(
                    'nr_actions_required' => $nr_actions_required,
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                    'template_directory' => get_template_directory_uri(),
                    'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.',$this->theme_name )
                ) );

            }

        }
        /**
         * Load css and scripts for customizer page
         */
        public function ti_about_page_css_and_scripts_for_customizer() {

            wp_enqueue_style( 'ti-about-page-customizer-css', get_template_directory_uri() . '/ti-about-page/css/ti_about_page_css_customizer.css' );
            wp_enqueue_script( 'ti-about-page-customizer-js', get_template_directory_uri() . '/ti-about-page/js/ti_about_page_scripts_customizer.js', array( 'jquery' ), '20120206', true );

            $nr_actions_required = 0;
            /* get number of required actions */
            if ( get_option( 'ti_about_page_show_required_actions' ) ) {
                $ti_about_page_show_required_actions = get_option( 'ti_about_page_show_required_actions' );
            } else {
                $ti_about_page_show_required_actions = array();
            }
            if( !empty( $this->required_actions ) ) {
                foreach ( $this->required_actions as $ti_about_page_required_action_value ) {
                    if ( ( ! isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ( ( isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) && ( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] == true ) ) || ! isset( $ti_about_page_show_required_actions[ $ti_about_page_required_action_value['id'] ] ) ) ) {
                        $nr_actions_required ++;
                    }
                }
            }

            wp_localize_script( 'ti-about-page-customizer-js', 'tiAboutPageCustomizerObject', array(
                'nr_actions_required' => $nr_actions_required,
                'aboutpage' => esc_url( admin_url( 'themes.php?page='.$this->theme_slug.'-welcome#actions_required' ) ),
                'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
                'themeinfo' => __('View Theme Info',$this->text_domain),
            ) );

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