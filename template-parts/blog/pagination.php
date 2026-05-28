<?php
/**
 * Blog Pagination Template Part.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

$total_pages  = $GLOBALS['wp_query']->max_num_pages;
$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

if ( $total_pages <= 1 ) {
	return;
}
?>

<nav aria-label="<?php esc_attr_e( 'Blog pagination', 'mytheme' ); ?>">
	<ul>

		<?php if ( $current_page > 1 ) : ?>
		<li>
			<a href="<?php echo esc_url( get_pagenum_link( $current_page - 1 ) ); ?>">
				<?php esc_html_e( 'Previous', 'mytheme' ); ?>
			</a>
		</li>
		<?php endif; ?>

		<?php for ( $i = 1; $i <= $total_pages; $i++ ) : ?>
		<li>
			<?php if ( $i === $current_page ) : ?>
			<span aria-current="page">
				<?php echo esc_html( $i ); ?>
			</span>
			<?php else : ?>
			<a href="<?php echo esc_url( get_pagenum_link( $i ) ); ?>">
				<?php echo esc_html( $i ); ?>
			</a>
			<?php endif; ?>
		</li>
		<?php endfor; ?>

		<?php if ( $current_page < $total_pages ) : ?>
		<li>
			<a href="<?php echo esc_url( get_pagenum_link( $current_page + 1 ) ); ?>">
				<?php esc_html_e( 'Next', 'mytheme' ); ?>
			</a>
		</li>
		<?php endif; ?>

	</ul>
</nav>
