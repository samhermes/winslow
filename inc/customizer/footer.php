<?php
/**
 * Adds customizer controls for the site footer.
 *
 * @package Winslow
 */

function winslow_customize_footer( $wp_customize ) {
    $wp_customize->add_section( 'winslow_footer' , array(
		'title' => __( 'Footer', 'winslow' ),
		'priority' => 31,
	) );

	$wp_customize->add_setting( 'winslow_footer_background' , array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'winslow_footer_background',
		array(
			'label' => __( 'Background Color', 'winslow' ),
			'section' => 'winslow_footer',
			'settings' => 'winslow_footer_background',
		) )
    );

    $wp_customize->add_setting( 'winslow_footer_text_color' , array(
		'default' => '#404040',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'winslow_footer_text_color',
		array(
			'label' => __( 'Text Color', 'winslow' ),
			'section' => 'winslow_footer',
			'settings' => 'winslow_footer_text_color',
		) )
	);
}
add_action( 'customize_register', 'winslow_customize_footer' );