<?php
/**
 * Featured Blog Card Template Part.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;
?>

<article>
	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>">
		<?php
		the_post_thumbnail(
			'full',
			array(
				'alt'     => get_the_title(),
				'loading' => 'eager',
			)
		);
		?>
	</a>
	<?php endif; ?>

	<header>
		<h2>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</header>

	<p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
</article>
