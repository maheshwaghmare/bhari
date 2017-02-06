<?php

/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bhari
 */

/**
 * Theme default strings
 */
if( ! function_exists('bhari_strings') ) :
	function bhari_strings( $request_string = '', $default_val = '' ) {

		$defaults = apply_filters( 'bhari/default_strings', array(
			'pagination-prev'        => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-left"></i> ' . __( ' Previous', 'bhari' ) : '' . __( ' Previous', 'bhari' ),
			'pagination-next'        => ( BHARI_SUPPORT_FONTAWESOME ) ? __( 'Next', 'bhari' ) . ' <i class="fa fa-angle-right"></i>' : __( 'Next', 'bhari' ),
			'single-pagination-prev' => ( BHARI_SUPPORT_FONTAWESOME ) ? __( '<span class="link-icon"><i class="fa fa-angle-left"></i></span><span class="link-wrap"><span class="link-caption">Previous Article</span><span class="link-title">%title</span></span>' ) : __( '<span class="link-wrap"><span class="link-caption">Previous Article</span><span class="link-title">%title</span></span>' ),
			'single-pagination-next' => ( BHARI_SUPPORT_FONTAWESOME ) ? __( '<span class="link-wrap"><span class="link-caption">Next Article</span><span class="link-title">%title</span></span><span class="link-icon"><i class="fa fa-angle-right"></i></span>' ) : __( '<span class="link-wrap"><span class="link-caption">Next Article</span><span class="link-title">%title</span></span>' ),
		) );

		if( array_key_exists($request_string, $defaults) ) {
			return $defaults[$request_string];
		} else {
			return $default_val;
		}
	}
endif;

/**
 * Add sidebars
 */
if( ! function_exists('bhari_get_sidebar_layout') ) :
	function bhari_get_sidebar_layout( $layout ) {

		switch ( $layout ) {

			case 'layout-sidebar-content' :
						get_sidebar( 'left' );
					break;

			case 'layout-content-sidebar' :
						get_sidebar( 'right' );
					break;

			case 'layout-content-sidebar-sidebar' :
			case 'layout-sidebar-content-sidebar' :
			case 'layout-sidebar-sidebar-content' :
						get_sidebar( 'left' );
						get_sidebar( 'right' );
				break;
		}
	}
endif;

/**
 * Get individual option
 */
if( ! function_exists('bhari_get_option') ) :
	function bhari_get_option( $key = '', $defaults = '' )
	{
		$options = 	apply_filters( 'bhari/theme_defaults/after_parse_args', wp_parse_args(
						get_option( 'bhari', true ),
						bhari_get_defaults()
					) );

		if( isset( $options[ $key ] ) ) {
			return $options[ $key ];
		} else {
			return $defaults;
		}
	}
endif;

/**
 * Add body classes
 */
if( ! function_exists('bhari_body_class') ) :
	function bhari_body_class( $classes ) {

		if( is_home() || is_archive() || is_search() ) {
			$layout = bhari_get_option( 'sidebar-archive' );
		} else if( is_page() || is_404() ) {
			$layout = bhari_get_option( 'sidebar-page' );
		} else if( is_single() ) {
			$layout = bhari_get_option( 'sidebar-single' );
		}

		switch ( $layout ) {

			case 'layout-sidebar-content' : 		$classes[] = 'layout-sidebar-content'; break;
			case 'layout-content-sidebar' : 		$classes[] = 'layout-content-sidebar'; break;
			case 'layout-content-sidebar-sidebar' :	$classes[] = 'layout-content-sidebar-sidebar'; break;
			case 'layout-sidebar-content-sidebar' :	$classes[] = 'layout-sidebar-content-sidebar'; break;
			case 'layout-sidebar-sidebar-content' : $classes[] = 'layout-sidebar-sidebar-content'; break;
			case 'layout-no-sidebar' :
			default:
					$classes[] = 'layout-no-sidebar';
				break;
		}

		return $classes;
	}
	add_filter( 'body_class', 'bhari_body_class' );
endif;

/**
 * Content Width
 *
 * 'container-width-archive'		Applied for archive pages (Front page as a Blog page)
 * 'container-width-page'			Applied for Only pages. (Front page as a Static page)
 * 'container-width-single'			Applied for Only single post.
 */
if( ! function_exists('bhari_wp_head') ) :
	function bhari_wp_head( $classes ) {

		if( is_home() || is_archive() || is_search() ) {
			$content_width = bhari_get_option( 'container-width-archive' );
		} else if( is_page() || is_404() ) {
			$content_width = bhari_get_option( 'container-width-page' );
		} else if( is_single() ) {
			$content_width = bhari_get_option( 'container-width-single' );
		} else {
			$content_width = 1100;
		}

		?>
		<style type="text/css">
			.site-content {
				max-width: <?php esc_attr_e( $content_width ); ?>px;
			}
		</style>
		<?php

		return $classes;
	}
	add_filter( 'wp_head', 'bhari_wp_head' );
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if( ! function_exists('bhari_body_classes') ) :
	function bhari_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
	add_filter( 'body_class', 'bhari_body_classes' );
endif;

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
if( ! function_exists('bhari_pingback_header') ) :
	function bhari_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'bhari_pingback_header' );
endif;