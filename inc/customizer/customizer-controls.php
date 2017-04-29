<?php
/**
 * Bhari Customizer Controls
 *
 * @package Bhari
 */

// No direct access, please.
if (! defined('ABSPATH') ) {
    exit;
}

/**
 * Slider Control
 */
if (class_exists('WP_Customize_Control') && ! class_exists('Bhari_Customize_Width_Slider_Control') ) :

    /**
     * Customizer Slider Control
     */
    class Bhari_Customize_Width_Slider_Control extends WP_Customize_Control
    {


        /**
         * Type
         *
         * @var string
         */
        public $type = 'bhari-range-slider';

        /**
         * ID
         *
         * @var string
         */
        public $id = '';

        /**
         * Default
         *
         * @var string
         */
        public $default = '';

        /**
         * Unit
         *
         * @var string
         */
        public $unit = '';

        /**
         * Min
         *
         * @var integer
         */
        public $min     = 0;

        /**
         * Max
         *
         * @var integer
         */
        public $max = 9999;

        /**
         * Step
         *
         * @var integer
         */
        public $step = 1;

        /**
         * Tooltip
         *
         * @var string
         */
        public $tooltip = '';

        /**
         * Convert options in JSON
         */
        public function to_json() 
        {

            parent::to_json();
            $this->json['id']          = $this->id;
            $this->json['min']         = $this->min;
            $this->json['max']         = $this->max;
            $this->json['step']        = $this->step;
            $this->json['unit']        = $this->unit;
            $this->json['link']        = $this->get_link();
            $this->json['value']       = $this->value();
            $this->json['default']     = $this->default;
            $this->json['tooltip']     = $this->tooltip;
            $this->json['reset_title'] = esc_attr_x('Reset', 'Reset the slider customizer control value.', 'bhari');
        }

        /**
         * Content Template
         */
        public function content_template() 
        {
            ?>
            <label>
            <p>
       <span class="customize-control-title"> {{ data.label }} </span>
       <span class="description customize-control-description">{{ data.description }} </span>
       <# if ( '' !== data.tooltip ) { #>
       <span class="customize-control-tooltip">
           <i class="dashicons dashicons-info" style="color: #b2b6ba;" aria-hidden="true">
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

        /**
         * Control assets
         */
        public function enqueue() 
        {
            wp_enqueue_script('bhari-customizer-control-slider-js', bhari_asset_url('customizer-control-slider', 'js', '', 'admin'), array( 'jquery-ui-core', 'jquery-ui-slider', 'customize-controls' ));
            wp_enqueue_style('bhari-customizer-control-slider-css', bhari_asset_url('customizer-control-slider', 'css', '', 'admin'));
            wp_enqueue_style('jquery-ui-slider', bhari_asset_url('jquery-ui-structure', 'css', '', 'admin'));
            wp_enqueue_style('jquery-ui-slider-theme', bhari_asset_url('jquery-ui-theme', 'css', '', 'admin'));
        }
    }
endif;
