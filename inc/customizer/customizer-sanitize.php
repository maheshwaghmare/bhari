<?php
/**
 * Bhari Customizer Sanitize
 *
 * @package Bhari
 */

/**
 * Customizer Sanitize
 */
if (! class_exists('Bhari_Customize_Sanitize') ) :

    /**
     * Customizer Sanitize
     *
     * @package Bhari
     * @since   1.0.0
     */
    final class Bhari_Customize_Sanitize
    {


        /**
         * Sanitize Integer
         *
         * @param  number $input Customizer setting input number.
         * @return number        Return absolute number.
         */
        public static function _sanitize_integer( $input ) 
        {
            return absint($input);
        }

        /**
         * Sanitize Choices
         *
         * @param  string $input   Input key.
         * @param  object $setting Settings object.
         * @return mixed          Return setting value.
         */
        public static function _sanitize_choices( $input, $setting ) 
        {

            // Ensure input is a slug.
            $input = sanitize_key($input);

            // Get list of choices from the control.
            // associated with the setting.
            $choices = $setting->manager->get_control($setting->id)->choices;

            // If the input is a valid key, return it;
            // otherwise, return the default.
            return ( array_key_exists($input, $choices) ? $input : $setting->default );
        }

        /**
         * Sanitize HEX Color
         *
         * @param  string $color Color code in HEX format.
         * @return mixed        Return valid color code.
         */
        public static function _sanitize_hex_color( $color ) 
        {

            if ('' === $color ) {
                return '';
            }

            // 3 or 6 hex digits, or the empty string.
            if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color) ) {
                return $color;
            }

            return '';
        }
    }

endif;
