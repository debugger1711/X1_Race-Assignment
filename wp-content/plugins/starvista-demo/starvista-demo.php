<?php
/**
 * Plugin Name: StarVista Demo Content
 * Description: Creates sample categories, pages, menus, and entertainment posts for the StarVista internship site. Free plugin used only for demo data.
 * Version: 1.0.0
 * Author: StarVista
 * Text Domain: starvista-demo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'STARVISTA_DEMO_FILE', __FILE__ );
define( 'STARVISTA_DEMO_DIR', plugin_dir_path( __FILE__ ) );

require_once STARVISTA_DEMO_DIR . 'includes/images.php';
require_once STARVISTA_DEMO_DIR . 'includes/content.php';
require_once STARVISTA_DEMO_DIR . 'includes/importer.php';

register_activation_hook( __FILE__, 'starvista_demo_activate' );

function starvista_demo_activate() {
	update_option( 'starvista_demo_pending', 1 );
}

add_action( 'init', 'starvista_demo_maybe_import_cli', 20 );

function starvista_demo_maybe_import_cli() {
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		WP_CLI::add_command( 'starvista import', 'starvista_demo_run_import' );
	}
}

function starvista_demo_maybe_import() {
	if ( ! get_option( 'starvista_demo_pending' ) ) {
		return;
	}
	if ( get_option( 'starvista_demo_complete' ) ) {
		delete_option( 'starvista_demo_pending' );
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	starvista_demo_run_import();
}

add_action( 'admin_notices', function () {
	if ( get_option( 'starvista_demo_complete' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$url = wp_nonce_url( admin_url( 'admin-post.php?action=starvista_demo_import' ), 'starvista_demo_import' );
	echo '<div class="notice notice-info"><p><strong>StarVista:</strong> Sample content is not installed yet. <a class="button button-primary" href="' . esc_url( $url ) . '">Import demo content</a></p></div>';
} );

add_action( 'admin_post_starvista_demo_import', function () {
	check_admin_referer( 'starvista_demo_import' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Not allowed' );
	}
	starvista_demo_run_import();
	wp_safe_redirect( admin_url( 'themes.php?starvista_imported=1' ) );
	exit;
} );
