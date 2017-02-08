<?php
/**
 * Bhari Customizer Callback
 *
 * @package Bhari
 */

/**
 * Bhari Customizer Callback
 *
 * @package Bhari
 * @since 1.0.0
 */
if ( ! class_exists( 'Bhari_Customize_Callback' ) ) :

	/**
	 * Bhari Customizer Callback
	 */
	class Bhari_Customize_Callback {

		/**
		 * Sidebar Archive
		 *
		 * @return boolean Return the sidebar status for Home, Archive & Search pages.
		 */
		public static function _sidebar_archive() {

			if ( is_home() || is_archive() || is_search() ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Sidebar Single
		 *
		 * @return boolean Return the sidebar status for Single Post.
		 */
		public static function _sidebar_single() {

			if ( is_single() ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Sidebar Page
		 *
		 * @return boolean Return the sidebar status for Single Page / Custom post type & 404.
		 */
		public static function _sidebar_page() {

			if ( is_page() || is_404() ) {
				return true;
			} else {
				return false;
			}
		}
	}

endif;
