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

	$wp_customize->add_section( 'winslow_header' , array(
		'title' => __( 'Header', 'winslow' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'winslow_header_layout' , array(
		'default' => 'stacked',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_header_layout', array(
		'label' => __( 'Layout', 'winslow' ),
		'type' => 'select',
		'choices' => array(
			'stacked' => 'Stacked',
			'condensed' => 'Condensed'
		),
		'section' => 'winslow_header',
		'settings' => 'winslow_header_layout',
	) );

	$wp_customize->add_setting( 'winslow_header_background' , array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'winslow_header_background',
		array(
			'label' => __( 'Background Color', 'winslow' ),
			'section' => 'winslow_header',
			'settings' => 'winslow_header_background',
		) )
	);

	$wp_customize->add_setting( 'winslow_navigation_background' , array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'winslow_navigation_background',
		array(
			'label' => __( 'Navigation Background Color', 'winslow' ),
			'section' => 'winslow_header',
			'settings' => 'winslow_navigation_background',
			'active_callback' => function( $control ) {
				return $control->manager->get_setting( 'winslow_header_layout' )->value() === 'stacked';
			}
		) )
	);

	$wp_customize->add_setting( 'winslow_header_sticky', array(
		'default' => false,
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_header_sticky', array(
		'label' => __( 'Sticky' ),
		'type' => 'checkbox',
		'section' => 'winslow_header',
	) );
}
add_action( 'customize_register', 'winslow_customize_register' );

function winslow_customizer_css() { ?>
	<style>
		.site-header { background-color: <?php echo get_theme_mod( 'winslow_header_background' ); ?>; }

		<?php if ( get_theme_mod( 'winslow_header_layout' ) === 'stacked' ) { ?>
		.is-style-stacked + .main-navigation { background-color: <?php echo get_theme_mod( 'winslow_navigation_background' ); ?>; }
		<?php } ?>

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
