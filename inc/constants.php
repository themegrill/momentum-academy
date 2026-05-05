<?php
/**
 * Constants class. 
 *
 * @package MomentumAcademy
 * @since 1.0.1
 */

namespace MomentumAcademy;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Constants class.
 */
class Constants {

	/**
	 * Product key for the theme.
	 *
	 * @var string
	 */
	const PRODUCT_KEY = 'momentum_academy';

	/**
	 * Product slug for the theme.
	 *
	 * @var string
	 */
	const PRODUCT_SLUG = 'momentum-academy';

	/**
	 * Cache keys used throughout the theme.
	 *
	 * @var array
	 */
	const CACHE_KEYS = array(
		'dismissed-welcome-notice' => 'momentum_academy_dismissed_welcome_notice',
	);

	/**
	 * Text domain for the theme.
	 *
	 * @var string
	 */
	const TEXT_DOMAIN = 'momentum-academy';
}
