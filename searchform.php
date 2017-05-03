<?php
/**
 * Search form
 *
 * @package Flymag
 */
?>

<div class="search-wrapper">
	<form role="search" method="get" class="flymag-search-form" action="<?php echo home_url( '/' ); ?>">
		<span class="search-close"><i class="fa fa-times"></i></span>
		<label>
			<span class="screen-reader-text"><?php echo __( 'Search for:', 'flymag' ) ?></span>
			<input type="search" class="search-field" placeholder="<?php echo __( 'Type and press enter', 'flymag' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:','search page', 'flymag' ) ?>" />
		</label>
	</form>
</div>
