<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package FlyMag
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'flymag' ); ?></a>

	<?php if ( get_theme_mod( 'latest_news_display', 1 ) ) : ?>
		<?php echo flymag_ticker_template(); ?>
	<?php endif; ?>

	<header id="masthead" class="site-header container clearfix" role="banner">
		<div class="site-branding clearfix">
			<?php if ( get_theme_mod( 'site_logo' ) && get_theme_mod( 'logo_style', 'hide-title' ) == 'hide-title' ) : // Show only logo ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><img class="site-logo" src="<?php echo esc_url( get_theme_mod( 'site_logo' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
			<?php elseif ( get_theme_mod( 'logo_style', 'hide-title' ) == 'show-title' ) : // Show logo, site-title, site-description ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><img class="site-logo show-title" src="<?php echo esc_url( get_theme_mod( 'site_logo' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	        
			<?php else : // Show only site title and description ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
		</div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'fallback_cb' => 'flymag_menu_fallback',
			) ); ?>
			<span class="search-toggle"><i class="fa fa-search"></i></span>
			<?php get_search_form(); ?>	
		</nav><!-- #site-navigation -->
		<nav class="mobile-nav"></nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content container clearfix">
	<?php if ( ( get_theme_mod( 'carousel_display_front' ) && is_front_page() ) || ( get_theme_mod( 'carousel_display_archives', '1' ) && ( is_home() || is_archive() ) ) || ( ( get_theme_mod( 'carousel_display_singular' ) && is_singular() ) ) ) : ?>
		<?php echo flymag_slider_template(); ?>
	<?php endif; ?>
