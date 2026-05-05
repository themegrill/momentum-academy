<?php
/**
 * Block patterns
 *
 * @package momentum-academy
 * @since 1.0.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register block patterns.
 *
 * @since 1.0.1
 * @package momentum-academy
 */
function momentum_academy_register_block_patterns() {

	/**
	 * Block pattern categories.
	 *
	 * @since 1.0.1
	 * @package momentum-academy
	 */
	$block_pattern_categories = apply_filters(
		'momentum_academy_block_pattern_categories',
		array(
			'faq' => array(
				'label' => __( 'FAQ', 'momentum-academy' ),
			),
		)
	);

	// Register pattern categories.
	if ( ! empty( $block_pattern_categories ) ) {
		foreach ( $block_pattern_categories as $category_name => $category_properties ) {
			register_block_pattern_category(
				$category_name,
				$category_properties
			);
		}
	}

}

add_action( 'init', 'momentum_academy_register_block_patterns' );
