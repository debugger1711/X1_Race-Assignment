<?php
/**
 * Elementor Free widget: homepage hero.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class StarVista_Hero_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'starvista-hero';
	}

	public function get_title() {
		return __( 'StarVista Hero', 'starvista' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}

	public function get_categories() {
		return array( 'starvista' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content_section', array( 'label' => __( 'Content', 'starvista' ) ) );
		$this->add_control(
			'note',
			array(
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw'  => __( 'Displays the latest featured story plus a numbered Latest rail, matching the StarVista homepage hero.', 'starvista' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		echo '<p class="sv-container">' . esc_html__( 'Use the StarVista homepage template for the full hero, or keep this widget as a visual placeholder in Elementor. Dynamic hero markup lives in front-page.php so it stays compatible with Elementor Free.', 'starvista' ) . '</p>';
	}
}
