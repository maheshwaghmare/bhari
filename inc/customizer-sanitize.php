<?php

/**
 * Bhari Customizer Sanitize
 *
 * @package Bhari
 * @since 1.0.0
 */
final class Bhari_Customize_Sanitize {

	function _sanitize_integer( $input ) {
		return absint( $input );
	}

	function _sanitize_choices( $input, $setting ) {
		
		// Ensure input is a slug
		$input = sanitize_key( $input );
		
		// Get list of choices from the control
		// associated with the setting
		$choices = $setting->manager->get_control( $setting->id )->choices;
		
		// If the input is a valid key, return it;
		// otherwise, return the default
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	function _sanitize_hex_color( $color ) {
	    if ( '' === $color )
	        return '';
	 
	    // 3 or 6 hex digits, or the empty string.
	    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
	        return $color;
	 
	    return '';
	}
}
