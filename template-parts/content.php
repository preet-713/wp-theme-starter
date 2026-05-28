<?php
/**
 * Default Content Template Part.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="entry-thumbnail img-cover">
		<a href="<?php the_permalink(); ?>">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'alt'     => get_the_title(),
					'loading' => 'lazy',
				)
			);
			?>
		</a>
	</div>
	<?php endif; ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

</article>
