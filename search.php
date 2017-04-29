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

            <?php if (have_posts() ) : ?>

                <?php bhari_page_header_before(); ?>
                <header class="page-header">
                    <h1 class="page-title">
                        <?php if (BHARI_SUPPORT_FONTAWESOME ) : ?>
                            <i class="fa fa-search" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php printf(__('Search Results for: %s', 'bhari'), '<span>' . get_search_query() . '</span>'); ?>
                    </h1>
                </header><!-- .page-header -->
                <?php bhari_page_header_after(); ?>

                <?php bhari_content_while_before(); ?>

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                    get_template_part('template-parts/content', 'search');

                endwhile;
                ?>

                <?php bhari_content_while_after(); ?>

                <?php

                /**
                 * Pagination
                 */
                bhari_pagination_before();

                the_posts_pagination(
                    array(
                            'mid_size'  => 4,
                            'prev_text' => ( ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-left" aria-hidden="true"></i>' : '' ) . __(' Previous', 'bhari'),
                            'next_text' => __('Next', 'bhari') . ( ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-right" aria-hidden="true"></i>' : '' ),
                    )
                );

                bhari_pagination_after();

            else :

                get_template_part('template-parts/content', 'none');

            endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php

bhari_get_sidebar_archive();

get_footer();
