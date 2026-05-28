<?php
/**
 * 404 Error Page Template.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>

<main>
	<section>
		<h1><?php esc_html_e( 'Page Not Found', 'mytheme' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for does not exist.', 'mytheme' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'mytheme' ); ?></a>
	</section>
</main>

<?php get_footer(); ?>
