<?php
/**
 * Elementor Free compatibility and custom widget registration.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_elementor_ready() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}

	add_action( 'elementor/elements/categories_registered', 'starvista_register_elementor_category' );
	add_action( 'elementor/widgets/register', 'starvista_register_elementor_widgets' );
}
add_action( 'init', 'starvista_elementor_ready' );

function starvista_register_elementor_category( $elements_manager ) {
	$elements_manager->add_category(
		'starvista',
		array(
			'title' => __( 'StarVista', 'starvista' ),
			'icon'  => 'fa fa-plug',
		)
	);
}

function starvista_register_elementor_widgets( $widgets_manager ) {
	require_once STARVISTA_DIR . '/inc/elementor-widgets/class-posts-grid-widget.php';
	require_once STARVISTA_DIR . '/inc/elementor-widgets/class-hero-widget.php';
	$widgets_manager->register( new StarVista_Posts_Grid_Widget() );
	$widgets_manager->register( new StarVista_Hero_Widget() );
}

function starvista_elementor_location_support() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}
	if ( ! class_exists( '\Elementor\Core\Kits\Documents\Kit' ) ) {
		return;
	}
	add_theme_support( 'elementor-theme-builder' );
}
add_action( 'after_setup_theme', 'starvista_elementor_location_support' );
