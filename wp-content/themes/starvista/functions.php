<?php
/**
 * StarVista theme bootstrap.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'STARVISTA_VERSION', '1.0.1' );
define( 'STARVISTA_DIR', get_template_directory() );
define( 'STARVISTA_URI', get_template_directory_uri() );

require_once STARVISTA_DIR . '/inc/setup.php';
require_once STARVISTA_DIR . '/inc/enqueue.php';
require_once STARVISTA_DIR . '/inc/template-tags.php';
require_once STARVISTA_DIR . '/inc/customizer.php';
require_once STARVISTA_DIR . '/inc/elementor.php';
