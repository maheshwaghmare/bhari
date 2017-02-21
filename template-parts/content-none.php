<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bhari
 */

?>

<section class="no-results not-found">

	<?php bhari_page_header_before(); ?>
	<header class="page-header">
		<h1 class="page-title">
			<?php echo bhari_strings( 'content-none-title' ); ?>
		</h1>
	</header><!-- .page-header -->
	<?php bhari_page_header_after(); ?>

	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php echo bhari_strings( 'content-none-contents-admin' ); ?>

		<?php elseif ( is_search() ) : ?>

			<p><?php echo bhari_strings( 'content-none-search-contents' ); ?></p>

			<?php
				get_search_form();

		else : ?>

			<p><?php echo bhari_strings( 'content-none-contents' ); ?></p>

			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
