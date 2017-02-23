/**
 * Customizer Control: Bhari Range Slider
 *
 * @since  1.0.0
 *
 * => Useful JS trigger:
 *
 * jQuery('body').on( 'customize-control-bhari-range-slider-click', function() { console.log( 'clicked: ' ); } );
 * jQuery('body').on( 'customize-control-bhari-range-slider-slide', function() { console.log( 'slideed: ' ); } );
 * jQuery('body').on( 'customize-control-bhari-range-slider-change', function() { console.log( 'changeed: ' ); } );
 *
 * @package Bhari
 */

/**
 * Control Constructor
 */
( function( $, api ) {
	api.controlConstructor['bhari-range-slider'] = api.Control.extend( {
		ready: function() {
			var control = this;
			$( '.bhari-control-slider-input', control.container ).on( 'change keyup',
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );

} )( jQuery, wp.customize );

/**
 * Window load
 */
jQuery( window ).load(function(){

	/**
	 * Range Slider
	 */
	jQuery( '.customize-control-bhari-range-slider' ).each(function(index, el) {

		var range_Control = jQuery( el ),
			range_Input   = range_Control.find( '.bhari-control-slider-input' ),
			range_Slider  = range_Control.find( '.slider' ),
			range_Default = range_Control.find( '.bhari-control-slider-default-val' ),
			range_Min     = parseFloat( range_Slider.attr( 'data-min' ) ) || 0,
			range_Max     = parseFloat( range_Slider.attr( 'data-max' ) ) || 9999,
			range_Step    = parseFloat( range_Slider.attr( 'data-step' ) ) || 1;

		/**
		 * Slider initialize
		 */
		range_Slider.slider( {
			value: range_Input.val(),
			min: range_Min,
			max: range_Max,
			step: range_Step,
			slide: function( event, ui ) {
				range_Input.val( ui.value ).change();
				range_Input.val( ui.value );

				// Added trigger on 'slide'.
				jQuery( 'body' ).trigger( 'customize-control-bhari-range-slider-slide' );
			}
		} );

		/**
		 * Slider input change
		 */
		range_Input.change(function () {
			var current_value = this.value || '';
			range_Slider.slider( 'value', parseFloat( current_value ) );

			// Added trigger on 'change'.
			jQuery( 'body' ).trigger( 'customize-control-bhari-range-slider-change' );
		});

		/**
		 * Slider reset default value
		 */
		range_Default.on( 'click', function(e) {
			e.preventDefault();
			var default_value = jQuery( this ).data( 'default-value' ) || '';
			range_Input.attr( 'value', parseFloat( default_value ) ).trigger( 'change' );

			// Added trigger on 'click'.
			jQuery( 'body' ).trigger( 'customize-control-bhari-range-slider-click' );

			return false;
		});
	});

});
