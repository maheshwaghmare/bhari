<?php
/**
 * Bhari Theme Customizer.
 *
 * @package Bhari
 */

/**
 * Set default options
 */
if (! function_exists('bhari_get_defaults') ) :

    /**
     * Set default options
     */
    function bhari_get_defaults() 
    {

        $bhari_defaults = array(

         /**
             * Container
             */
         'container-width-page'    => 1100,
         'container-width-single'  => 1100,
         'container-width-archive' => 1100,

         /**
             * Sidebar
             */
         'sidebar-page'    => 'layout-content-sidebar',
         'sidebar-single'  => 'layout-no-sidebar',
         'sidebar-archive' => 'layout-content-sidebar',
        );

        return apply_filters('bhari_theme_defaults', $bhari_defaults);
    }

endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
if (! function_exists('bhari_customize_register') ) :

    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     * @param object $wp_customize Theme Customizer object.
     */
    function bhari_customize_register( $wp_customize ) 
    {

        /**
         * Override defaults
         */
        $wp_customize->get_setting('blogname')->transport         = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
        $wp_customize->get_control('header_textcolor')->label     = __('Site Title & Tagline Color', 'bhari');
        $wp_customize->get_control('background_color')->label     = __('Body Background Color', 'bhari');

        /**
         * Get default's
         */
        $defaults = bhari_get_defaults();

        /**
         * Load customizer helper files
         */
        include_once BHARI_DIR . '/inc/customizer/customizer-callbacks.php';
        include_once BHARI_DIR . '/inc/customizer/customizer-sanitize.php';
        include_once BHARI_DIR . '/inc/customizer/customizer-controls.php';

        /**
         * Added custom customizer controls
         */
        if (method_exists($wp_customize, 'register_control_type') ) {
            $wp_customize->register_control_type('Bhari_Customize_Width_Slider_Control');
        }

        /**
         * Register Panel & Sections
         */
        if (class_exists('WP_Customize_Panel') ) :
            if (! $wp_customize->get_panel('bhari_panel_layout') ) {
                $wp_customize->add_panel(
                    'bhari_panel_layout', array(
                    'capability' => 'edit_theme_options',
                    'title'      => _x('Layout', 'Website Layout', 'bhari'),
                    'priority'   => 40,
                    )
                );
            }
        endif;

        $wp_customize->add_section(
            'bhari_section_container', array(
            'title'      => _x('Container', 'Website Container', 'bhari'),
            'capability' => 'edit_theme_options',
            'panel'      => 'bhari_panel_layout',
            )
        );

        $wp_customize->add_section(
            'bhari_sidebars', array(
            'title'      => __('Sidebars', 'bhari'),
            'capability' => 'edit_theme_options',
            'panel'      => 'bhari_panel_layout',
            )
        );

        /**
         * Register options
         */

        /**
         * Container Width - Archive
         */
        $wp_customize->add_setting(
            'bhari[container-width-archive]', array(
            'default'           => $defaults['container-width-archive'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Bhari_Customize_Sanitize', '_sanitize_integer' ),
            'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new Bhari_Customize_Width_Slider_Control(
                $wp_customize, 'bhari[container-width-archive]', array(
                'label'           => __('Archive', 'bhari'),
                'description'     => __('Container width for archive pages.', 'bhari'),
                'tooltip'         => __('Container width is applied for the blog, category, tag and custom post type archive pages.', 'bhari'),
                'section'         => 'bhari_section_container',
                'priority'        => 0,
                'type'            => 'bhari-range-slider',
                'active_callback' => array( 'Bhari_Customize_Callback', '_sidebar_archive' ),
                'default'         => $defaults['container-width-archive'],
                'unit'            => 'px',
                'min'             => 700,
                'max'             => 2000,
                'step'            => 5,
                'settings'        => 'bhari[container-width-archive]',
                )
            )
        );

        /**
         * Container Width - Single Post
         */
        $wp_customize->add_setting(
            'bhari[container-width-single]', array(
            'default'           => $defaults['container-width-single'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Bhari_Customize_Sanitize', '_sanitize_integer' ),
            'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new Bhari_Customize_Width_Slider_Control(
                $wp_customize, 'bhari[container-width-single]', array(
                'label'           => __('Single Post', 'bhari'),
                'description'     => __('Container width for the single post.', 'bhari'),
                'tooltip'         => __('Container width is applied for the single post.', 'bhari'),
                'section'         => 'bhari_section_container',
                'priority'        => 0,
                'type'            => 'bhari-range-slider',
                'default'         => $defaults['container-width-single'],
                'active_callback' => array( 'Bhari_Customize_Callback', '_sidebar_single' ),
                'unit'            => 'px',
                'min'             => 700,
                'max'             => 2000,
                'step'            => 5,
                'settings'        => 'bhari[container-width-single]',
                )
            )
        );

        /**
         * Container Width - Page
         */
        $wp_customize->add_setting(
            'bhari[container-width-page]', array(
            'default'           => $defaults['container-width-page'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Bhari_Customize_Sanitize', '_sanitize_integer' ),
            'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new Bhari_Customize_Width_Slider_Control(
                $wp_customize, 'bhari[container-width-page]', array(
                'label'           => __('Page', 'bhari'),
                'description'     => __('Container width for the page.', 'bhari'),
                'tooltip'         => __('Container width is applied for the pages.', 'bhari'),
                'active_callback' => array( 'Bhari_Customize_Callback', '_sidebar_page' ),
                'section'         => 'bhari_section_container',
                'priority'        => 0,
                'type'            => 'bhari-range-slider',
                'default'         => $defaults['container-width-page'],
                'unit'            => 'px',
                'min'             => 700,
                'max'             => 2000,
                'step'            => 5,
                'settings'        => 'bhari[container-width-page]',
                )
            )
        );

        /**
         * Sidebar - Archive
         */
        $wp_customize->add_setting(
            'bhari[sidebar-archive]', array(
            'default'           => $defaults['sidebar-archive'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Bhari_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'bhari[sidebar-archive]', array(
            'type'            => 'select',
            'label'           => __('Archive', 'bhari'),
            'description'     => __('Add sidebar layout for blog, archive, category tag pages.', 'bhari'),
            'section'         => 'bhari_sidebars',
            'active_callback' => array( 'Bhari_Customize_Callback', '_sidebar_archive' ),
            'choices'         => array(
            'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'bhari'),
            'layout-sidebar-content'         => __('Left Sidebar / Content', 'bhari'),
            'layout-content-sidebar'         => __('Content / Right Sidebar', 'bhari'),
            'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'bhari'),
            'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'bhari'),
            'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'bhari'),
            ),
            )
        );

        /**
         * Sidebar - Single Post
         */
        $wp_customize->add_setting(
            'bhari[sidebar-single]', array(
            'default'           => $defaults['sidebar-single'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Bhari_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'bhari[sidebar-single]', array(
            'type'            => 'select',
            'label'           => __('Single Post', 'bhari'),
            'description'     => __('Add sidebar layout for single post only.', 'bhari'),
            'section'         => 'bhari_sidebars',
            'active_callback' => array( 'Bhari_Customize_Callback', '_sidebar_single' ),
            'choices'         => array(
            'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'bhari'),
            'layout-sidebar-content'         => __('Left Sidebar / Content', 'bhari'),
            'layout-content-sidebar'         => __('Content / Right Sidebar', 'bhari'),
            'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'bhari'),
            'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'bhari'),
            'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'bhari'),
            ),
            )
        );

        /**
         * Sidebar - Page
         */
        $wp_customize->add_setting(
            'bhari[sidebar-page]', array(
            'default'           => $defaults['sidebar-page'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Bhari_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'bhari[sidebar-page]', array(
            'type'            => 'select',
            'label'           => __('Page', 'bhari'),
            'description'     => __('Add sidebar layout for pages only.', 'bhari'),
            'section'         => 'bhari_sidebars',
            'active_callback' => array( 'Bhari_Customize_Callback', '_sidebar_page' ),
            'choices'         => array(
            'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'bhari'),
            'layout-sidebar-content'         => __('Left Sidebar / Content', 'bhari'),
            'layout-content-sidebar'         => __('Content / Right Sidebar', 'bhari'),
            'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'bhari'),
            'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'bhari'),
            'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'bhari'),
            ),
            )
        );

    }
    add_action('customize_register', 'bhari_customize_register');
endif;

/**
 * Customizer Preview JS
 */
if (! function_exists('bhari_customize_preview_js') ) :

    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    function bhari_customize_preview_js() 
    {
        wp_enqueue_script('bhari-customizer-js', bhari_asset_url('customizer', 'js', '', 'admin'), array( 'customize-preview' ), '20151215', true);
    }
    add_action('customize_preview_init', 'bhari_customize_preview_js');

endif;

/**
 * Add CSS for our controls
 */
if (! function_exists('bhari_customizer_controls_css') ) :

    /**
     * Add CSS for our controls
     *
     * @since 1.0.0
     */
    function bhari_customizer_controls_css() 
    {
        wp_enqueue_style('bhari-customizer-controls-css', bhari_asset_url('customizer', 'css', '', 'admin'));
    }
    add_action('customize_controls_enqueue_scripts', 'bhari_customizer_controls_css');

endif;

/**
 * Generate Dynamic CSS
 */
if (! function_exists('bhari_dynamic_css') ) :

    /**
     * Generate Dynamic CSS from customizer option's
     */
    function bhari_dynamic_css() 
    {

        $space = ' ';

        // Generate CSS.
        $parse_css = array(

         '.error404 .site-content,
			 .page .site-content,
			 .error404 .custom-headers,
			 .page .custom-headers' => array(
        'max-width' => bhari_get_option('container-width-page') . 'px',
         ),

         '.archive .site-content,
			 .search .site-content,
			 .blog .site-content,
			 .archive .custom-headers,
			 .search .custom-headers,
			 .blog .custom-headers' => array(
        'max-width' => bhari_get_option('container-width-archive') . 'px',
         ),

         '.single .site-content,
			 .single .custom-headers' => array(
        'max-width' => bhari_get_option('container-width-single') . 'px',
         ),

        );

        // Output the above CSS.
        $output = '';

        foreach ( $parse_css as $selector => $properties ) {

            if (! count($properties) ) {
                continue;
            }

                  $temporary_output = $selector . ' {';
                  $elements_added   = 0;

            foreach ( $properties as $property => $css_value ) {
                if (empty($css_value) ) {
                    continue;
                }

                  $elements_added++;
                  $temporary_output .= $property . ': ' . $css_value . '; ';
            }

                  $temporary_output .= '}';

            if (0 < $elements_added ) {
                  $output .= $temporary_output;
            }
        }

        $output = str_replace(array( "\r", "\n", "\t" ), '', $output);

        wp_add_inline_style('bhari-core-css', esc_html($output));
    }
    add_action('wp_enqueue_scripts', 'bhari_dynamic_css');

endif;
