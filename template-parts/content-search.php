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

    <?php bhari_entry_header_before(); ?>
    <header class="entry-header">
    <?php bhari_entry_header_top(); ?>

    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

    <?php
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

    <div class="entry-summary">
    <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

    <?php bhari_entry_footer_before(); ?>
    <footer class="entry-footer">
    <?php bhari_entry_footer_top(); ?>

    <?php bhari_entry_footer(); ?>

    <?php bhari_entry_footer_bottom(); ?>
    </footer><!-- .entry-footer -->
    <?php bhari_entry_footer_after(); ?>

</article><!-- #post-## -->
