<?php
/**
 * Default index / blog fallback.
 *
 * @package StarVista
 */

get_header();
?>
<section class="sv-section">
	<div class="sv-container">
		<div class="sv-section-head">
			<h1 class="sv-section-title"><?php echo is_home() ? esc_html__( 'Latest Stories', 'starvista' ) : wp_kses_post( get_the_archive_title() ); ?></h1>
		</div>
		<?php if ( have_posts() ) : ?>
			<div class="sv-archive-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/card', null, array( 'variant' => 'standard' ) );
				endwhile;
				?>
			</div>
			<div class="sv-empty"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p class="sv-empty"><?php esc_html_e( 'No stories found.', 'starvista' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
