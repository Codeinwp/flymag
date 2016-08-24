<?php
/**
 * ThemeIsle - About page class
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

                /* register the new page */
                add_action( 'admin_menu', array( $this, 'ti_about_page_register' ) );

                /* activation notice */
                add_action( 'load-themes.php', array( $this, 'ti_about_page_activation_admin_notice' ) );

                /* enqueue script and style for about page */
                add_action( 'admin_enqueue_scripts', array( $this, 'ti_about_page_style_and_scripts' ) );

                /* enqueue script and style for customizer */
                add_action( 'customize_controls_enqueue_scripts', array( $this, 'ti_about_page_style_scripts_for_customizer' ) );

                /* load main content for about page */
                add_action( 'ti_about_page', array( $this, 'ti_about_page_getting_started' ),	10 );
                add_action( 'ti_about_page', array( $this, 'ti_about_page_actions_required' ), 	20 );
                add_action( 'ti_about_page', array( $this, 'ti_about_page_child_themes' ), 	   	30 );
                add_action( 'ti_about_page', array( $this, 'ti_about_page_github' ), 		    40 );
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
                <li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started',$this->text_domain); ?></a></li>
                <li role="presentation" class="ti-about-page-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions required',$this->text_domain); ?></a></li>
                <li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Child themes',$this->text_domain); ?></a></li>
                <li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute',$this->text_domain); ?></a></li>
                <li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog',$this->text_domain); ?></a></li>
                <li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab"><?php esc_html_e( 'Free VS PRO',$this->text_domain); ?></a></li>
            </ul>

            <div class="ti-about-page-tab-content">

                <?php
                /**
                 * @hooked ti_about_page_getting_started - 10
                 * @hooked ti_about_page_actions_required - 20
                 * @hooked ti_about_page_child_themes - 30
                 * @hooked ti_about_page_github - 40
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
            require_once( get_template_directory() . '/ti-about-page/sections/getting-started.php' );
        }
        /**
         * Actions required
         */
        public function ti_about_page_actions_required() {
            require_once( get_template_directory() . '/ti-about-page/sections/actions-required.php' );
        }
        /**
         * Child themes
         */
        public function ti_about_page_child_themes() {
            require_once( get_template_directory() . '/ti-about-page/sections/child-themes.php' );
        }
        /**
         * Contribute
         */
        public function ti_about_page_github() {
            require_once( get_template_directory() . '/ti-about-page/sections/github.php' );
        }
        /**
         * Changelog
         */
        public function ti_about_page_changelog() {
            require_once( get_template_directory() . '/ti-about-page/sections/changelog.php' );
        }
        /**
         * Free vs PRO
         */
        public function ti_about_page_free_pro() {
            require_once( get_template_directory() . '/ti-about-page/sections/free_pro.php' );
        }

        /**
         * Load css and scripts for the about page
         */
        public function ti_about_page_style_and_scripts( $hook_suffix ) {

            if ( 'appearance_page_'.$this->theme_slug.'-welcome' == $hook_suffix ) {

                wp_enqueue_style( 'ti-about-page-css', get_template_directory_uri() . '/ti-about-page/css/ti_about_page_css.css' );
                wp_enqueue_script( 'ti-about-page-js', get_template_directory_uri() . '/ti-about-page/js/ti_about_page_scripts.js', array('jquery') );

                global $ti_about_page_required_actions;
                $nr_actions_required = 0;
                /* get number of required actions */
                if( get_option('ti_about_page_show_required_actions') ):
                    $ti_about_page_show_required_actions = get_option('ti_about_page_show_required_actions');
                else:
                    $ti_about_page_show_required_actions = array();
                endif;
                if( !empty($ti_about_page_required_actions) ):
                    foreach( $ti_about_page_required_actions as $ti_about_page_required_action_value ):
                        if(( !isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ((isset($ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']]) && ($ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']] == true)) || !isset($ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']]) )) :
                            $nr_actions_required++;
                        endif;
                    endforeach;
                endif;
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
            wp_enqueue_script( 'ti-about-page-customizer-js', get_template_directory_uri() . '/ti-about-page/js/ti_about_page_scripts_customizer.js', array('jquery'), '20120206', true );

            global $ti_about_page_required_actions;
            $nr_actions_required = 0;
            /* get number of required actions */
            if( get_option('ti_about_page_show_required_actions') ):
                $ti_about_page_show_required_actions = get_option('ti_about_page_show_required_actions');
            else:
                $ti_about_page_show_required_actions = array();
            endif;
            if( !empty($ti_about_page_required_actions) ):
                foreach( $ti_about_page_required_actions as $ti_about_page_required_action_value ):
                    if(( !isset( $ti_about_page_required_action_value['check'] ) || ( isset( $ti_about_page_required_action_value['check'] ) && ( $ti_about_page_required_action_value['check'] == false ) ) ) && ((isset($ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']]) && ($ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']] == true)) || !isset($ti_about_page_show_required_actions[$ti_about_page_required_action_value['id']]) )) :
                        $nr_actions_required++;
                    endif;
                endforeach;
            endif;
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

            $ti_about_page_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;
            echo $ti_about_page_dismiss_id; /* this is needed and it's the id of the dismissable required action */
            if( !empty($ti_about_page_dismiss_id) ):
                /* if the option exists, update the record for the specified id */
                if( get_option('ti_about_page_show_required_actions') ):
                    $ti_about_page_show_required_actions = get_option('ti_about_page_show_required_actions');
                    $ti_about_page_show_required_actions[$ti_about_page_dismiss_id] = false;
                    update_option( 'ti_about_page_show_required_actions',$ti_about_page_show_required_actions );
                /* create the new option,with false for the specified id */
                else:
                    $ti_about_page_show_required_actions_new = array();
                    if( !empty($ti_about_page_required_actions) ):
                        foreach( $ti_about_page_required_actions as $ti_about_page_required_action ):
                            if( $ti_about_page_required_action['id'] == $ti_about_page_dismiss_id ):
                                $ti_about_page_show_required_actions_new[$ti_about_page_required_action['id']] = false;
                            else:
                                $ti_about_page_show_required_actions_new[$ti_about_page_required_action['id']] = true;
                            endif;
                        endforeach;
                        update_option( 'ti_about_page_show_required_actions', $ti_about_page_show_required_actions_new );
                    endif;
                endif;
            endif;
            die(); // this is required to return a proper result
        }



    }
}

?>