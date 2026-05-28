<?php
/**
 * Image loading performance tweaks for better SEO.
 *
 * - First content image on single posts/pages loads eagerly (LCP).
 * - All raw <img> tags in content get decoding=async.
 *
 * @package JuraLaw\Performance
 */

defined( 'ABSPATH' ) || exit;

/**
 * First Image eager better for LCP score and rest in lazyload.
 */
add_filter(
	'wp_get_attachment_image_attributes',
	static function ( array $attr, $attachment, $size ): array { //phpcs:ignore

		static $first_done = false;

		if ( $first_done || is_admin() || ! is_singular() ) {
			return $attr;
		}

		if ( in_the_loop() && is_main_query() ) {
			$attr['loading']       = 'eager';
			$attr['fetchpriority'] = 'high';
			$attr['decoding']      = 'async';
			$first_done            = true;
		}

		return $attr;
	},
	10,
	3
);

/**
 * Adds the decoding=async if not there.
 */
add_filter(
	'the_content',
	static function ( string $content ): string {

		if ( '' === $content || false === strpos( $content, '<img' ) ) {
			return $content;
		}

		return preg_replace_callback(
			'/<img\b([^>]*)>/i',
			static function ( array $m ): string {
				$attrs = $m[1];

				if ( false === stripos( $attrs, 'decoding=' ) ) {
					$attrs .= ' decoding="async"';
				}

				return '<img' . $attrs . '>';
			},
			$content
		);
	},
	20
);
