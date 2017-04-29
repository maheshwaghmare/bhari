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

    <?php bhari_entry_header_before(); ?>
    <header class="entry-header">
    <?php bhari_entry_header_top(); ?>
        
    <?php
    if (is_single() ) :

        if (has_post_thumbnail(get_the_ID()) ) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .entry-thumbnail -->    
            <?php
        endif;

        the_title('<h1 class="entry-title">', '</h1>');

        else :

            if (has_post_thumbnail(get_the_ID()) ) : ?>
                    <div class="entry-thumbnail">
                    <?php the_post_thumbnail(); ?>
                    </div><!-- .entry-thumbnail -->    
                    <?php
            endif;

            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

        endif;

        if ('post' === get_post_type() ) :

            /**
             * Print post meta
             *
             * @see bhari_post_meta($meta_list, $before, $after)
             */
            bhari_post_meta(array( 'author', 'date', 'category' ), '<div class="entry-meta">', '</div><!-- .entry-meta -->');

        endif;
    ?>

    <?php bhari_entry_header_bottom(); ?>
    </header><!-- .entry-header -->
    <?php bhari_entry_header_after(); ?>

    <?php bhari_entry_content_before(); ?>
    <div class="entry-content">
    <?php bhari_entry_content_top(); ?>

    <?php
    /* translators: %s: Name of current post */
    the_content(
        sprintf(
            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'bhari'),
            get_the_title()
        )
    );

    wp_link_pages(
        array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'bhari'),
                'after'  => '</div>',
        )
    );
    ?>

    <?php bhari_entry_content_bottom(); ?>
    </div><!-- .entry-content -->
    <?php bhari_entry_content_after(); ?>

    <?php bhari_entry_footer_before(); ?>
    <footer class="entry-footer">
    <?php bhari_entry_footer_top(); ?>

    <?php bhari_entry_footer(); ?>

    <?php bhari_entry_footer_bottom(); ?>
    </footer><!-- .entry-footer -->
    <?php bhari_entry_footer_after(); ?>

</article><!-- #post-## -->
