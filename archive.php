<?php
/**
 * Archive Page Template.
 * Handles category, tag, author, date, and custom taxonomy archives.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>

	<section>
		<header>
			<h1><?php the_archive_title(); ?></h1>
			<?php
			$archive_description = get_the_archive_description();
			if ( $archive_description ) :
				?>
			<div>
				<?php echo wp_kses_post( $archive_description ); ?>
			</div>
			<?php endif; ?>
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
			<p><?php esc_html_e( 'No posts found.', 'mytheme' ); ?></p>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/blog/pagination' ); ?>

	</section>

</main>

<?php get_footer(); ?>
