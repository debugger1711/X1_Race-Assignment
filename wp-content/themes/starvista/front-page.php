<?php
/**
 * Homepage template with dynamic WordPress queries.
 *
 * @package StarVista
 */

get_header();

$hero = starvista_query_posts(
	array(
		'posts_per_page' => 1,
		'category_name'  => 'latest',
	)
);
if ( ! $hero->have_posts() ) {
	$hero = starvista_query_posts( array( 'posts_per_page' => 1 ) );
}

$latest = starvista_query_posts(
	array(
		'posts_per_page' => 5,
		'offset'         => 1,
		'category_name'  => 'latest',
	)
);
if ( $latest->post_count < 5 ) {
	$latest = starvista_query_posts(
		array(
			'posts_per_page' => 5,
			'post__not_in'   => $hero->posts ? array( $hero->posts[0]->ID ) : array(),
		)
	);
}
?>
<section class="sv-hero">
	<div class="sv-hero-grid">
		<?php if ( $hero->have_posts() ) : ?>
			<?php
			$hero->the_post();
			$hero_img = get_the_post_thumbnail_url( get_the_ID(), 'starvista-hero' );
			if ( ! $hero_img ) {
				$hero_img = STARVISTA_URI . '/assets/images/placeholder.svg';
			}
			?>
			<a class="sv-hero-feature" href="<?php the_permalink(); ?>">
				<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
				<div class="sv-hero-overlay">
					<span class="sv-badge"><?php esc_html_e( 'Top Stories', 'starvista' ); ?></span>
					<h1><?php the_title(); ?></h1>
					<?php starvista_author_line( get_the_ID(), false ); ?>
				</div>
			</a>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<aside class="sv-latest">
			<h2><?php esc_html_e( 'Latest', 'starvista' ); ?></h2>
			<?php
			$i = 1;
			if ( $latest->have_posts() ) :
				while ( $latest->have_posts() ) :
					$latest->the_post();
					$thumb = get_the_post_thumbnail_url( get_the_ID(), 'starvista-thumb' );
					if ( ! $thumb ) {
						$thumb = STARVISTA_URI . '/assets/images/placeholder.svg';
					}
					?>
					<a class="sv-latest-item" href="<?php the_permalink(); ?>">
						<span class="sv-latest-num"><?php echo esc_html( (string) $i ); ?></span>
						<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="72" height="72">
						<div>
							<h3><?php the_title(); ?></h3>
							<?php starvista_author_line( get_the_ID(), false ); ?>
						</div>
					</a>
					<?php
					$i++;
				endwhile;
				wp_reset_postdata();
			endif;
			?>
			<a class="sv-explore-more" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/category/latest/' ) ); ?>"><?php esc_html_e( 'Explore More', 'starvista' ); ?></a>
		</aside>
	</div>
</section>

<?php
if ( ! function_exists( 'starvista_render_grid_section' ) ) {
function starvista_render_grid_section( $title, $category, $count, $variant, $grid_class ) {
	$query = starvista_query_posts(
		array(
			'posts_per_page' => $count,
			'category_name'  => $category,
		)
	);
	if ( ! $query->have_posts() ) {
		return;
	}
	$term = get_category_by_slug( $category );
	$link = $term ? get_category_link( $term ) : '';
	echo '<section class="sv-section">';
	echo '<div class="sv-container">';
	starvista_section_heading( $title, $link );
	echo '<div class="' . esc_attr( $grid_class ) . '">';
	while ( $query->have_posts() ) {
		$query->the_post();
		get_template_part( 'template-parts/card', null, array( 'variant' => $variant ) );
	}
	echo '</div></div></section>';
	wp_reset_postdata();
}

function starvista_render_split_section( $title, $category ) {
	$query = starvista_query_posts(
		array(
			'posts_per_page' => 5,
			'category_name'  => $category,
		)
	);
	if ( ! $query->have_posts() ) {
		return;
	}
	$term = get_category_by_slug( $category );
	$link = $term ? get_category_link( $term ) : '';
	echo '<section class="sv-section">';
	echo '<div class="sv-container">';
	starvista_section_heading( $title, $link );
	echo '<div class="sv-split">';
	$first = true;
	echo '<div>';
	while ( $query->have_posts() ) {
		$query->the_post();
		if ( $first ) {
			get_template_part( 'template-parts/card', null, array( 'variant' => 'featured' ) );
			echo '</div><div class="sv-mini-grid">';
			$first = false;
			continue;
		}
		get_template_part( 'template-parts/card', null, array( 'variant' => 'mini' ) );
	}
	echo '</div></div></div></section>';
	wp_reset_postdata();
}

function starvista_render_list_block( $title, $category ) {
	$query = starvista_query_posts(
		array(
			'posts_per_page' => 4,
			'category_name'  => $category,
		)
	);
	if ( ! $query->have_posts() ) {
		return;
	}
	echo '<div class="sv-ent-block">';
	echo '<h3 class="sv-subhead">' . esc_html( $title ) . '</h3>';
	$first = true;
	while ( $query->have_posts() ) {
		$query->the_post();
		$thumb = get_the_post_thumbnail_url( get_the_ID(), $first ? 'starvista-featured' : 'starvista-card' );
		if ( ! $thumb ) {
			$thumb = STARVISTA_URI . '/assets/images/placeholder.svg';
		}
		if ( $first ) {
			echo '<a class="sv-card" href="' . esc_url( get_permalink() ) . '">';
			echo '<div class="sv-card-media"><img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title() ) . '" loading="lazy"></div>';
			starvista_category_label( get_the_ID(), false );
			echo '<h3>' . esc_html( get_the_title() ) . '</h3>';
			starvista_author_line( get_the_ID(), false );
			echo '</a>';
			$first = false;
			continue;
		}
		echo '<a class="sv-list-card" href="' . esc_url( get_permalink() ) . '">';
		echo '<div><h3>' . esc_html( get_the_title() ) . '</h3>';
		starvista_author_line( get_the_ID(), false );
		echo '</div><img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title() ) . '" loading="lazy">';
		echo '</a>';
	}
	echo '</div>';
	wp_reset_postdata();
}
}

starvista_render_split_section( __( 'Celebrity Style', 'starvista' ), 'celebrity-style' );
starvista_render_grid_section( __( 'Exclusive Videos', 'starvista' ), 'videos', 6, 'video', 'sv-grid-3' );
starvista_render_grid_section( __( 'Movie Reviews', 'starvista' ), 'movie-reviews', 3, 'review', 'sv-reviews' );
?>

<section class="sv-section">
	<div class="sv-container">
		<?php starvista_section_heading( __( 'Entertainment', 'starvista' ), get_category_link( get_cat_ID( 'Entertainment' ) ) ); ?>
		<div class="sv-two-col">
			<?php starvista_render_list_block( __( 'Bollywood', 'starvista' ), 'bollywood' ); ?>
			<?php starvista_render_list_block( __( 'Hollywood', 'starvista' ), 'hollywood' ); ?>
		</div>
		<div class="sv-two-col">
			<?php starvista_render_list_block( __( 'TV', 'starvista' ), 'tv' ); ?>
			<?php starvista_render_list_block( __( 'South', 'starvista' ), 'south' ); ?>
		</div>
	</div>
</section>

<?php
starvista_render_split_section( __( 'Fashion', 'starvista' ), 'fashion' );
?>

<section class="sv-section">
	<div class="sv-container">
		<?php starvista_section_heading( __( 'Health & Beauty', 'starvista' ), get_category_link( get_cat_ID( 'Health' ) ) ); ?>
		<div class="sv-two-col">
			<div>
				<h3 class="sv-subhead"><?php esc_html_e( 'Health', 'starvista' ); ?></h3>
				<div class="sv-mini-grid">
					<?php
					$health = starvista_query_posts( array( 'posts_per_page' => 4, 'category_name' => 'health' ) );
					while ( $health->have_posts() ) {
						$health->the_post();
						get_template_part( 'template-parts/card', null, array( 'variant' => 'mini' ) );
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
			<div>
				<h3 class="sv-subhead"><?php esc_html_e( 'Beauty', 'starvista' ); ?></h3>
				<div class="sv-mini-grid">
					<?php
					$beauty = starvista_query_posts( array( 'posts_per_page' => 4, 'category_name' => 'beauty' ) );
					while ( $beauty->have_posts() ) {
						$beauty->the_post();
						get_template_part( 'template-parts/card', null, array( 'variant' => 'mini' ) );
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
starvista_render_grid_section( __( 'Korean Wave', 'starvista' ), 'korean', 4, 'standard', 'sv-grid-4' );
starvista_render_grid_section( __( 'Lifestyle', 'starvista' ), 'lifestyle', 4, 'standard', 'sv-grid-4' );

get_footer();
