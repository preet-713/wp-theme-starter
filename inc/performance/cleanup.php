<?php
/**
 * This helps to clean the wp-head.
 *
 * @package JuraLaw\Performance
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	static function (): void {
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

		add_filter( 'should_load_separate_core_block_assets', '__return_true' );
	}
);

/**
 * Hide the Site WordPress version.
 */
add_filter(
	'the_generator',
	static fn(): string => ''
);

/**
 * To disable the xmlrpc.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * REST API must be disable for guest users.
 */
add_filter(
	'rest_authentication_errors',
	static function ( $result ) {
		if ( ! empty( $result ) ) {
			return $result;
		}

		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

		if ( ! is_user_logged_in() && false !== strpos( $request_uri, '/wp-json/wp/v2/users' ) ) {
			return new WP_Error(
				'rest_not_logged_in',
				__( 'You must logged in to get the access of this URl', 'juralaw' ),
				array( 'status' => 401 )
			);
		}

		return $result;
	}
);
