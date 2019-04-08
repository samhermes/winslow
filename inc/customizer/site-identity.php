<?php
/**
 * Adds customizer controls for the site identity.
 *
 * @package Winslow
 */

function winslow_customize_site_identity( $wp_customize ) {
	$wp_customize->add_setting( 'winslow_logo_width' , array(
		'default' => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_logo_width', array(
        'label' => __( 'Logo Width', 'winslow' ),
        'description' => __( 'In pixels, with a maximum of 500px. The logo height will not exceed 60px.', 'winslow' ),
		'type' => 'number',
        'section' => 'title_tagline',
        'priority' => 8,
        'settings' => 'winslow_logo_width',
        'input_attrs' => array( 'min' => 0, 'max' => 500 ),
    ) );

    $wp_customize->add_setting( 'winslow_title_transform' , array(
		'default' => true,
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_title_transform', array(
        'label' => __( 'Use Uppercase for Site Title', 'winslow' ),
		'type' => 'checkbox',
        'section' => 'title_tagline',
        'priority' => 12,
        'settings' => 'winslow_title_transform',
    ) );
}
add_action( 'customize_register', 'winslow_customize_site_identity' );