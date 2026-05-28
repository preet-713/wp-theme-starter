<?php
/**
 * Default Fallback Template.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>
	<section>
		<div class="container">

			<?php if ( have_posts() ) : ?>
				<ul>
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content' );
					endwhile;
					?>
				</ul>
			<?php else : ?>
				<p><?php esc_html_e( 'Nothing found.', 'mytheme' ); ?></p>
			<?php endif; ?>

		</div>
	</section>
</main>

<?php get_footer(); ?>
