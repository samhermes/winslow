<?php
/**
 * Adds customizer controls for the site header.
 *
 * @package Winslow
 */

function winslow_customize_header( $wp_customize ) {
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

	$wp_customize->add_setting( 'winslow_header_sticky', array(
		'default' => false,
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_header_sticky', array(
		'label' => __( 'Sticky' ),
		'type' => 'checkbox',
        'section' => 'winslow_header',
        'settings' => 'winslow_header_sticky',
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

	$wp_customize->add_setting( 'winslow_identity_height' , array(
		'default' => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_identity_height', array(
        'label' => __( 'Site Identity Height', 'winslow' ),
        'description' => __( 'In pixels, the height of the container around either the site logo or title.', 'winslow' ),
		'type' => 'number',
        'section' => 'winslow_header',
        'settings' => 'winslow_identity_height',
    ) );

	$wp_customize->add_setting( 'winslow_title_text_color' , array(
		'default' => '#404040',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'winslow_title_text_color',
		array(
			'label' => __( 'Site Title Text Color', 'winslow' ),
            'section' => 'winslow_header',
			'settings' => 'winslow_title_text_color',
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

	$wp_customize->add_setting( 'winslow_navigation_text_color' , array(
		'default' => '#404040',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'winslow_navigation_text_color',
		array(
			'label' => __( 'Navigation Text Color', 'winslow' ),
			'section' => 'winslow_header',
			'settings' => 'winslow_navigation_text_color',
		) )
	);
}
add_action( 'customize_register', 'winslow_customize_header' );