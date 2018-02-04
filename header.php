<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ankh-Morpork
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ankh-morpork' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
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

		<nav id="site-navigation" class="main-navigation">
<!--			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
			< ?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			? >
-->
                      <div id="newsticker-container">
                      <ul id="newsticker-scrollable">
                      <li class="newsticker-item"><a href="https://antlarr.io/">(2018/01/30) This is a link to a post</a>
                      <li class="newsticker-item"><a href="https://antlarr.io/">(2018/02/01) How to install a package</a>
                      <li class="newsticker-item"><a href="https://antlarr.io/">(2018/02/03) How to develop with KDevelop in C++</a>
                      <li class="newsticker-item"><a href="https://antlarr.io/">(2018/02/04) How to make a newsticker</a>
                      <li class="newsticker-item"><a href="https://antlarr.io/">(2018/02/05) How to install and use mycroft AI in KDE Plasma</a>
                      <li class="newsticker-item"><a href="https://antlarr.io/">(2018/02/08) How to install some other application</a>
                      </ul>
                      </div>
                </nav><!-- #site-navigation -->

	</header><!-- #masthead -->

        <?php if( !is_front_page() && function_exists('bcn_display')) : ?>
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
                        <a href="/"><?php _e('Home') ?></a>
                        <?php bcn_display(); ?>
                </div>
        <?php endif; ?>

	<div id="content" class="site-content">
