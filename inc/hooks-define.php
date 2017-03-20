<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @package Bhari
 */

/**
 * List of hooks:
 *
 * bhari_hook_html_before
 * bhari_hook_body_top
 * bhari_body_bottom
 * 
 * bhari_hook_header
 * 
 * bhari_hook_content_before
 * bhari_hook_content_after
 * bhari_hook_content_top
 * bhari_hook_content_bottom
 * bhari_entry_content_after
 * bhari_entry_content_before
 * bhari_entry_content_top
 * bhari_entry_content_bottom
 * bhari_entry_header_before
 * bhari_entry_header_top
 * bhari_entry_header_bottom
 * bhari_entry_header_after
 * bhari_entry_footer
 * bhari_entry_footer_before
 * bhari_entry_footer_top
 * bhari_entry_footer_bottom
 * bhari_entry_footer_after
 * bhari_content_while_before
 * bhari_content_while_after
 * bhari_footer_before
 * bhari_footer_after
 * bhari_footer_top
 * bhari_footer_bottom
 * 
 * bhari_hook_page_header
 * 
 * bhari_pagination_before
 * bhari_pagination_after
 * bhari_comments_template_before
 * bhari_comments_template_after
 */

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $bhari_supports[] = 'html;
 */

function bhari_hook_html_before() {
	do_action( 'bhari_hook_html_before' );
}

/**
 * HTML <head> hooks
 *
 * $bhari_supports[] = 'head';
 */

/**
 * HTML <body> hooks
 * $bhari_supports[] = 'body';
 */

/**
 * <body> top
 */
function bhari_hook_body_top() {
	do_action( 'bhari_hook_body_top' );
}

/**
 * <body> bottom
 */
function bhari_body_bottom() {
	do_action( 'bhari_body_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $bhari_supports[] = 'header';
 */

/**
 * Header before
 */
function bhari_hook_header() {
	do_action( 'bhari_hook_header' );
}

/**
 * Semantic <content> hooks
 *
 * $bhari_supports[] = 'content';
 */

/**
 * Content before
 */
function bhari_hook_content_before() {
	do_action( 'bhari_hook_content_before' );
}

/**
 * Content after
 */
function bhari_hook_content_after() {
	do_action( 'bhari_hook_content_after' );
}

/**
 * Content top
 */
function bhari_hook_content_top() {
	do_action( 'bhari_hook_content_top' );
}

/**
 * Content bottom
 */
function bhari_hook_content_bottom() {
	do_action( 'bhari_hook_content_bottom' );
}

/**
 * Entry content after
 */
function bhari_entry_content_after() {
	do_action( 'bhari_entry_content_after' );
}

/**
 * Entry content before
 */
function bhari_entry_content_before() {
	do_action( 'bhari_entry_content_before' );
}

/**
 * Entry content top
 */
function bhari_entry_content_top() {
	do_action( 'bhari_entry_content_top' );
}

/**
 * Entry content bottom
 */
function bhari_entry_content_bottom() {
	do_action( 'bhari_entry_content_bottom' );
}

/**
 * Entry header before
 */
function bhari_entry_header_before() {
	do_action( 'bhari_entry_header_before' );
}

/**
 * Entry header top
 */
function bhari_entry_header_top() {
	do_action( 'bhari_entry_header_top' );
}

/**
 * Entry header bottom
 */
function bhari_entry_header_bottom() {
	do_action( 'bhari_entry_header_bottom' );
}

/**
 * Entry header after
 */
function bhari_entry_header_after() {
	do_action( 'bhari_entry_header_after' );
}

/**
 * Bhari_entry_footer
 */
function bhari_entry_footer() {
	do_action( 'bhari_entry_footer' );
}

/**
 * Entry footer before
 */
function bhari_entry_footer_before() {
	do_action( 'bhari_entry_footer_before' );
}

/**
 * Entry footer top
 */
function bhari_entry_footer_top() {
	do_action( 'bhari_entry_footer_top' );
}

/**
 * Entry footer bottom
 */
function bhari_entry_footer_bottom() {
	do_action( 'bhari_entry_footer_bottom' );
}

/**
 * Entry footer after
 */
function bhari_entry_footer_after() {
	do_action( 'bhari_entry_footer_after' );
}

/**
 * Content while before
 */
function bhari_content_while_before() {
	do_action( 'bhari_content_while_before' );
}

/**
 * Content while after
 */
function bhari_content_while_after() {
	do_action( 'bhari_content_while_after' );
}

/**
 * Semantic <footer> hooks
 *
 * $bhari_supports[] = 'footer';
 */

/**
 * Footer
 */
function bhari_hook_footer() {
	do_action( 'bhari_hook_footer' );
}

/**
 * Semantic 'page-header' hooks
 *
 * $bhari_supports[] = 'page-header';
 */

/**
 * Page header
 */
function bhari_hook_page_header() {
	do_action( 'bhari_hook_page_header' );
}

/**
 * Semantic 'pagination' hooks
 *
 * $bhari_supports[] = 'pagination';
 */

/**
 * Pagination before
 */
function bhari_pagination_before() {
	do_action( 'bhari_pagination_before' );
}

/**
 * Pagination after
 */
function bhari_pagination_after() {
	do_action( 'bhari_pagination_after' );
}

/**
 * Semantic 'comments_template' hooks
 *
 * $bhari_supports[] = 'comments_template';
 */

/**
 * Comments template before
 */
function bhari_comments_template_before() {
	do_action( 'bhari_comments_template_before' );
}

/**
 * Comments template after
 */
function bhari_comments_template_after() {
	do_action( 'bhari_comments_template_after' );
}