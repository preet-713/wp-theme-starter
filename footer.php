<?php
/**
 * Theme Footer Template.
 *
 * LOADED BY: get_footer() in every page template (home.php, single.php, etc.)
 * OUTPUT: The closing </body> and </html> tags, plus footer content
 *
 * WHAT IT DOES:
 * 1. Displays footer logo/site name
 * 2. Outputs footer navigation menus (Company, Resources, Legal Pages)
 * 3. Calls wp_footer() hook for WordPress and plugins to inject code
 * 4. Closes the HTML document with </body> and </html>
 *
 * USAGE:
 * In any template file, call: get_footer();
 * This should be the last thing called in a template (after closing <main>).
 * Always pair with get_header(); at the beginning.
 *
 * TYPICAL FOOTER STRUCTURE:
 * - Logo (optional, same as header or different)
 * - Multiple footer menus (Company, Resources, Legal)
 * - Copyright notice (add in a widget area or hardcoded)
 * - Social links (add via footer menu or custom widget)
 *
 * TO CUSTOMIZE:
 * - Add footer widgets or sidebars (register in menus.php)
 * - Add copyright year: &copy; <?php echo gmdate( 'Y' ); ?>
 * - Add social media links
 * - Add footer newsletter signup
 * - Add payment method icons, certifications, etc.
 *
 * IMPORTANT HOOKS:
 * - wp_footer()  Outputs scripts and allows plugins to inject code before </body>
 *
 * MENUS:
 * All menus are registered in inc/setup/menus.php:
 * - footer_menu_1 (Company links)
 * - footer_menu_2 (Resources/Support links)
 * - legal_pages   (Privacy Policy, Terms of Service, etc.)
 *
 * @package MyTheme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<footer>
	<div>
		<!-- Footer logo or site name -->
		<div>
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<h2><?php bloginfo( 'name' ); ?></h2>
			<?php endif; ?>
		</div>

		<!-- Company menu (Company info, About, Careers, etc.) -->
		<!-- Registered in inc/setup/menus.php as 'footer_menu_1' -->
		<nav aria-label="<?php esc_attr_e( 'Footer menu', 'mytheme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer_menu_1',
					'container'      => false,
					'depth'          => 1,  // No submenus in footer
					'fallback_cb'    => false, // Don't show a fallback menu
				)
			);
			?>
		</nav>

		<!-- Resources menu (Help, Support, Documentation, etc.) -->
		<!-- Registered in inc/setup/menus.php as 'footer_menu_2' -->
		<nav aria-label="<?php esc_attr_e( 'Resources', 'mytheme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer_menu_2',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

	</div>

	<!-- Legal pages menu (Privacy Policy, Terms, Cookies, etc.) -->
	<!-- Only displayed if the menu has items assigned in WordPress admin -->
	<?php if ( has_nav_menu( 'legal_pages' ) ) : ?>
	<nav aria-label="<?php esc_attr_e( 'Legal pages', 'mytheme' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'legal_pages',
				'container'      => false,
				'depth'          => 0,
				'fallback_cb'    => false,
			)
		);
		?>
	</nav>
	<?php endif; ?>

</footer>

<!-- WordPress hook: outputs JS scripts, Google Analytics, etc. -->
<?php wp_footer(); ?>
</body>
</html>

