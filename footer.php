<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bhari
 */

?>
	<?php bhari_hook_content_bottom(); ?>
	</div><!-- #content -->
	<?php bhari_hook_content_after(); ?>

	<?php bhari_hook_footer(); ?>

</div><!-- #page -->

<?php bhari_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>
