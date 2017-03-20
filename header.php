<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bhari
 * @since 1.0
 */

?><!DOCTYPE html>
<?php bhari_hook_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php bhari_hook_body_top(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bhari' ); ?></a>

	<?php bhari_hook_header(); ?>

	<?php bhari_hook_content_before(); ?>
	<div id="content" class="site-content">
	<?php bhari_hook_content_top(); ?>
