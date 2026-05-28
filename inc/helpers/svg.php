<?php
/**
 * SVG Helper.
 *
 * @package MyTheme\Helpers
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the SVG sprite URL.
 *
 * @return string
 */
function mytheme_sprite_url(): string {
	return get_template_directory_uri() . '/assets/images/svgsprit.svg';
}

/**
 * Output an SVG icon from the sprite sheet.
 *
 * @param string $icon   Icon ID in the sprite.
 * @param int    $width  Width in px.
 * @param int    $height Height in px.
 * @param string $class  CSS class(es).
 * @return void
 */
function mytheme_svg_icon( string $icon, int $width = 24, int $height = 24, string $class = 'icon' ): void {
	if ( empty( $icon ) ) {
		return;
	}
	?>
	<svg class="<?php echo esc_attr( $class ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>">
		<use xlink:href="<?php echo esc_url( mytheme_sprite_url() ); ?>#<?php echo esc_attr( $icon ); ?>"></use>
	</svg>
	<?php
}
