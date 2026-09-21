<?php
/**
 * Enqueue scripts and styles.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_fonts_url() {
	$families = array(
		'Plus+Jakarta+Sans:wght@500;600;700;800',
		'Inter:wght@400;500;600;700',
	);
	return 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $families ) . '&display=swap';
}

function starvista_enqueue_assets() {
	wp_enqueue_style( 'starvista-fonts', starvista_fonts_url(), array(), null );
	wp_enqueue_style( 'starvista-main', STARVISTA_URI . '/assets/css/main.css', array( 'starvista-fonts' ), STARVISTA_VERSION );

	wp_enqueue_script(
		'starvista-nav',
		STARVISTA_URI . '/assets/js/navigation.js',
		array(),
		STARVISTA_VERSION,
		true
	);

	wp_localize_script(
		'starvista-nav',
		'starvistaNav',
		array(
			'open'  => __( 'Open menu', 'starvista' ),
			'close' => __( 'Close menu', 'starvista' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'starvista_enqueue_assets' );

function starvista_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'starvista_resource_hints', 10, 2 );
