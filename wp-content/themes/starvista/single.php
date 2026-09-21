<?php
/**
 * Single post template.
 *
 * @package StarVista
 */

get_header();

while ( have_posts() ) :
	the_post();
	$thumb = get_the_post_thumbnail_url( get_the_ID(), 'starvista-hero' );
	?>
	<article <?php post_class( 'sv-single' ); ?>>
		<div class="sv-article">
			<?php starvista_category_label(); ?>
			<h1><?php the_title(); ?></h1>
			<div class="sv-card-meta">
				<?php starvista_author_line(); ?>
				<span class="sv-dot"></span>
				<?php starvista_meta_line(); ?>
				<?php starvista_rating(); ?>
			</div>
		</div>
		<?php if ( $thumb ) : ?>
			<div class="sv-article-hero">
				<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
			</div>
		<?php endif; ?>
		<div class="sv-article sv-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			<p><a class="sv-explore" href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; <?php esc_html_e( 'Back to homepage', 'starvista' ); ?></a></p>
		</div>
	</article>
	<?php
endwhile;

$related = starvista_query_posts(
	array(
		'posts_per_page' => 3,
		'post__not_in'   => array( get_the_ID() ),
		'category__in'   => wp_get_post_categories( get_queried_object_id() ),
	)
);
if ( $related->have_posts() ) :
	?>
	<section class="sv-related sv-section">
		<div class="sv-section-head">
			<h2 class="sv-section-title"><?php esc_html_e( 'Related Stories', 'starvista' ); ?></h2>
		</div>
		<div class="sv-grid-3">
			<?php
			while ( $related->have_posts() ) :
				$related->the_post();
				get_template_part( 'template-parts/card', null, array( 'variant' => 'standard' ) );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</section>
	<?php
endif;

get_footer();
