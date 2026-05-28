<?php
/**
 * Template Name: Blank Page
 * Template Post Type: page
 *
 * A minimal page template with no sidebar, useful for landing pages
 * or full-width Gutenberg block layouts.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>
	<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>
	</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
