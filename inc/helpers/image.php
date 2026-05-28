<?php
/**
 * Image Helper Functions.
 *
 * @package MyTheme\Helpers
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output a responsive <img> tag from an ACF image array.
 *
 * @param array|false $image    ACF image array (url, alt, width, height).
 * @param string      $size     Image size key (default 'full').
 * @param string      $loading  'lazy' or 'eager'.
 * @param string      $class    CSS class(es) to add.
 * @return void
 */
function mytheme_acf_image( $image, string $size = 'full', string $loading = 'lazy', string $class = '' ): void {
	if ( empty( $image ) || ! is_array( $image ) ) {
		return;
	}

	$url    = $image['sizes'][ $size ] ?? $image['url'] ?? '';
	$alt    = $image['alt'] ?? '';
	$width  = $image['sizes'][ $size . '-width' ] ?? $image['width'] ?? '';
	$height = $image['sizes'][ $size . '-height' ] ?? $image['height'] ?? '';

	if ( empty( $url ) ) {
		return;
	}
	?>
	<img
		src="<?php echo esc_url( $url ); ?>"
		alt="<?php echo esc_attr( $alt ); ?>"
		<?php if ( $width ) : ?>width="<?php echo esc_attr( $width ); ?>"<?php endif; ?>
		<?php if ( $height ) : ?>height="<?php echo esc_attr( $height ); ?>"<?php endif; ?>
		<?php if ( $class ) : ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?>
		loading="<?php echo esc_attr( $loading ); ?>"
	>
	<?php
}

/**
 * Get the URL string from an ACF image array.
 *
 * @param array|false $image ACF image array.
 * @param string      $size  Image size key.
 * @return string
 */
function mytheme_acf_image_url( $image, string $size = 'full' ): string {
	if ( empty( $image ) || ! is_array( $image ) ) {
		return '';
	}
	return esc_url( $image['sizes'][ $size ] ?? $image['url'] ?? '' );
}
