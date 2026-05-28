<?php
/**
 * General Theme Support Setup.
 *
 * @package MyTheme\Setup
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function (): void {
		load_theme_textdomain( MYTHEME_TEXTDOMAIN, THEME_DIR . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		add_theme_support(
			'post-formats',
			array( 'link', 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio', 'chat' )
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		add_theme_support(
			'html5',
			array( 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'               => 100,
				'width'                => 300,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );

		add_editor_style(
			array(
				'assets/css/style.css',
				'assets/css/media.css',
				'assets/css/editor.css',
			)
		);

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'custom-line-height' );
		add_theme_support( 'link-color' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'custom-units' );

		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
);

/**
 * Allow SVG uploads.
 *
 * @param array $mimes Allowed MIME types.
 * @return array
 */
function mytheme_allow_svg_upload( array $mimes ): array {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'mytheme_allow_svg_upload' );
