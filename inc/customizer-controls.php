<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists('Bhari_Customize_Width_Slider_Control') ) :
/**
 *	Create our container width slider control
 */
class Bhari_Customize_Width_Slider_Control extends WP_Customize_Control
{
	// Setup control type
	public $type    = 'bhari-range-slider';
	public $id      = '';
	public $default = '';
	public $unit    = '';
	public $min     = 0;
	public $max     = 9999;
	public $step    = 1;
	public $tooltip = '';
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ]        = $this->get_link();
		$this->json[ 'value' ]       = $this->value();
		$this->json[ 'id' ]          = $this->id;
		$this->json[ 'default' ]     = $this->default;
		$this->json[ 'reset_title' ] = esc_attr__( 'Reset', 'bhari' );
		$this->json[ 'min']          = $this->min;
		$this->json[ 'max' ]         = $this->max;
		$this->json[ 'step' ]        = $this->step;
		$this->json[ 'unit' ]        = $this->unit;
		$this->json[ 'tooltip' ]     = $this->tooltip;
	}
	
	public function content_template() {
		?>
		<label>
			<p>
				<span class="customize-control-title"> {{ data.label }} </span>
				<span class="description customize-control-description">{{ data.description }} </span>
				<# if ( '' !== data.tooltip ) { #>
				<span class="customize-control-tooltip">
					<i class="dashicons dashicons-info" style="color: #b2b6ba;">
						<span class="tooltip">{{ data.tooltip }}</span>
					</i>
				</span>
				<# } #>
				<span class="value">
					<input name="{{ data.id }}" type="number" {{{ data.link }}} value="{{{ data.value }}}" class="bhari-control-slider-input" min="{{data.min}}" max="{{data.max}}" step="{{data.step}}" />
					<span class="unit">{{data.unit}}</span>
				</span>
			</p>
		</label>
		<div class="slider <# if ( '' !== data.default ) { #>show-reset<# } #>" data-min="<# if ( data.min ) { #>{{data.min}}<# } #>" data-max="<# if ( data.max ) { #>{{data.max}}<# } #>" data-step="<# if ( data.step ) { #>{{data.step}}<# } #>"></div>
		<# if ( '' !== data.default ) { #>
			<span title="{{ data.reset_title }}" class="bhari-control-slider-default-val" data-default-value="{{ data.default }}">
				<span class="dashicons dashicons-image-rotate" aria-hidden="true"></span>
				<span class="screen-reader-text">{{ data.reset_title }}</span>
			</span>
		<# } #>
		<?php
	}
	
	// Function to enqueue the right jquery scripts and styles
	public function enqueue() {

		if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			wp_enqueue_script( 'bhari-customizer-control-slider-js', get_template_directory_uri() . '/inc/assets/unminified/js/customizer-control-slider.js', array( 'jquery-ui-core', 'jquery-ui-slider', 'customize-controls' ) );
			wp_enqueue_style( 'bhari-customizer-control-slider-css', get_template_directory_uri() . '/inc/assets/unminified/css/customizer-control-slider.css');
			wp_enqueue_style('jquery-ui-slider', get_template_directory_uri() . '/inc/assets/unminified/css/jquery-ui-structure.css');
			wp_enqueue_style('jquery-ui-slider-theme', get_template_directory_uri() . '/inc/assets/unminified/css/jquery-ui-theme.css');
		} else {
			wp_enqueue_script( 'bhari-customizer-control-slider-js', get_template_directory_uri() . '/inc/assets/minified/js/customizer-control-slider.min.js', array( 'jquery-ui-core', 'jquery-ui-slider', 'customize-controls' ) );
			wp_enqueue_style( 'bhari-customizer-control-slider-css', get_template_directory_uri() . '/inc/assets/minified/css/customizer-control-slider.min.css');
			wp_enqueue_style('jquery-ui-slider', get_template_directory_uri() . '/inc/assets/minified/css/jquery-ui-structure.min.css');
			wp_enqueue_style('jquery-ui-slider-theme', get_template_directory_uri() . '/inc/assets/minified/css/jquery-ui-theme.min.css');
		}
	}
}
endif;