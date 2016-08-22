<?php
/**
* ThemeIsle - About page class
*/

if ( ! class_exists( 'TI_About_Page' ) ) {

	class TI_About_Page {

		public function __construct() {

			add_action( 'init', array( $this, 'init' ) );

		}

		public function init() {

			do_action( 'ti_about_page_register' );

		}

	}
}


if ( ! function_exists( 'ti_about_page' ) ) {

	function ti_about_page( $config = array() ) {

		if ( ! empty( $config ) && is_array( $config ) ) {

			add_theme_page( 'About Zerif Lite', 'About Zerif Lite', 'activate_plugins', 'zerif-lite-welcome', '' );


		}

	}
}
?>