<?php
/**
 * Front Page Template.
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>
	<?php the_content(); ?>
</main>

<?php get_footer(); ?>
