<?php
/**
 * Blog Listing Page.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>

	<section>
		<header>
			<h1><?php echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>
		</header>
	</section>

	<section>

		<?php if ( have_posts() ) : ?>

			<?php the_post(); ?>
			<div>
				<?php get_template_part( 'template-parts/blog/card', 'featured' ); ?>
			</div>

			<?php if ( have_posts() ) : ?>
			<ul>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php get_template_part( 'template-parts/blog/card' ); ?>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>

		<?php else : ?>
			<p><?php esc_html_e( 'No posts found.', 'mytheme' ); ?></p>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/blog/pagination' ); ?>

	</section>

</main>

<?php get_footer(); ?>
