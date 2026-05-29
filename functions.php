<?php
/**
 * Theme Functions & Bootstrap.
 *
 * This file initializes the theme by:
 * 1. Defining global constants for paths and URIs
 * 2. Loading all helper functions (SVG, sanitization, images, etc.)
 * 3. Registering custom blocks and menus
 * 4. Setting up theme support features
 *
 * IMPORTANT: Replace 'mytheme' with your actual theme slug throughout.
 * Use Find & Replace: mytheme → yourthemeslug
 *
 * @package MyTheme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/*
==========================================================================
	Global Theme Constants
	These are used throughout the theme for paths, URIs, and identifiers.
==========================================================================
*/

/**
 * Current theme version.
 * Update this when you release new versions.
 */
define( 'VERSION', '1.0.0' );

/**
 * Theme directory URI (e.g., /wp-content/themes/mytheme)
 * Use this in <link> and <script> tags: THEME_URI . '/assets/css/style.css'
 */
define( 'THEME_URI', get_template_directory_uri() );

/**
 * Theme directory path (e.g., /var/www/html/wp-content/themes/mytheme)
 * Use this for file operations: THEME_DIR . '/assets/images/logo.svg'
 */
define( 'THEME_DIR', get_template_directory() );

/**
 * Include directory path (e.g., /var/www/html/wp-content/themes/mytheme/inc)
 * Shorthand for requiring modules: MYTHEME_INC . 'helpers/svg.php'
 */
define( 'MYTHEME_INC', THEME_DIR . '/inc/' );

/**
 * Text domain for translations.
 * Used in __() and _e() translation functions.
 * Must match the domain in style.css header.
 */
define( 'MYTHEME_TEXTDOMAIN', 'mytheme' );

/*
==========================================================================
	Module Autoloader
	All files listed below are required to load the theme.
	Add new helpers, setup files, or block registrations here.
==========================================================================
*/

$mytheme_modules = array(
	/* Helpers — Utility functions used throughout templates */
	'helpers/svg.php',        // SVG icon functions: mytheme_svg_icon().
	'helpers/preview.php',    // Block preview helpers: mytheme_block_preview_placeholder().
	'helpers/sanitize.php',   // Output sanitization: mytheme_inline(), mytheme_rich().
	'helpers/image.php',      // ACF image helpers: mytheme_acf_image().

	'performance/cleanup.php',
	'performance/lazyload.php',

	/* Setup — Theme initialization and configuration */
	'setup/assets.php',       // Enqueue CSS/JS files (wp_enqueue_style, wp_enqueue_script).
	'setup/menus.php',        // Register navigation menus.
	'setup/theme-support.php', // Add WordPress theme support features.

	/* Blocks — Gutenberg block registration and categories */
	'blocks/category.php',    // Register custom block category.
	'blocks/register.php',    // Register all custom ACF blocks.
);

/**
 * Load each module if the file exists.
 * Prevents fatal errors if a module is missing.
 */
foreach ( $mytheme_modules as $module ) {
	$inc_path = MYTHEME_INC . $module;
	if ( is_readable( $inc_path ) ) {
		require_once $inc_path;
	}
}

/*
==========================================================================
	Custom Post Types (Optional).
	Uncomment the line below to register custom post types.
	Each CPT should have its own file in /post-types/.
==========================================================================
*/

// Example: Register Features post type.
// require_once THEME_DIR . '/post-types/example-cpt.php';.
