<?php
/**
 * Hero Banner Block Template.
 *
 * USED IN: Gutenberg block editor (add block > MyTheme > Hero Banner)
 * RENDERS: Hero section with heading, subheading, CTA button, and image
 *
 * ACF FIELDS REQUIRED:
 * Create an ACF field group with these fields:
 *   - heading       (Text field)        The main headline
 *   - subheading    (Textarea)          Supporting text
 *   - cta_button    (Link field)        Call-to-action button
 *   - image         (Image field)       Background or side image
 *                   (Set return format to 'Array')
 *
 * HOW IT WORKS:
 * 1. Check if in editor preview mode (show placeholder if so)
 * 2. Get values from ACF fields using get_field()
 * 3. Check if all fields are empty (bail early if so)
 * 4. Output the hero section with the content
 *
 * TO CUSTOMIZE:
 * - Change the HTML structure (add buttons, features, etc.)
 * - Add more ACF fields (e.g., background color, animation)
 * - Add conditional styling based on field values
 * - Use mytheme_inline() for HTML in text fields
 * - Use mytheme_acf_image() for image fields
 *
 * HELPER FUNCTIONS USED:
 * - mytheme_block_preview_placeholder() Show placeholder in editor
 * - mytheme_block_is_empty()            Check if fields are empty
 * - mytheme_inline()                    Echo HTML-safe text
 * - mytheme_url()                       Escape URLs (tel, mailto, http, https)
 * - mytheme_acf_image()                 Echo optimized images
 *
 * @package MyTheme\Blocks
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * BLOCK EDITOR PREVIEW MODE
 * When editing the block in WordPress, show a placeholder instead of the content.
 * Users can see the block but can't preview dynamic content.
 */
if ( isset( $block['data']['is_preview'] ) && $block['data']['is_preview'] ) {
	mytheme_block_preview_placeholder(
		array(
			'slug'  => 'hero-banner',
			'title' => __( 'Hero Banner', 'mytheme' ),
		)
	);
	return;
}

/**
 * GET ACF FIELD VALUES
 * These values are set by the user in the block editor using ACF fields.
 */
$heading    = get_field( 'heading' );
$subheading = get_field( 'subheading' );
$cta_btn    = get_field( 'cta_button' );
$image      = get_field( 'image' );

/**
 * EMPTY CHECK
 * If all fields are empty, don't render anything.
 * This prevents blank blocks from appearing on the frontend.
 */
if ( mytheme_block_is_empty( array( $heading, $subheading, $cta_btn, $image ) ) ) {
	return;
}

$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>

<section<?php echo $anchor; //phpcs:ignore ?>>

	<?php if ( $heading ) : ?>
	<h2><?php mytheme_inline( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( $subheading ) : ?>
	<p><?php echo esc_html( $subheading ); ?></p>
	<?php endif; ?>

	<?php if ( $cta_btn ) : ?>
	<a
		href="<?php echo mytheme_url( $cta_btn['url'] ); //phpcs:ignore ?>"
		<?php echo $cta_btn['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
	>
		<?php echo esc_html( $cta_btn['title'] ); ?>
	</a>
	<?php endif; ?>

	<?php if ( $image ) : ?>
		<?php mytheme_acf_image( $image, 'full', 'eager' ); ?>
	<?php endif; ?>

</section>
