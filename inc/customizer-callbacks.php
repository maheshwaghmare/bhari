<?php

/**
 * Bhari Customizer Callback
 *
 * @package Bhari
 * @since 1.0.0
 */
class Bhari_Customize_Callback {

	public static function _sidebar_archive() {

		if( is_home() || is_archive() || is_search() ) {
			return true;
		} else {
			return false;
		}
	}

	public static function _sidebar_single() {

		if( is_single() ) {
			return true;
		} else {
			return false;
		}
	}

	public static function _sidebar_page() {

		if( is_page() || is_404() ) {
			return true;
		} else {
			return false;
		}
	}
}
