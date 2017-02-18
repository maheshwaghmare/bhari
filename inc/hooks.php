<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @package Bhari
 */

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $tha_supports[] = 'html;
 */
function tha_html_before() {
	do_action( 'tha_html_before' );
}

/**
 * HTML <head> hooks
 *
 * $tha_supports[] = 'head';
 */
function tha_head_top() {
	do_action( 'tha_head_top' );
}
function tha_head_bottom() {
	do_action( 'tha_head_bottom' );
}

/**
 * HTML <body> hooks
 * $tha_supports[] = 'body';
 */
function tha_body_top() {
	do_action( 'tha_body_top' );
}

function tha_body_bottom() {
	do_action( 'tha_body_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $tha_supports[] = 'header';
 */
function tha_header_before() {
	do_action( 'tha_header_before' );
}

function tha_header_after() {
	do_action( 'tha_header_after' );
}

function tha_header_top() {
	do_action( 'tha_header_top' );
}

function tha_header_bottom() {
	do_action( 'tha_header_bottom' );
}

/**
 * Semantic <content> hooks
 *
 * $tha_supports[] = 'content';
 */
function tha_content_before() {
	do_action( 'tha_content_before' );
}

function tha_content_after() {
	do_action( 'tha_content_after' );
}

function tha_content_top() {
	do_action( 'tha_content_top' );
}

function tha_content_bottom() {
	do_action( 'tha_content_bottom' );
}

function tha_entry_content_after() {
	do_action( 'tha_entry_content_after' );
}

function tha_entry_content_before() {
	do_action( 'tha_entry_content_before' );
}

function tha_entry_content_top() {
	do_action( 'tha_entry_content_top' );
}

function tha_entry_content_bottom() {
	do_action( 'tha_entry_content_bottom' );
}

function tha_entry_header_before() {
	do_action( 'tha_entry_header_before' );
}

function tha_entry_header_top() {
	do_action( 'tha_entry_header_top' );
}

function tha_entry_header_bottom() {
	do_action( 'tha_entry_header_bottom' );
}

function tha_entry_header_after() {
	do_action( 'tha_entry_header_after' );
}

//	Entry Footer
function bhari_entry_footer() {
	do_action( 'bhari_entry_footer' );
}

function tha_entry_footer_before() {
	do_action( 'tha_entry_footer_before' );
}

function tha_entry_footer_top() {
	do_action( 'tha_entry_footer_top' );
}

function tha_entry_footer_bottom() {
	do_action( 'tha_entry_footer_bottom' );
}

function tha_entry_footer_after() {
	do_action( 'tha_entry_footer_after' );
}

function tha_content_while_before() {
	do_action( 'tha_content_while_before' );
}

function tha_content_while_after() {
	do_action( 'tha_content_while_after' );
}

/**
 * Semantic <footer> hooks
 *
 * $tha_supports[] = 'footer';
 */
function tha_footer_before() {
	do_action( 'tha_footer_before' );
}

function tha_footer_after() {
	do_action( 'tha_footer_after' );
}

function tha_footer_top() {
	do_action( 'tha_footer_top' );
}

function tha_footer_bottom() {
	do_action( 'tha_footer_bottom' );
}

/**
 * Semantic 'page-header' hooks
 *
 * $tha_supports[] = 'page-header';
 */
function tha_page_header_before() {
	do_action( 'tha_page_header_before' );
}
function tha_page_header_after() {
	do_action( 'tha_page_header_after' );
}

/**
 * Semantic 'pagination' hooks
 *
 * $tha_supports[] = 'pagination';
 */
function tha_pagination_before() {
	do_action( 'tha_pagination_before' );
}
function tha_pagination_after() {
	do_action( 'tha_pagination_after' );
}

/**
 * Semantic 'comments_template' hooks
 *
 * $tha_supports[] = 'comments_template';
 */
function tha_comments_template_before() {
	do_action( 'tha_comments_template_before' );
}
function tha_comments_template_after() {
	do_action( 'tha_comments_template_after' );
}