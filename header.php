<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leading_Minds
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'leading_minds' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrapper">
			<div class="site-branding">

				<a class="logo" href="<?php echo home_url(); ?>"><?php echo file_get_contents('wp-content/themes/leading_minds/imgs/logo-nav.svg'); ?></a>

				<!-- <a class="header-logo" href="#"><img src="http://localhost:8888/leading-minds/wp-content/themes/leading_minds/imgs/new-logo.png"></a> -->

				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">

				<button class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false"><img class="mobile-icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAsklEQVRoQ+2WMQ7EIAwE4/8/mijl6YopnFXAmrQOK5hBxnUd/tXh+788wNcGNaCBJgGvUBNge/k8A2ut1cYSDKiqH+h/BjxAkP4TPd9AGODr8fO60OuIwoEaCAPGeA0govAP8ww4SqSvjMNcmDDF4zBHAbvV53Wh3QjTfjRAhNJ1DaQJU/48A85C5LxZx5dYA03CtBwNUMBu9XldaDfCtB8NEKF0XQNpwpSvASKUrh9v4AbQsjAxOjNvzAAAAABJRU5ErkJggg==" width="48" height="48"></button>

				<?php wp_nav_menu( array( 'theme_location' => 'desktop-nav', 'menu_id' => 'primary-menu' ) ); ?>

				<div class="mobile-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'mobile-nav', 'menu_id' => 'mobile-menu' ) ); ?>
				</div>

			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="site-content-wrapper">
