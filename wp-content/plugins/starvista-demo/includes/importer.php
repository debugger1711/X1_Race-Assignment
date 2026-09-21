<?php
/**
 * Import categories, users, posts, pages, and menus.
 *
 * @package StarVista_Demo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_demo_run_import() {
	if ( get_option( 'starvista_demo_complete' ) ) {
		return true;
	}

	require_once ABSPATH . 'wp-admin/includes/taxonomy.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	starvista_demo_create_categories();
	$authors = starvista_demo_create_authors();
	starvista_demo_create_posts( $authors );
	starvista_demo_create_pages();
	starvista_demo_create_menus();
	starvista_demo_configure_site();

	update_option( 'starvista_demo_complete', 1 );
	delete_option( 'starvista_demo_pending' );
	flush_rewrite_rules();
	return true;
}

function starvista_demo_create_categories() {
	$parents = array(
		'Entertainment' => 0,
		'Fashion'       => 0,
	);

	foreach ( starvista_demo_categories() as $name => $slug ) {
		if ( term_exists( $slug, 'category' ) ) {
			continue;
		}
		$parent = 0;
		if ( in_array( $slug, array( 'bollywood', 'hollywood', 'tv', 'south' ), true ) ) {
			$ent = get_term_by( 'slug', 'entertainment', 'category' );
			if ( ! $ent ) {
				$created = wp_insert_term( 'Entertainment', 'category', array( 'slug' => 'entertainment' ) );
				$ent_id  = is_wp_error( $created ) ? 0 : (int) $created['term_id'];
			} else {
				$ent_id = (int) $ent->term_id;
			}
			$parent = $ent_id;
		}
		if ( 'celebrity-style' === $slug ) {
			$fashion = get_term_by( 'slug', 'fashion', 'category' );
			if ( ! $fashion ) {
				$created = wp_insert_term( 'Fashion', 'category', array( 'slug' => 'fashion' ) );
				$parent  = is_wp_error( $created ) ? 0 : (int) $created['term_id'];
			} else {
				$parent = (int) $fashion->term_id;
			}
		}
		wp_insert_term( $name, 'category', array( 'slug' => $slug, 'parent' => $parent ) );
	}
}

function starvista_demo_create_authors() {
	$map = array();
	foreach ( starvista_demo_authors() as $login => $data ) {
		if ( username_exists( $login ) ) {
			$map[ $login ] = username_exists( $login );
			continue;
		}
		$id = wp_insert_user(
			array(
				'user_login'   => $login,
				'user_pass'    => wp_generate_password( 16, true ),
				'user_email'   => $data[1],
				'display_name' => $data[0],
				'role'         => 'author',
				'description'  => $data[2],
			)
		);
		if ( ! is_wp_error( $id ) ) {
			$map[ $login ] = $id;
		}
	}
	return $map;
}

function starvista_demo_create_posts( $authors ) {
	foreach ( starvista_demo_posts() as $item ) {
		if ( get_page_by_path( $item['slug'], OBJECT, 'post' ) ) {
			continue;
		}
		$author_id = isset( $authors[ $item['author'] ] ) ? $authors[ $item['author'] ] : 1;
		$post_id   = wp_insert_post(
			array(
				'post_title'   => $item['title'],
				'post_name'    => $item['slug'],
				'post_content' => $item['content'],
				'post_excerpt' => $item['excerpt'],
				'post_status'  => 'publish',
				'post_type'    => 'post',
				'post_author'  => $author_id,
				'post_date'    => gmdate( 'Y-m-d H:i:s', time() - wp_rand( 3600, 20 * DAY_IN_SECONDS ) ),
			),
			true
		);
		if ( is_wp_error( $post_id ) ) {
			continue;
		}
		$cat_ids = array();
		foreach ( $item['cats'] as $slug ) {
			$term = get_term_by( 'slug', $slug, 'category' );
			if ( $term ) {
				$cat_ids[] = (int) $term->term_id;
			}
		}
		if ( $cat_ids ) {
			wp_set_post_categories( $post_id, $cat_ids );
		}
		if ( ! empty( $item['rating'] ) ) {
			update_post_meta( $post_id, '_starvista_rating', $item['rating'] );
		}
		if ( ! empty( $item['video'] ) ) {
			update_post_meta( $post_id, '_starvista_is_video', 1 );
		}
		starvista_demo_attach_image( $post_id, $item['slug'], $item['title'] );
	}

	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello ) {
		wp_delete_post( $hello->ID, true );
	}
}

function starvista_demo_create_pages() {
	$pages = array(
		'about-us'       => array(
			'About Us',
			'<p>StarVista is a sample entertainment, fashion, and lifestyle newsroom built as a WordPress internship assignment. The homepage structure is inspired by modern entertainment portals, with original placeholder journalism and royalty-free generated imagery.</p><p>This project is not affiliated with Pinkvilla or any other commercial publisher.</p>',
		),
		'privacy-policy' => array(
			'Privacy Policy',
			'<p>This demonstration site stores only the standard WordPress account and content data created during local setup. It does not run advertising trackers. If you deploy the project, replace this page with a policy that matches your host and analytics tools.</p>',
		),
		'contact'        => array(
			'Contact',
			'<p>For assignment questions, use the WordPress admin dashboard included with this project.</p><p>Email: newsroom@starvista.example</p><p>This contact page exists so footer links resolve to a real WordPress page.</p>',
		),
	);

	foreach ( $pages as $slug => $data ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $data[0],
				'post_name'    => $slug,
				'post_content' => $data[1],
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);
	}
}

function starvista_demo_create_menus() {
	$primary_id = starvista_demo_menu( 'Primary', 'primary' );
	$legal_id   = starvista_demo_menu( 'Legal', 'legal' );

	$primary_items = array( 'Latest', 'Videos', 'Entertainment', 'Lifestyle', 'Korean', 'Fashion', 'Health', 'Beauty' );
	foreach ( $primary_items as $name ) {
		$term = get_term_by( 'name', $name, 'category' );
		if ( ! $term ) {
			continue;
		}
		wp_update_nav_menu_item(
			$primary_id,
			0,
			array(
				'menu-item-title'     => $name,
				'menu-item-object'    => 'category',
				'menu-item-object-id' => $term->term_id,
				'menu-item-type'      => 'taxonomy',
				'menu-item-status'    => 'publish',
			)
		);
	}

	foreach ( array( 'About Us' => 'about-us', 'Privacy Policy' => 'privacy-policy', 'Contact' => 'contact' ) as $title => $slug ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			continue;
		}
		wp_update_nav_menu_item(
			$legal_id,
			0,
			array(
				'menu-item-title'     => $title,
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}
}

function starvista_demo_menu( $name, $location ) {
	$menu = wp_get_nav_menu_object( $name );
	if ( $menu ) {
		$id = (int) $menu->term_id;
	} else {
		$id = (int) wp_create_nav_menu( $name );
	}
	$locations              = get_theme_mod( 'nav_menu_locations', array() );
	$locations[ $location ] = $id;
	set_theme_mod( 'nav_menu_locations', $locations );
	return $id;
}

function starvista_demo_configure_site() {
	update_option( 'blogname', 'StarVista' );
	update_option( 'blogdescription', 'Entertainment. Fashion. Lifestyle.' );
	update_option( 'show_on_front', 'posts' );
	update_option( 'posts_per_page', 12 );
	update_option( 'permalink_structure', '/%postname%/' );
	update_option( 'timezone_string', 'Asia/Kolkata' );
}
