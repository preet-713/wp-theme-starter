<?php
/**
 * Single Post Template.
 *
 * LOADED BY: WordPress automatically for single blog posts
 * HIERARCHY: single-{post-type}.php → single.php → index.php
 *
 * WHAT IT DOES:
 * - Displays a single blog post (or custom post type if not overridden)
 * - Shows post title, featured image, and full content
 * - Loads header.php and footer.php
 *
 * USAGE:
 * This is automatically selected by WordPress when viewing:
 * - Single blog posts (/my-blog-post/)
 * - Any custom post type (unless single-{type}.php exists)
 *
 * TO CUSTOMIZE:
 * - Add post metadata (date, author, categories, tags)
 * - Add related posts section
 * - Add comments section
 * - Add post navigation (previous/next)
 * - Create single-{post-type}.php for different layouts per CPT
 *   Example: single-product.php for a custom "Product" post type
 *
 * IMPORTANT FUNCTIONS:
 * - get_header()        Outputs header.php
 * - have_posts()        Loop through posts (usually 1 for single)
 * - the_post()          Set up post data for the current post
 * - the_ID()            Output post ID (used in <article id>)
 * - post_class()        Output WordPress post classes
 * - the_title()         Output post title
 * - has_post_thumbnail() Check if featured image exists
 * - the_post_thumbnail() Output featured image
 * - the_content()       Output post content (respects 'more' tags)
 * - get_footer()        Outputs footer.php
 *
 * @package MyTheme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>
	<?php
	// Loop through posts (usually only 1 for single post)
	while ( have_posts() ) :
		the_post();
	?>
	<article
		id="post-<?php the_ID(); ?>"
		<?php post_class(); ?>
	>

		<!-- Post header with title -->
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<!-- Featured image (if set) -->
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'alt'     => get_the_title(),
					'loading' => 'lazy',
				)
			);
			?>
		</div>
		<?php endif; ?>

		<!-- Main post content -->
		<div class="entry-content">
			<?php the_content(); ?>
		</div>

	</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
