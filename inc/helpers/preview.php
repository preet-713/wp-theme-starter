<?php
/**
 * Block Editor Preview Helpers.
 *
 * @package MyTheme\Helpers
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render a block preview placeholder.
 *
 * @param array $args Options: slug, title, message, fields.
 * @return void
 */
function mytheme_block_preview_placeholder( array $args = array() ): void {

	$args = array_merge(
		array(
			'slug'    => '',
			'title'   => __( 'Block', 'mytheme' ),
			'message' => __( 'Configure this block in the editor.', 'mytheme' ),
			'fields'  => array(),
		),
		$args
	);

	$slug      = sanitize_html_class( $args['slug'] );
	$image_url = mytheme_block_preview_image_url( $slug );

	if ( $image_url ) :
		?>
		<img
			src="<?php echo esc_url( $image_url ); ?>"
			alt="<?php echo esc_attr( $args['title'] ); ?>"
			style="display:block;width:100%;height:auto;"
		>
		<?php
		return;
	endif;
	?>
	<div style="padding:20px;background:#f0f0f0;">
		<strong><?php echo esc_html( $args['title'] ); ?></strong>
		<p><?php echo esc_html( $args['message'] ); ?></p>
		<?php if ( ! empty( $args['fields'] ) ) : ?>
		<ul>
			<?php foreach ( $args['fields'] as $field ) : ?>
			<li><?php echo esc_html( $field ); ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Get preview image URL for a block.
 *
 * @param string $slug Block slug.
 * @return string
 */
function mytheme_block_preview_image_url( string $slug ): string {
	if ( empty( $slug ) ) {
		return '';
	}

	foreach ( array( 'png', 'jpg', 'webp', 'svg' ) as $ext ) {
		$path = THEME_DIR . '/assets/images/blocks-preview/' . $slug . '.' . $ext;
		if ( file_exists( $path ) ) {
			return THEME_URI . '/assets/images/blocks-preview/' . $slug . '.' . $ext;
		}
	}

	return '';
}

/**
 * Check whether all given block field values are empty.
 *
 * @param array $values Field values.
 * @return bool
 */
function mytheme_block_is_empty( array $values ): bool {
	foreach ( $values as $value ) {
		if ( ! empty( $value ) ) {
			return false;
		}
	}
	return true;
}
