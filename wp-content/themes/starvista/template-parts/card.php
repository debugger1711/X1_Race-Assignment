<?php
/**
 * Reusable article card.
 *
 * @package StarVista
 *
 * @var string $variant featured|standard|video|review|mini|overlay
 */

$variant = isset( $args['variant'] ) ? $args['variant'] : 'standard';
$post_id = get_the_ID();
$thumb   = get_the_post_thumbnail_url( $post_id, 'featured' === $variant ? 'starvista-featured' : 'starvista-card' );
if ( ! $thumb ) {
	$thumb = STARVISTA_URI . '/assets/images/placeholder.svg';
}
$class = 'sv-card sv-card-' . $variant;
if ( 'featured' === $variant ) {
	$class .= ' sv-feature-card';
}
?>
<article <?php post_class( $class ); ?>>
	<a class="sv-card-link" href="<?php the_permalink(); ?>">
		<div class="sv-card-media">
			<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="640" height="400">
			<?php if ( 'video' === $variant || starvista_is_video() ) : ?>
				<span class="sv-play" aria-hidden="true"></span>
			<?php endif; ?>
		</div>
		<div class="sv-card-body">
			<?php starvista_category_label( $post_id, false ); ?>
			<h3><?php the_title(); ?></h3>
			<?php if ( in_array( $variant, array( 'featured', 'video', 'review', 'standard' ), true ) ) : ?>
				<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 'featured' === $variant ? 28 : 16 ) ); ?></p>
			<?php endif; ?>
			<?php if ( 'review' === $variant ) : ?>
				<?php starvista_rating( $post_id ); ?>
			<?php endif; ?>
			<div class="sv-card-meta">
				<?php starvista_author_line( $post_id, false ); ?>
			</div>
		</div>
	</a>
</article>
