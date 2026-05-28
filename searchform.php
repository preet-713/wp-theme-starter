<?php
/**
 * Search Form Template.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;
?>

<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field">
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'mytheme' ); ?></span>
		<input
			id="search-field"
			type="search"
			placeholder="<?php esc_attr_e( 'Search&hellip;', 'mytheme' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
		>
	</label>
	<button type="submit">
		<?php esc_html_e( 'Search', 'mytheme' ); ?>
	</button>
</form>
