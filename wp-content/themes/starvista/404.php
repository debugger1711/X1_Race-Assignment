<?php
/**
 * 404 template.
 *
 * @package StarVista
 */

get_header();
?>
<section class="sv-empty">
	<h1><?php esc_html_e( 'Page not found', 'starvista' ); ?></h1>
	<p><?php esc_html_e( 'That story has moved or never existed.', 'starvista' ); ?></p>
	<p><a class="sv-explore" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to homepage', 'starvista' ); ?></a></p>
</section>
<?php
get_footer();
