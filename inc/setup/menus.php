<?php
/**
 * Navigation Menu Registration.
 *
 * WHAT THIS FILE DOES:
 * Registers navigation menu locations in WordPress.
 * Once registered, these menus appear in:
 * WordPress Admin > Appearance > Menus > Menu Settings
 *
 * HOW TO USE:
 * 1. Add a new menu location here with a unique key
 * 2. Output it in a template using wp_nav_menu( array( 'theme_location' => 'key' ) )
 * 3. Assign a menu to this location in WordPress admin
 *
 * EXAMPLE — Adding a sidebar menu:
 * In this file, add to the array:
 *   'sidebar_menu' => 'Sidebar Navigation',
 *
 * Then in a template, output it:
 *   wp_nav_menu( array( 'theme_location' => 'sidebar_menu' ) );
 *
 * MENUS IN THIS THEME:
 * - main_menu     Location in header.php (primary navigation)
 * - footer_menu_1 Location in footer.php (Company links)
 * - footer_menu_2 Location in footer.php (Resources/Help links)
 * - legal_pages   Location in footer.php (Privacy, Terms, Cookies, etc.)
 *
 * @package MyTheme\Setup
 * @since   1.0.0
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function (): void {
		/**
		 * Register navigation menus.
		 * Each key is the 'theme_location' used in wp_nav_menu().
		 * Each value is the label shown in WordPress admin.
		 */
		register_nav_menus(
			array(
				'main_menu'     => 'Main Menu',        // Primary navigation in header
				'footer_menu_1' => 'Footer Menu One',  // First footer menu column
				'footer_menu_2' => 'Footer Menu Two',  // Second footer menu column
				'legal_pages'   => 'Legal Pages Nav',  // Privacy, Terms, Cookies, etc.
			)
		);
	}
);
