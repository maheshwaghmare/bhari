<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bhari
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php
		if ( is_single() ) :

			if( has_post_thumbnail( get_the_ID() ) ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .entry-thumbnail -->	
			<?php
			endif;

			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			if( has_post_thumbnail( get_the_ID() ) ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .entry-thumbnail -->	
			<?php
			endif;
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

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

	<div class="entry-content">

		<?php

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bhari' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php bhari_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
