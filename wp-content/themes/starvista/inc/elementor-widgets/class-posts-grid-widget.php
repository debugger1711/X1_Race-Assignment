<?php
/**
 * Elementor Free widget: dynamic posts grid.
 *
 * @package StarVista
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class StarVista_Posts_Grid_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'starvista-posts-grid';
	}

	public function get_title() {
		return __( 'StarVista Posts Grid', 'starvista' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return array( 'starvista' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content_section', array( 'label' => __( 'Content', 'starvista' ) ) );
		$this->add_control(
			'title',
			array(
				'label'   => __( 'Section title', 'starvista' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Latest Stories', 'starvista' ),
			)
		);
		$this->add_control(
			'category',
			array(
				'label'   => __( 'Category slug', 'starvista' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'entertainment',
			)
		);
		$this->add_control(
			'count',
			array(
				'label'   => __( 'Number of posts', 'starvista' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			)
		);
		$this->add_control(
			'variant',
			array(
				'label'   => __( 'Card style', 'starvista' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => array(
					'standard' => 'Standard',
					'video'    => 'Video',
					'review'   => 'Review',
					'mini'     => 'Mini',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$query    = starvista_query_posts(
			array(
				'posts_per_page' => (int) $settings['count'],
				'category_name'  => sanitize_title( $settings['category'] ),
			)
		);
		if ( ! $query->have_posts() ) {
			echo '<p>' . esc_html__( 'No posts found for this category.', 'starvista' ) . '</p>';
			return;
		}
		echo '<section class="sv-section"><div class="sv-container">';
		if ( ! empty( $settings['title'] ) ) {
			starvista_section_heading( $settings['title'] );
		}
		$grid = 'review' === $settings['variant'] ? 'sv-reviews' : 'sv-grid-3';
		echo '<div class="' . esc_attr( $grid ) . '">';
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/card', null, array( 'variant' => $settings['variant'] ) );
		}
		echo '</div></div></section>';
		wp_reset_postdata();
	}
}
