<?php
/**
 * Footer template.
 *
 * @package StarVista
 */
?>
</main>
<footer class="sv-footer">
	<div class="sv-container sv-footer-grid">
		<div class="sv-footer-brand">
			<a class="sv-logo sv-logo-footer" href="<?php echo esc_url( home_url( '/' ) ); ?>">STARVISTA</a>
			<p><?php esc_html_e( 'A sample entertainment, fashion, and lifestyle newsroom built for a WordPress internship assignment. Original placeholder stories only — not affiliated with Pinkvilla.', 'starvista' ); ?></p>
			<?php starvista_social_links(); ?>
		</div>
		<div>
			<h2 class="sv-footer-title"><?php esc_html_e( 'Explore', 'starvista' ); ?></h2>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'sv-footer-links',
					'container'      => false,
					'fallback_cb'    => 'starvista_fallback_menu',
					'depth'          => 1,
				)
			);
			?>
		</div>
		<div>
			<h2 class="sv-footer-title"><?php esc_html_e( 'Company', 'starvista' ); ?></h2>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'legal',
					'menu_class'     => 'sv-footer-links',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 1,
				)
			);
			?>
			<?php if ( ! has_nav_menu( 'legal' ) ) : ?>
				<ul class="sv-footer-links">
					<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'starvista' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'starvista' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'starvista' ); ?></a></li>
				</ul>
			<?php endif; ?>
		</div>
		<div>
			<h2 class="sv-footer-title"><?php esc_html_e( 'Newsroom', 'starvista' ); ?></h2>
			<ul class="sv-footer-links">
				<li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Entertainment' ) ) ); ?>"><?php esc_html_e( 'Entertainment', 'starvista' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Fashion' ) ) ); ?>"><?php esc_html_e( 'Fashion', 'starvista' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Movie Reviews' ) ) ); ?>"><?php esc_html_e( 'Movie Reviews', 'starvista' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Health' ) ) ); ?>"><?php esc_html_e( 'Health & Beauty', 'starvista' ); ?></a></li>
			</ul>
		</div>
	</div>
	<div class="sv-footer-bottom">
		<div class="sv-container">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> StarVista Media. <?php esc_html_e( 'All rights reserved. Sample project for evaluation.', 'starvista' ); ?></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
