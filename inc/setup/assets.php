<?php
/**
 * Enqueue Theme Assets.
 *
 * @package MyTheme\Setup
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'wp_enqueue_scripts',
	static function (): void {
		// Register the styles here.
		wp_enqueue_style(
			'main-style',
			THEME_URI . '/assets/css/style.css',
			array(),
			VERSION
		);

		wp_enqueue_style(
			'aos-css',
			THEME_URI . '/assets/css/aos.css',
			array( 'main-style' ),
			VERSION
		);

		wp_enqueue_style(
			'media-css',
			THEME_URI . '/assets/css/media.css',
			array( 'main-style' ),
			VERSION
		);

		// Register the scripts here.
		wp_enqueue_script(
			'jquery-min',
			THEME_URI . '/assets/js/jquery.min.js',
			array(),
			VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);

		wp_enqueue_script(
			'setting-js',
			THEME_URI . '/assets/js/setting.js',
			array( 'jquery-min', 'embla-carousel', 'aos-js' ),
			VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	},
	20
);
