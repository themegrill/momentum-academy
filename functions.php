<?php

/**
 * Momentum Academy Theme
 *
 * @package MomentumAcademy
 */

use MomentumAcademy\Assets_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

! defined( 'momentum_academy_THEME_FILE' ) && define( 'momentum_academy_THEME_FILE', __FILE__ );

if ( file_exists( get_theme_file_path( 'vendor/autoload.php' ) ) ) {
	require_once get_theme_file_path( 'vendor/autoload.php' );
}

require_once get_theme_file_path( 'inc/constants.php' );
require_once get_theme_file_path( 'inc/admin.php' );

require_once get_theme_file_path( 'inc/theme-setup.php' );
require_once get_theme_file_path( 'inc/register_block_patterns.php' );
require_once get_theme_file_path( 'inc/assets-manager.php' );

/**
 * Theme setup
 */
if ( ! function_exists( 'momentum_academy_setup' ) ) {
	function momentum_academy_setup() {
		add_theme_support( 'editor-styles' );
	}
}

add_action( 'after_setup_theme', 'momentum_academy_setup' );

/**
 * Enqueue theme stylesheet
 */
function momentum_academy_enqueue_styles() {
	wp_enqueue_style(
		'momentum-academy-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}

add_action( 'wp_enqueue_scripts', 'momentum_academy_enqueue_styles' );

/**
 * Provide default logo when none is set
 */
function momentum_academy_get_custom_logo( $html ) {
	if ( ! empty( $html ) ) {
		return $html;
	}

	$default_logo_filename = 'fse-theme-logo.png';
	$default_logo_url      = Assets_Manager::get_image_url( $default_logo_filename );

	if ( file_exists( get_template_directory() . '/assets/images/' . $default_logo_filename ) ) {
		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link" rel="home" aria-label="%3$s">
				<img src="%2$s" class="custom-logo" alt="%3$s" width="200" height="80" />
			</a>',
			esc_url( home_url( '/' ) ),
			esc_url( $default_logo_url ),
			esc_attr( get_bloginfo( 'name' ) )
		);
	} else {
		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link site-title-fallback" rel="home">%2$s</a>',
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	}

	return $html;
}

add_filter( 'get_custom_logo', 'momentum_academy_get_custom_logo' );


/**
 * Provide a default fallback tagline if the site tagline is empty.
 */
function momentum_academy_default_tagline( $blogdescription ) {
	if ( empty( trim( $blogdescription ) ) ) {
		return 'Join thousands of learners & explore courses from top instructors. Effortlessly to launch, manage, & grow.';
	}
	return $blogdescription;
}
add_filter( 'option_blogdescription', 'momentum_academy_default_tagline' );
