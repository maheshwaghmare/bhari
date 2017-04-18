/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package Bhari
 */

( function( $ ) {

	/**
	 * Container width for Page
	 *
	 * Applied for:
	 *
	 * .error404,
	 * .page
	 */
	wp.customize( 'bhari[container-width-page]', function( value ) {
		value.bind( function( newval ) {
			var selector  = '.error404 .site-content,';
				selector += '.page .site-content,';
				selector += '.error404 .custom-headers,';
				selector += '.page .custom-headers';

			if ( jQuery( 'style#container_width_page' ).length ) {
				jQuery( 'style#container_width_page' ).html( selector + ' { max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width_page"> ' + selector + ' { max-width:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#container_width_page' ).not( ':last' ).remove();
				}, 100);
			}
		} );
	} );

	/**
	 * Container width for Archive
	 *
	 * Applied for:
	 *
	 * .archive
	 * .blog
	 * .search
	 */
	wp.customize( 'bhari[container-width-archive]', function( value ) {
		value.bind( function( newval ) {
			var selector  = '.archive .site-content,';
				selector += '.search .site-content,';
				selector += '.blog .site-content,';
				selector += '.archive .custom-headers,';
				selector += '.search .custom-headers,';
				selector += '.blog .custom-headers';

			if ( jQuery( 'style#container_width_archive' ).length ) {
				jQuery( 'style#container_width_archive' ).html( selector + ' { max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width_archive"> ' + selector + ' { max-width:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#container_width_archive' ).not( ':last' ).remove();
				}, 100);
			}
		} );
	} );

	/**
	 * Container width for Single
	 *
	 * Applied for:
	 *
	 * .single
	 */
	wp.customize( 'bhari[container-width-single]', function( value ) {
		value.bind( function( newval ) {
			var selector  = '.single .site-content,';
				selector += '.single .custom-headers';

			if ( jQuery( 'style#container_width_single' ).length ) {
				jQuery( 'style#container_width_single' ).html( selector + ' { max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width_single"> ' + selector + ' { max-width:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#container_width_single' ).not( ':last' ).remove();
				}, 100);
			}
		} );
	} );

	/**
	 * Site Title
	 */
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );

	/**
	 * Site Description
	 */
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	/**
	 * Header text color
	 */
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

} )( jQuery );
