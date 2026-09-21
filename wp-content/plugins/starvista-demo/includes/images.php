<?php
/**
 * Local cinematic placeholder image generator (no third-party copyright).
 *
 * @package StarVista_Demo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_demo_palette( $seed ) {
	$palettes = array(
		array( array( 18, 18, 18 ), array( 255, 45, 107 ), array( 90, 20, 40 ) ),
		array( array( 12, 24, 48 ), array( 245, 197, 24 ), array( 30, 50, 90 ) ),
		array( array( 28, 10, 36 ), array( 190, 80, 180 ), array( 70, 20, 90 ) ),
		array( array( 8, 40, 42 ), array( 40, 180, 160 ), array( 10, 70, 80 ) ),
		array( array( 40, 12, 12 ), array( 220, 80, 40 ), array( 90, 30, 20 ) ),
		array( array( 16, 16, 30 ), array( 120, 140, 255 ), array( 40, 40, 80 ) ),
		array( array( 20, 20, 20 ), array( 240, 240, 240 ), array( 80, 80, 80 ) ),
		array( array( 48, 20, 8 ), array( 255, 170, 60 ), array( 120, 60, 20 ) ),
	);
	return $palettes[ abs( crc32( $seed ) ) % count( $palettes ) ];
}

function starvista_demo_create_image_file( $slug, $label ) {
	$stock = WP_CONTENT_DIR . '/uploads/starvista-stock/' . sanitize_file_name( $slug ) . '.jpg';
	if ( file_exists( $stock ) && filesize( $stock ) > 8000 ) {
		return $stock;
	}

	if ( ! function_exists( 'imagecreatetruecolor' ) ) {
		return false;
	}

	$dir = WP_CONTENT_DIR . '/uploads/starvista-seed';
	if ( ! is_dir( $dir ) ) {
		wp_mkdir_p( $dir );
	}
	$path = $dir . '/' . sanitize_file_name( $slug ) . '.jpg';
	if ( file_exists( $path ) && filesize( $path ) > 1000 ) {
		return $path;
	}

	$w  = 1200;
	$h  = 750;
	$im = imagecreatetruecolor( $w, $h );
	$p  = starvista_demo_palette( $slug );
	$bg = imagecolorallocate( $im, $p[0][0], $p[0][1], $p[0][2] );
	$a  = imagecolorallocate( $im, $p[1][0], $p[1][1], $p[1][2] );
	$b  = imagecolorallocate( $im, $p[2][0], $p[2][1], $p[2][2] );
	$white = imagecolorallocate( $im, 255, 255, 255 );

	imagefilledrectangle( $im, 0, 0, $w, $h, $bg );
	imagefilledellipse( $im, 900, 180, 520, 520, $b );
	imagefilledrectangle( $im, 0, 430, $w, $h, $a );
	imagefilledrectangle( $im, 0, 0, 18, $h, $a );
	imagefilledrectangle( $im, 70, 90, 430, 320, $b );

	$caption = strtoupper( wp_strip_all_tags( $label ) );
	$caption = strlen( $caption ) > 42 ? substr( $caption, 0, 42 ) . '…' : $caption;
	imagestring( $im, 5, 80, 620, 'STARVISTA', $white );
	imagestring( $im, 5, 80, 650, $caption, $white );

	imagejpeg( $im, $path, 82 );
	imagedestroy( $im );
	return $path;
}

function starvista_demo_attach_image( $post_id, $slug, $label ) {
	$path = starvista_demo_create_image_file( $slug, $label );
	if ( ! $path ) {
		return 0;
	}

	$filename = basename( $path );
	$filetype = wp_check_filetype( $filename, null );
	$upload   = wp_upload_dir();
	$dest     = $upload['path'] . '/' . $filename;
	if ( $path !== $dest ) {
		copy( $path, $dest );
	}

	$attachment = array(
		'post_mime_type' => $filetype['type'] ? $filetype['type'] : 'image/jpeg',
		'post_title'     => $label,
		'post_content'   => '',
		'post_status'    => 'inherit',
	);
	$attach_id = wp_insert_attachment( $attachment, $dest, $post_id );
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$meta = wp_generate_attachment_metadata( $attach_id, $dest );
	wp_update_attachment_metadata( $attach_id, $meta );
	set_post_thumbnail( $post_id, $attach_id );
	update_post_meta( $attach_id, '_wp_attachment_image_alt', $label );
	return $attach_id;
}
