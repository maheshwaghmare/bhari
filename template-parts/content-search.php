<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bhari
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php
		if ( 'post' === get_post_type() ) :

			/**
			 * Print post meta
			 * 
			 * @see  bhari_post_meta($meta_list, $before, $after)
			 */
			bhari_post_meta( array('author', 'date', 'category', 'tags'), '<div class="entry-meta">', '</div><!-- .entry-meta -->' );

		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php bhari_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
