<?php
/**
 * Custom Block Category.
 *
 * @package MyTheme\Blocks
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'block_categories_all',
	static function ( array $categories ): array {
		return array_merge(
			array(
				array(
					'slug'  => 'mytheme',
					'title' => __( 'My Theme', 'mytheme' ),
				),
			),
			$categories
		);
	},
	10
);
