<?php
/**
 * Theme setup, menus, image sizes, and core supports.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_setup() {
	load_theme_textdomain( 'starvista', STARVISTA_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 48,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'elementor' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'starvista' ),
			'footer'  => __( 'Footer Menu', 'starvista' ),
			'legal'   => __( 'Legal Menu', 'starvista' ),
		)
	);

	add_image_size( 'starvista-hero', 1200, 720, true );
	add_image_size( 'starvista-featured', 900, 600, true );
	add_image_size( 'starvista-card', 640, 400, true );
	add_image_size( 'starvista-thumb', 160, 160, true );
	add_image_size( 'starvista-review', 480, 720, true );
}
add_action( 'after_setup_theme', 'starvista_setup' );

function starvista_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'starvista_content_width', 0 );

function starvista_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer About', 'starvista' ),
			'id'            => 'footer-about',
			'before_widget' => '<div class="sv-footer-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="sv-footer-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'starvista_widgets_init' );

function starvista_excerpt_length( $length ) {
	return 18;
}
add_filter( 'excerpt_length', 'starvista_excerpt_length' );

function starvista_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'starvista_excerpt_more' );

function starvista_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'sv-home';
	}
	if ( is_singular() ) {
		$classes[] = 'sv-singular';
	}
	return $classes;
}
add_filter( 'body_class', 'starvista_body_classes' );

function starvista_cachebust_media_url( $url ) {
	if ( $url && false !== strpos( $url, '/wp-content/uploads/' ) ) {
		return add_query_arg( 'rev', 'photos1', $url );
	}
	return $url;
}
add_filter( 'wp_get_attachment_url', 'starvista_cachebust_media_url' );
add_filter(
	'wp_get_attachment_image_src',
	function ( $image ) {
		if ( is_array( $image ) && ! empty( $image[0] ) ) {
			$image[0] = starvista_cachebust_media_url( $image[0] );
		}
		return $image;
	}
);
add_filter( 'wp_calculate_image_srcset', function ( $sources ) {
	if ( is_array( $sources ) ) {
		foreach ( $sources as &$source ) {
			if ( ! empty( $source['url'] ) ) {
				$source['url'] = starvista_cachebust_media_url( $source['url'] );
			}
		}
	}
	return $sources;
} );
