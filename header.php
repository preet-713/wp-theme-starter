<?php
/**
 * Theme Header Template.
 *
 * LOADED BY: get_header() in every page template (home.php, single.php, etc.)
 * OUTPUT: The <head> section and opening <header> of every page
 *
 * WHAT IT DOES:
 * 1. Outputs HTML doctype and opening <html> tag
 * 2. Loads all <head> content (wp_head hook: meta tags, stylesheets, scripts)
 * 3. Outputs <body> tag with WordPress classes (post-type, page-template, etc.)
 * 4. Calls wp_body_open() hook for plugins to inject code
 * 5. Displays site logo (custom logo or site title)
 * 6. Outputs main navigation menu
 *
 * USAGE:
 * In any template file, call: get_header();
 * This loads the opening HTML and navigation.
 * Always pair with get_footer(); at the end of the template.
 *
 * TO CUSTOMIZE:
 * - Swap the logo/title display (show both, hide one, add tagline, etc.)
 * - Add additional nav menus (e.g., secondary menu, mobile menu)
 * - Add header widgets or search form
 * - Modify header structure with CSS or by changing HTML tags
 *
 * IMPORTANT HOOKS:
 * - wp_head()       Outputs all <head> content (CSS, meta tags, scripts)
 * - wp_body_open()  Allows plugins to inject code after <body>
 *
 * @package MyTheme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Character encoding for the document -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- Viewport for responsive design on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- WordPress hook: outputs stylesheets, meta tags, inline scripts -->
	<?php wp_head(); ?>
</head>

<!-- body_class() outputs WP classes like 'single-post', 'page-template-default', etc. -->
<body <?php body_class(); ?>>
<!-- wp_body_open() allows plugins to inject code right after <body> -->
<?php wp_body_open(); ?>

<header>
	<!-- Logo or site title -->
	<div>
		<?php
		// Check if a custom logo is set in WordPress > Appearance > Customize
		if ( has_custom_logo() ) :
			// Output the custom logo
			the_custom_logo();
		else :
			// Fallback: display site name as h1
			?>
			<h1><?php bloginfo( 'name' ); ?></h1>
		<?php endif; ?>
	</div>

	<!-- Main navigation menu -->
	<!-- Menu items are registered in inc/setup/menus.php -->
	<nav aria-label="<?php esc_attr_e( 'Main navigation', 'mytheme' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main_menu',  // Must match register_nav_menu() in menus.php
				'container'      => false,        // Don't wrap menu in <div> (we're already in <nav>)
				'depth'          => 3,            // Allow up to 3 levels of submenu
			)
		);
		?>
	</nav>
</header>

