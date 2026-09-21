<?php
/**
 * Search results.
 *
 * @package StarVista
 */

get_header();
?>
<section class="sv-section">
	<div class="sv-container">
		<div class="sv-section-head">
			<h1 class="sv-section-title"><?php printf( esc_html__( 'Search: %s', 'starvista' ), esc_html( get_search_query() ) ); ?></h1>
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
		<?php else : ?>
			<p class="sv-empty"><?php esc_html_e( 'No matching stories.', 'starvista' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
