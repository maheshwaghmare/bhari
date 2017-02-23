<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bhari
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;

			bhari_content_while_before();

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			bhari_content_while_after();

			/**
			 * Pagination
			 */
			bhari_pagination_before();

			the_posts_pagination( array(
				'mid_size'  => 4,
				'prev_text' => ( ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-left"></i>' : '' ) . __( ' Previous', 'bhari' ),
				'next_text' => __( 'Next', 'bhari' ) . ( ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-right"></i>' : '' ),
			) );

			bhari_pagination_after();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

bhari_get_sidebar_archive();

get_footer();
