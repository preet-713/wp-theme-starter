<?php
/**
 * Custom method Theme Sanitization, whole functionality can be replaced by core features.
 *
 * @package JuraLaw\Helpers
 */

defined( 'ABSPATH' ) || exit;

/**
 * Allow-list for short rich-text fields.
 * Headings, button labels, sub-titles.
 *
 * @return array
 */
function jl_kses_inline(): array {
	return array(
		'a'      => array(
			'href'   => true,
			'title'  => true,
			'target' => true,
			'rel'    => true,
			'class'  => true,
		),
		'br'     => array(),
		'em'     => array( 'class' => true ),
		'i'      => array( 'class' => true ),
		'strong' => array( 'class' => true ),
		'b'      => array( 'class' => true ),
		'span'   => array( 'class' => true ),
		'sup'    => array(),
		'sub'    => array(),
	);
}

/**
 * Allow-list for long-form WYSIWYG content.
 *
 * @param string $html         Raw HTML to filter.
 * @param bool   $allow_iframe Whether to allow safe iframe attributes.
 * @return string
 */
function jl_kses_post( string $html, bool $allow_iframe = false ): string {
	$allowed = wp_kses_allowed_html( 'post' );

	if ( $allow_iframe ) {
		$allowed['iframe'] = array(
			'src'             => true,
			'width'           => true,
			'height'          => true,
			'frameborder'     => true,
			'allow'           => true,
			'allowfullscreen' => true,
			'title'           => true,
			'loading'         => true,
		);
	}

	return wp_kses( $html, $allowed );
}

/**
 * Echo a string with the inline allow-list.
 * Use for headings, titles, labels, button text.
 *
 * @param string $html HTML fragment to render.
 * @return void
 */
function jl_inline( string $html ): void {
	echo wp_kses( $html, jl_kses_inline() );
}

/**
 * Echo rich-text content with post-level allow-list.
 * Use for wysiwyg fields and long-form content.
 *
 * @param string $html   Raw HTML.
 * @param bool   $allow_iframe Pass true to allow safe iframe attributes.
 * @return void
 */
function jl_rich( string $html, bool $allow_iframe = false ): void {
	echo jl_kses_post( $html, $allow_iframe ); //phpcs:ignore
}

/**
 * Escape a URL.
 * Accepts http, https, mailto, tel, sms and relative URIs.
 *
 * @param string|null $url URL to escape.
 * @return string
 */
function jl_url( ?string $url ): string {
	if ( empty( $url ) ) {
		return '';
	}

	return esc_url( $url, array( 'http', 'https', 'mailto', 'tel', 'sms' ) );
}

/**
 * Sanitize an HTML class or ID fragment.
 * Use for CSS classes, IDs, modifiers.
 *
 * @param string $value Raw value to slugify.
 * @return string
 */
function jl_slug( string $value ): string {
	return sanitize_html_class( sanitize_title( $value ) );
}
