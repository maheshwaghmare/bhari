<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bhari
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php tha_page_header_before(); ?>
			<header class="page-header">
				<h1 class="page-title">
				<?php if ( BHARI_SUPPORT_FONTAWESOME ) : ?>
					<i class="fa fa-search"></i>
				<?php endif; ?>
				<?php echo sprintf( esc_html__( 'Search Results for: %s', 'bhari' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header><!-- .page-header -->
			<?php tha_page_header_after(); ?>

			<?php tha_content_while_before(); ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

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
	</section><!-- #primary -->

<?php

bhari_get_sidebar_archive();

get_footer();
