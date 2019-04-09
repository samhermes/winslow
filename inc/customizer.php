<?php
/**
 * Winslow Theme Customizer.
 *
 * @package Winslow
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function winslow_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'winslow_customize_register' );

require get_template_directory() . '/inc/customizer/site-identity.php';
require get_template_directory() . '/inc/customizer/header.php';
require get_template_directory() . '/inc/customizer/footer.php';

function winslow_customizer_css() { ?>
	<style>
		.site-header {
			background-color: <?php echo get_theme_mod( 'winslow_header_background' ); ?>;
		}

		.site-title a {
			color: <?php echo get_theme_mod( 'winslow_title_text_color' ); ?>;
		}

		<?php if ( get_theme_mod( 'winslow_header_layout' ) === 'stacked' ) { ?>
		.is-style-stacked + .main-navigation {
			background-color: <?php echo get_theme_mod( 'winslow_navigation_background' ); ?>;
		}
		<?php } ?>

		<?php if ( $logo_width = get_theme_mod( 'winslow_logo_width' ) ) {
			$logo_width = $logo_width / 16; ?>
		.custom-logo {
			width: <?php echo $logo_width; ?>rem;
		}
		<?php } ?>

		.main-navigation a {
			color: <?php echo get_theme_mod( 'winslow_navigation_text_color' ); ?>;
		}

		.search-toggle .glass {
			fill: <?php echo get_theme_mod( 'winslow_navigation_text_color' ); ?>;
		}

		.search-toggle .handle {
			stroke: <?php echo get_theme_mod( 'winslow_navigation_text_color' ); ?>;
		}

		.site-footer {
			background-color: <?php echo get_theme_mod( 'winslow_footer_background' ); ?>;
			color: <?php echo get_theme_mod( 'winslow_footer_text_color' ); ?>;
		}
	</style>
<?php }
add_action( 'wp_head', 'winslow_customizer_css');

/**
 * Add custom logo field to customizer, replaces site title in header.
 */
function winslow_site_logo() {
	$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'winslow_site_logo' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function winslow_customize_preview_js() {
	wp_enqueue_script( 'winslow_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'winslow_customize_preview_js' );
/*
function winslow_customize_controls_js() {
	wp_enqueue_script( 'winslow_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'winslow_customize_controls_js' ); */
