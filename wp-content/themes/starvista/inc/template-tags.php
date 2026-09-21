<?php
/**
 * Template helper functions.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_get_primary_category( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$cats    = get_the_category( $post_id );
	if ( empty( $cats ) ) {
		return null;
	}

	$preferred = array( 'Celebrity Style', 'Videos', 'Movie Reviews', 'Fashion', 'Health', 'Beauty', 'Bollywood', 'Hollywood', 'TV', 'South', 'Korean', 'Lifestyle', 'Latest' );
	$names     = wp_list_pluck( $cats, 'name' );

	foreach ( $preferred as $name ) {
		$key = array_search( $name, $names, true );
		if ( false !== $key ) {
			return $cats[ $key ];
		}
	}

	return $cats[0];
}

function starvista_category_label( $post_id = 0, $link = true ) {
	$cat = starvista_get_primary_category( $post_id );
	if ( ! $cat ) {
		return;
	}

	if ( $link ) {
		printf(
			'<a class="sv-cat" href="%s">%s</a>',
			esc_url( get_category_link( $cat ) ),
			esc_html( $cat->name )
		);
		return;
	}

	printf( '<span class="sv-cat">%s</span>', esc_html( $cat->name ) );
}

function starvista_author_line( $post_id = 0, $link = true ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$name    = get_the_author_meta( 'display_name', (int) get_post_field( 'post_author', $post_id ) );
	if ( $link ) {
		printf(
			'<span class="sv-author">%s <a href="%s">%s</a></span>',
			esc_html__( 'BY', 'starvista' ),
			esc_url( get_author_posts_url( (int) get_post_field( 'post_author', $post_id ) ) ),
			esc_html( $name )
		);
		return;
	}
	printf(
		'<span class="sv-author">%s %s</span>',
		esc_html__( 'BY', 'starvista' ),
		esc_html( $name )
	);
}

function starvista_meta_line( $post_id = 0 ) {
	$post_id   = $post_id ? $post_id : get_the_ID();
	$read_time = get_post_meta( $post_id, '_starvista_read_time', true );
	if ( ! $read_time ) {
		$word_count = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
		$read_time  = max( 2, (int) ceil( $word_count / 200 ) );
	}
	printf(
		'<span class="sv-date">%s</span><span class="sv-dot"></span><span class="sv-read">%s</span>',
		esc_html( get_the_date( 'M j, Y', $post_id ) ),
		esc_html( sprintf( __( '%s min read', 'starvista' ), $read_time ) )
	);
}

function starvista_rating( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$rating  = get_post_meta( $post_id, '_starvista_rating', true );
	if ( '' === $rating || false === $rating ) {
		return;
	}
	$rating = number_format( (float) $rating, 1 );
	printf(
		'<span class="sv-rating" aria-label="%s"><span class="sv-rating-star">★</span> %s</span>',
		esc_attr( sprintf( __( 'Rated %s out of 5', 'starvista' ), $rating ) ),
		esc_html( $rating )
	);
}

function starvista_is_video( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( get_post_meta( $post_id, '_starvista_is_video', true ) ) {
		return true;
	}
	return has_category( 'videos', $post_id );
}

function starvista_query_posts( $args = array() ) {
	$defaults = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);
	return new WP_Query( wp_parse_args( $args, $defaults ) );
}

function starvista_section_heading( $title, $archive = '' ) {
	echo '<div class="sv-section-head">';
	echo '<h2 class="sv-section-title">' . esc_html( $title ) . '</h2>';
	if ( $archive ) {
		printf(
			'<a class="sv-explore" href="%s">%s</a>',
			esc_url( $archive ),
			esc_html__( 'Explore More', 'starvista' )
		);
	}
	echo '</div>';
}

function starvista_get_logo_html() {
	if ( has_custom_logo() ) {
		return get_custom_logo();
	}

	$html  = '<a class="sv-logo" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
	$html .= '<span class="sv-logo-mark">STARVISTA</span>';
	$html .= '</a>';
	return $html;
}

function starvista_fallback_menu() {
	$items = array(
		'Latest'        => home_url( '/category/latest/' ),
		'Videos'        => home_url( '/category/videos/' ),
		'Entertainment' => home_url( '/category/entertainment/' ),
		'Lifestyle'     => home_url( '/category/lifestyle/' ),
		'Korean'        => home_url( '/category/korean/' ),
		'Fashion'       => home_url( '/category/fashion/' ),
		'Health'        => home_url( '/category/health/' ),
		'Beauty'        => home_url( '/category/beauty/' ),
	);

	echo '<ul class="sv-menu">';
	foreach ( $items as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

function starvista_social_links() {
	$links = array(
		'instagram' => array( 'Instagram', 'https://www.instagram.com/' ),
		'youtube'   => array( 'YouTube', 'https://www.youtube.com/' ),
		'facebook'  => array( 'Facebook', 'https://www.facebook.com/' ),
		'twitter'   => array( 'X', 'https://x.com/' ),
	);

	echo '<ul class="sv-social">';
	foreach ( $links as $key => $item ) {
		printf(
			'<li><a class="sv-social-%s" href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s">%s</a></li>',
			esc_attr( $key ),
			esc_url( $item[1] ),
			esc_attr( $item[0] ),
			starvista_social_icon( $key )
		);
	}
	echo '</ul>';
}

function starvista_social_icon( $key ) {
	$icons = array(
		'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4zm5 4.8A4.2 4.2 0 1 0 16.2 12 4.2 4.2 0 0 0 12 7.8zm6.35-.95a1.05 1.05 0 1 0 1.05 1.05 1.05 1.05 0 0 0-1.05-1.05zM12 9.3A2.7 2.7 0 1 1 9.3 12 2.7 2.7 0 0 1 12 9.3z"/></svg>',
		'youtube'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M23 12.2s0-3.2-.4-4.6a3 3 0 0 0-2.1-2.1C18.9 5.1 12 5.1 12 5.1s-6.9 0-8.5.4a3 3 0 0 0-2.1 2.1C1 9 1 12.2 1 12.2s0 3.2.4 4.6a3 3 0 0 0 2.1 2.1c1.6.4 8.5.4 8.5.4s6.9 0 8.5-.4a3 3 0 0 0 2.1-2.1c.4-1.4.4-4.6.4-4.6zM9.8 15.5V8.9l6.4 3.3z"/></svg>',
		'facebook'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.5 8.5V6.8c0-.7.5-1 1.2-1h1.8V3h-2.5C11.8 3 11 5 11 6.6v1.9H9v2.8h2V21h3.5v-9.7h2.4l.4-2.8z"/></svg>',
		'twitter'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="m14.7 10.5 6.6-7.5h-1.6l-5.7 6.5-4.6-6.5H4.2l6.9 9.8L3.7 21h1.6l6-6.9 4.8 6.9h5.2zm-2.1 2.5-.7-1-5.6-8h2.4l4.5 6.4.7 1 5.9 8.4h-2.4z"/></svg>',
	);
	return isset( $icons[ $key ] ) ? $icons[ $key ] : '';
}
