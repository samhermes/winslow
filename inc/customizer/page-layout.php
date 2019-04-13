<?php
/**
 * Adds customizer controls for the page layout.
 *
 * @package Winslow
 */

function winslow_customize_page_layout( $wp_customize ) {
    $wp_customize->add_section( 'winslow_layout' , array(
		'title' => __( 'Page Layout', 'winslow' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'winslow_layout_width' , array(
		'default' => '1152',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'winslow_layout_width', array(
		'label' => __( 'Page Width', 'winslow' ),
		'description' => 'In pixels, sets the maximum width of site elements like the header and footer.',
		'type' => 'number',
		'section' => 'winslow_layout',
		'settings' => 'winslow_layout_width',
	) );
}
add_action( 'customize_register', 'winslow_customize_page_layout' );