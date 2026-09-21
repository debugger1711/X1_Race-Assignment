<?php
/**
 * Header template.
 *
 * @package StarVista
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="sv-skip" href="#content"><?php esc_html_e( 'Skip to content', 'starvista' ); ?></a>
<header class="sv-header" id="masthead">
	<div class="sv-header-inner">
		<?php echo starvista_get_logo_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<nav class="sv-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary', 'starvista' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'sv-menu',
					'container'      => false,
					'fallback_cb'    => 'starvista_fallback_menu',
				)
			);
			?>
		</nav>
		<button class="sv-menu-toggle" type="button" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'starvista' ); ?>">
			<span class="sv-burger" aria-hidden="true"><span></span><span></span><span></span></span>
		</button>
	</div>
	<div class="sv-mobile-panel" id="sv-mobile-panel" hidden>
		<nav aria-label="<?php esc_attr_e( 'Mobile', 'starvista' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'sv-mobile-menu',
					'container'      => false,
					'fallback_cb'    => 'starvista_fallback_menu',
				)
			);
			?>
		</nav>
	</div>
</header>
<div class="sv-header-spacer" aria-hidden="true"></div>
<main id="content" class="sv-main">
