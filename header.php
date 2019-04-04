<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Winslow
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'winslow' ); ?></a>

	<?php
	$header_layout = get_theme_mod( 'winslow_header_layout' );
	$header_layout_class = $header_layout == 'condensed' ? ' is-style-condensed' : ' is-style-stacked';
	?>

	<header id="masthead" class="site-header<?php echo $header_layout_class; ?>" role="banner">
		<div class="site-header-contain">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) :
					the_custom_logo();
				else :
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php
				endif; ?>
			</div>

			<?php if ( $header_layout === 'condensed' ) {
				get_template_part( 'inc/main-navigation' );
			} ?>
		</div>
	</header>

	<?php if ( $header_layout === 'stacked' ) {
		get_template_part( 'inc/main-navigation' );
	} ?>

	<div class="search-overlay">
		<?php get_search_form(); ?>
		<button type="button" class="search-close">
			<span class="screen-reader-text"><?php esc_html_e( 'Close search', 'winslow' ); ?></span>
		</button>
	</div>

	<div id="content" class="site-content">
