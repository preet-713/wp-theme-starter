<?php
/**
 * Search Results Template.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>

	<section>
		<header>
			<h1>
				<?php
				printf(
					/* translators: %s: search term */
					esc_html__( 'Search Results for: %s', 'mytheme' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>
	</section>

	<section>

		<?php if ( have_posts() ) : ?>

			<ul>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php get_template_part( 'template-parts/blog/card' ); ?>
				<?php endwhile; ?>
			</ul>

		<?php else : ?>
			<p><?php esc_html_e( 'No results found. Try a different search term.', 'mytheme' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/blog/pagination' ); ?>

	</section>

</main>

<?php get_footer(); ?>
