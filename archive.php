<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bhari
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php tha_page_header_before(); ?>
			<header class="page-header">
				<?php
					bhari_the_archive_title();
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php tha_page_header_after(); ?>

			<?php tha_content_while_before(); ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
			?>

			<?php tha_content_while_after(); ?>

			<?php

			/**
			 * Pagination
			 */
			tha_pagination_before();

			the_posts_pagination( array(
				'mid_size'  => 4,
				'prev_text' => bhari_strings( 'pagination-prev' ),
				'next_text' => bhari_strings( 'pagination-next' ),
			) );

			tha_pagination_after();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

bhari_get_sidebar_archive();

get_footer();
