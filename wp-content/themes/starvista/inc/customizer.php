<?php
/**
 * Customizer settings for logo-adjacent copy and social URLs.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'starvista_site',
		array(
			'title'    => __( 'StarVista Options', 'starvista' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting( 'starvista_tagline', array( 'default' => 'Entertainment. Fashion. Lifestyle.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'starvista_tagline',
		array(
			'label'   => __( 'Header tagline', 'starvista' ),
			'section' => 'starvista_site',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'starvista_customize_register' );
