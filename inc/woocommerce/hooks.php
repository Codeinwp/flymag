<?php
/**
 * flymag WooCommerce hooks
 *
 * @package flymag
 */

/**
 * Styles
 *
 * @see  flymag_woocommerce_scripts()
 */

/**
 * Layout
 *
 * @see  flymag_before_content()
 * @see  flymag_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  flymag_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',                 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar',                10 );
remove_action( 'woocommerce_after_shop_loop',     'woocommerce_pagination',                 10 );
remove_action( 'woocommerce_before_shop_loop',    'woocommerce_result_count',               20 );
remove_action( 'woocommerce_before_shop_loop',    'woocommerce_catalog_ordering',           30 );
add_action( 'woocommerce_before_main_content',    'flymag_before_content',              10 );
add_action( 'woocommerce_after_main_content',     'flymag_after_content',               10 );
add_action( 'flymag_content_top',             'flymag_shop_messages',               15 );
add_action( 'flymag_content_top',             'woocommerce_breadcrumb',                 10 );

add_action( 'woocommerce_after_shop_loop',        'flymag_sorting_wrapper',             9 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_catalog_ordering',           10 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_result_count',               20 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_pagination',                 30 );
add_action( 'woocommerce_after_shop_loop',        'flymag_sorting_wrapper_close',       31 );

add_action( 'woocommerce_before_shop_loop',       'flymag_sorting_wrapper',             9 );
add_action( 'woocommerce_before_shop_loop',       'woocommerce_catalog_ordering',           10 );
add_action( 'woocommerce_before_shop_loop',       'woocommerce_result_count',               20 );
add_action( 'woocommerce_before_shop_loop',       'flymag_woocommerce_pagination',      30 );
add_action( 'woocommerce_before_shop_loop',       'flymag_sorting_wrapper_close',       31 );

add_action( 'flymag_footer',                  'flymag_handheld_footer_bar',         999 );

/**
 * Products
 *
 * @see  flymag_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',               15 );
add_action( 'woocommerce_after_single_product_summary',    'flymag_upsell_display',                15 );
remove_action( 'woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash', 6 );

/**
 * Header
 *
 * @see  flymag_product_search()
 * @see  flymag_header_cart()
 */
add_action( 'flymag_header', 'flymag_product_search', 40 );
add_action( 'flymag_header', 'flymag_header_cart',    60 );

/**
 * Structured Data
 *
 * @see flymag_woocommerce_init_structured_data()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
	add_action( 'woocommerce_before_shop_loop_item', 'flymag_woocommerce_init_structured_data' );
}

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'flymag_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'flymag_cart_link_fragment' );
}
