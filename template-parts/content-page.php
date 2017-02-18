<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bhari
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php tha_entry_header_before(); ?>
	<header class="entry-header">
		<?php tha_entry_header_top(); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php tha_entry_header_bottom(); ?>
	</header><!-- .entry-header -->
	<?php tha_entry_header_after(); ?>

	<?php tha_entry_content_before(); ?>
	<div class="entry-content">
		<?php tha_entry_content_top(); ?>
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bhari' ),
				get_the_title()
			) );
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bhari' ),
				'after'  => '</div>',
			) );
		?>
		<?php tha_entry_content_bottom(); ?>
	</div><!-- .entry-content -->
	<?php tha_entry_content_after(); ?>

	<?php if ( get_edit_post_link() ) : ?>

		<?php tha_entry_footer_before(); ?>
		<footer class="entry-footer">
			<?php tha_entry_footer_top(); ?>

			<?php bhari_entry_footer(); ?>

			<?php tha_entry_footer_bottom(); ?>
		</footer><!-- .entry-footer -->
		<?php tha_entry_footer_after(); ?>

	<?php endif; ?>
</article><!-- #post-## -->
