<?php
/**
 * Blog Card Template Part.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;
?>

<li>
	<article>
		<?php if ( has_post_thumbnail() ) : ?>
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
		<?php endif; ?>

		<header>
			<h3>
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>
		</header>

		<p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
	</article>
</li>
