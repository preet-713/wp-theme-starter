<?php
/**
 * Register ACF Blocks.
 *
 * WHAT THIS FILE DOES:
 * Registers custom Gutenberg blocks powered by Advanced Custom Fields (ACF).
 * These blocks appear in the block editor for easy content management.
 *
 * REQUIREMENT: Advanced Custom Fields (ACF) Pro or Free must be installed.
 *
 * HOW TO ADD A NEW BLOCK:
 * 1. Create a template file in /blocks/ (e.g., blocks/my-block.php)
 * 2. Create ACF field group in WordPress admin
 * 3. Add the block to the $blocks array below:
 *    array(
 *        'name'        => 'my-block',  (matches filename: my-block.php)
 *        'title'       => __( 'My Block', 'mytheme' ),
 *        'description' => __( 'Description shown in block picker', 'mytheme' ),
 *        'icon'        => 'star',  (Dashicon name)
 *        'keywords'    => array( 'my', 'keywords' ),
 *    ),
 * 4. The block will appear in the editor under 'MyTheme' category
 *
 * AVAILABLE DASHICONS:
 * See: https://developer.wordpress.org/resource/dashicons/
 * Examples: 'cover-image', 'slides', 'star', 'columns', 'layout', etc.
 *
 * BLOCK FILE STRUCTURE:
 * Each block template (e.g., blocks/hero-banner.php) should:
 * 1. Check if in editor preview mode
 * 2. Get ACF field values: get_field( 'field_name' )
 * 3. Check if required fields are filled
 * 4. Output HTML with the content
 *
 * See blocks/hero-banner.php for a complete example.
 *
 * @package MyTheme\Blocks
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register custom ACF blocks.
 *
 * HOOK: init
 * Called when WordPress initializes, before plugins are fully loaded.
 * This ensures ACF is available when blocks are registered.
 */
function mytheme_register_acf_blocks(): void {

	/**
	 * Define all custom blocks.
	 * Each array contains the block metadata and configuration.
	 */
	$blocks = array(
		/**
		 * Hero Banner Block
		 * Location: blocks/hero-banner.php
		 * Used on: Front page (hero section with image)
		 */
		array(
			'name'        => 'hero-banner',
			'title'       => __( 'Hero Banner', 'mytheme' ),
			'description' => __( 'Hero section for the front page.', 'mytheme' ),
			'icon'        => 'cover-image',
			'keywords'    => array( 'hero', 'banner' ),
		),

		// Template for adding more blocks:
		// array(
		//     'name'        => 'block-slug',
		//     'title'       => __( 'Block Title', 'mytheme' ),
		//     'description' => __( 'What this block does', 'mytheme' ),
		//     'icon'        => 'dashicon-name',
		//     'keywords'    => array( 'keyword1', 'keyword2' ),
		// ),
	);

	/**
	 * Loop through all blocks and register them with ACF.
	 */
	foreach ( $blocks as $block ) {
		acf_register_block_type(
			array(
				'name'            => $block['name'],
				'title'           => $block['title'],
				'description'     => $block['description'],
				'category'        => 'mytheme',  // Shows under 'MyTheme' in block picker
				'icon'            => $block['icon'],
				'keywords'        => $block['keywords'],
				'render_template' => get_template_directory() . '/blocks/' . $block['name'] . '.php',
				'mode'            => 'preview',  // Always show preview in editor
				'supports'        => array(
					'anchor' => true,        // Allow custom anchor/ID
					'align'  => array( 'full' ), // Allow full-width alignment
				),
				'example'         => array(
					'attributes' => array(
						'data' => array(
							'is_preview' => true,  // Show placeholder in editor
						),
					),
				),
			)
		);
	}
}

/**
 * Hook: init
 * Fires when WordPress is fully initialized.
 * This ensures ACF is loaded before block registration.
 * Priority 10 is default.
 */
add_action( 'init', 'mytheme_register_acf_blocks' );
