<?php
/**
 * Custom theme style
 *
 * @package FlyMag
 */

/**
 * Add custom style
 *
 * @param string $custom Input string.
 */
function flymag_custom_styles( $custom ) {

	// __COLORS
	// Color scheme
	$color_scheme_1 = get_theme_mod( 'color_scheme_1' );
	if ( isset( $color_scheme_1 ) && ( $color_scheme_1 != '#F0696A' ) ) {
		$custom = '.social-navigation li:hover > a::before, a, a:hover, a:focus, a:active { color:' . esc_html( $color_scheme_1 ) . '}' . "\n";
		$custom .= '.custom-menu-item-1:hover, .custom-menu-item-1 .sub-menu, .ticker-info, button, .button, input[type="button"], input[type="reset"], input[type="submit"] { background-color:' . esc_html( $color_scheme_1 ) . '}' . "\n";
		$custom .= '.custom-menu-item-1 { border-color:' . esc_html( $color_scheme_1 ) . '}' . "\n";
	}
	$color_scheme_2 = get_theme_mod( 'color_scheme_2' );
	if ( isset( $color_scheme_2 ) && ( $color_scheme_2 != '#5B8AC0' ) ) {
		$custom .= '.custom-menu-item-2:hover, .custom-menu-item-2 .sub-menu { background-color:' . esc_html( $color_scheme_2 ) . '}' . "\n";
		$custom .= '.custom-menu-item-2 { border-color:' . esc_html( $color_scheme_2 ) . '}' . "\n";
	}
	$color_scheme_3 = get_theme_mod( 'color_scheme_3' );
	if ( isset( $color_scheme_3 ) && ( $color_scheme_3 != '#ED945D' ) ) {
		$custom .= '.custom-menu-item-3:hover, .custom-menu-item-3 .sub-menu { background-color:' . esc_html( $color_scheme_3 ) . '}' . "\n";
		$custom .= '.custom-menu-item-3 { border-color:' . esc_html( $color_scheme_3 ) . '}' . "\n";
	}
	$color_scheme_4 = get_theme_mod( 'color_scheme_4' );
	if ( isset( $color_scheme_4 ) && ( $color_scheme_4 != '#9F76CA' ) ) {
		$custom .= '.custom-menu-item-4:hover, .custom-menu-item-4 .sub-menu { background-color:' . esc_html( $color_scheme_4 ) . '}' . "\n";
		$custom .= '.custom-menu-item-4 { border-color:' . esc_html( $color_scheme_4 ) . '}' . "\n";
	}
	$color_scheme_5 = get_theme_mod( 'color_scheme_5' );
	if ( isset( $color_scheme_5 ) && ( $color_scheme_5 != '#7FC09B' ) ) {
		$custom .= '.custom-menu-item-0:hover, .custom-menu-item-0 .sub-menu { background-color:' . esc_html( $color_scheme_5 ) . '}' . "\n";
		$custom .= '.custom-menu-item-0 { border-color:' . esc_html( $color_scheme_5 ) . '}' . "\n";
	}
	// Header
	$header_color = get_theme_mod( 'header_color' );
	if ( isset( $header_color ) && ( $header_color != '#ffffff' ) ) {
		$custom .= '.site-branding { background-color:' . esc_html( $header_color ) . '}' . "\n";
	}
	// Latest news
	$latest_news_color = get_theme_mod( 'latest_news_color' );
	if ( isset( $latest_news_color ) && ( $latest_news_color != '#333' ) ) {
		$custom .= '.news-ticker { background-color:' . esc_html( $latest_news_color ) . '}' . "\n";
	}
	// Site title
	$site_title = get_theme_mod( 'site_title_color' );
	if ( isset( $site_title ) && ( $site_title != '#1E262D' ) ) {
		$custom .= '.site-title a, .site-title a:hover { color:' . esc_html( $site_title ) . '}' . "\n";
	}
	// Site desc
	$site_desc = get_theme_mod( 'site_desc_color' );
	if ( isset( $site_desc ) && ( $site_desc != '#ABADB2' ) ) {
		$custom .= '.site-description { color:' . esc_html( $site_desc ) . '}' . "\n";
	}
	// Menu bg
	$menu_bg = get_theme_mod( 'menu_bg_color' );
	if ( isset( $menu_bg ) && ( $menu_bg != '#ffffff' ) ) {
		$custom .= '.main-navigation { background-color:' . esc_html( $menu_bg ) . '}' . "\n";
	}
	// Menu items
	$menu_items = get_theme_mod( 'menu_items_color' );
	if ( isset( $menu_items ) && ( $menu_items != '#505559' ) ) {
		$custom .= '.main-navigation a, .main-navigation li::before { color:' . esc_html( $menu_items ) . '}' . "\n";
	}
	// Body text
	$body_text = get_theme_mod( 'body_text_color' );
	if ( isset( $body_text ) && ( $body_text != '#989FA8' ) ) {
		$custom .= 'body { color:' . esc_html( $body_text ) . '}' . "\n";
	}
	// Widgets
	$widgets = get_theme_mod( 'widgets_color' );
	if ( isset( $widgets ) && ( $widgets != '#989FA8' ) ) {
		$custom .= '.widget-area .widget, .widget-area .widget a { color:' . esc_html( $widgets ) . '}' . "\n";
	}
	// Footer
	$footer_bg = get_theme_mod( 'footer_color' );
	if ( isset( $footer_bg ) && ( $footer_bg != '#333' ) ) {
		$custom .= '.site-footer, .footer-widget-area { background-color:' . esc_html( $footer_bg ) . '}' . "\n";
	}
	// Header padding
	$branding_padding = get_theme_mod( 'branding_padding' );
	if ( $branding_padding ) {
		$custom .= '.site-branding { padding:' . intval( $branding_padding ) . 'px 30px; }' . "\n";
	}
	// Fonts
	$body_fonts = get_theme_mod( 'body_font_family' );
	$headings_fonts = get_theme_mod( 'headings_font_family' );
	if ( $body_fonts != '' ) {
		$custom .= 'body { font-family:' . $body_fonts . ';}' . "\n";
	}
	if ( $headings_fonts != '' ) {
		$custom .= 'h1, h2, h3, h4, h5, h6, .ticker-info, .main-navigation { font-family:' . $headings_fonts . ';}' . "\n";
	}
	// Site title
	$site_title_size = get_theme_mod( 'site_title_size', '62' );
	if ( get_theme_mod( 'site_title_size' ) ) {
		$custom .= '.site-title { font-size:' . intval( $site_title_size ) . 'px; }' . "\n";
	}
	// Site description
	$site_desc_size = get_theme_mod( 'site_desc_size', '18' );
	if ( get_theme_mod( 'site_desc_size' ) ) {
		$custom .= '.site-description { font-size:' . intval( $site_desc_size ) . 'px; }' . "\n";
	}
	// Menu
	$menu_size = get_theme_mod( 'menu_size', '16' );
	if ( get_theme_mod( 'menu_size' ) ) {
		$custom .= '.main-navigation li { font-size:' . intval( $menu_size ) . 'px; }' . "\n";
	}
	// H1 size
	$h1_size = get_theme_mod( 'h1_size' );
	if ( get_theme_mod( 'h1_size' ) ) {
		$custom .= 'h1 { font-size:' . intval( $h1_size ) . 'px; }' . "\n";
	}
	// H2 size
	$h2_size = get_theme_mod( 'h2_size' );
	if ( get_theme_mod( 'h2_size' ) ) {
		$custom .= 'h2 { font-size:' . intval( $h2_size ) . 'px; }' . "\n";
	}
	// H3 size
	$h3_size = get_theme_mod( 'h3_size' );
	if ( get_theme_mod( 'h3_size' ) ) {
		$custom .= 'h3 { font-size:' . intval( $h3_size ) . 'px; }' . "\n";
	}
	// H4 size
	$h4_size = get_theme_mod( 'h4_size' );
	if ( get_theme_mod( 'h4_size' ) ) {
		$custom .= 'h4 { font-size:' . intval( $h4_size ) . 'px; }' . "\n";
	}
	// H5 size
	$h5_size = get_theme_mod( 'h5_size' );
	if ( get_theme_mod( 'h5_size' ) ) {
		$custom .= 'h5 { font-size:' . intval( $h5_size ) . 'px; }' . "\n";
	}
	// H6 size
	$h6_size = get_theme_mod( 'h6_size' );
	if ( get_theme_mod( 'h6_size' ) ) {
		$custom .= 'h6 { font-size:' . intval( $h6_size ) . 'px; }' . "\n";
	}
	// Body size
	$body_size = get_theme_mod( 'body_size' );
	if ( get_theme_mod( 'body_size' ) ) {
		$custom .= 'body { font-size:' . intval( $body_size ) . 'px; }' . "\n";
	}

	// Logo size
	$logo_size = get_theme_mod( 'logo_size', '200' );
	if ( get_theme_mod( 'logo_size' ) ) {
		$custom .= '.site-logo { max-width:' . intval( $logo_size ) . 'px; }' . "\n";
	}

	// Output all the styles
	wp_add_inline_style( 'flymag-style', $custom );
}
add_action( 'wp_enqueue_scripts', 'flymag_custom_styles' );
