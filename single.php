<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bhari
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php bhari_content_while_before(); ?>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			/**
			 * Pagination
			 */
			bhari_pagination_before();

			the_post_navigation( array(
	            'prev_text' => bhari_strings( 'single-pagination-prev' ),
	            'next_text' => bhari_strings( 'single-pagination-next' ),
	        ) );

	        bhari_pagination_after();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				bhari_comments_template_before();
				comments_template();
				bhari_comments_template_after();
			endif;

		endwhile; // End of the loop.
		?>

		<?php bhari_content_while_after(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

bhari_get_sidebar_single();

get_footer();
