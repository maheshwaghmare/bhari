<?php
/**
 * Theme Feature: Site Top Bar
 *
 * @package Bhari
 */

if( ! function_exists( 'bhari_header_top_search' ) ) :

	/**
	 * Site Header Top Bar
	 *
	 * @return void
	 */
	function bhari_header_top_search() {

		if( is_single() ) {
			get_search_form();
		}
	}

	add_action( 'bhari_header_top', 'bhari_header_top_search' );

endif;