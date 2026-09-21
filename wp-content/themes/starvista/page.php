<?php
/**
 * Static pages.
 *
 * @package StarVista
 */

get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
	<article class="sv-page">
		<h1><?php the_title(); ?></h1>
		<div class="sv-content">
			<?php the_content(); ?>
		</div>
	</article>
<?php endwhile; ?>
<?php
get_footer();
