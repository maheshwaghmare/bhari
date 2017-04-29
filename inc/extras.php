<?php
/**
 * Custom functions that act independently of the theme templates.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bhari
 */

/**
 * Add sidebars
 */
if (! function_exists('bhari_get_sidebar_layout') ) :

    /**
     * Get Sidebar Layout
     *
     * @param string $layout Sidebar layout.
     */
    function bhari_get_sidebar_layout( $layout ) 
    {

        switch ( $layout ) {

        case 'layout-sidebar-content' :
            get_sidebar('left');
            break;

        case 'layout-content-sidebar' :
            get_sidebar(); // Default is right sidebar.
            break;

        case 'layout-content-sidebar-sidebar' :
        case 'layout-sidebar-content-sidebar' :
        case 'layout-sidebar-sidebar-content' :
            get_sidebar('left');
            get_sidebar(); // Default is right sidebar.
            break;
        }
    }

endif;

/**
 * Get individual option
 */
if (! function_exists('bhari_get_option') ) :

    /**
     * Get Theme Option
     *
     * @param  string $key      Customizer setting ID.
     * @param  string $defaults Default value for customizer setting.
     * @return mixed           Return the customizer setting stored value.
     */
    function bhari_get_option( $key = '', $defaults = '' ) 
    {
        $options = apply_filters(
            'bhari_theme_defaults_after_parse_args', wp_parse_args(
                get_option('bhari', true),
                bhari_get_defaults()
            )
        );

        if (isset($options[ $key ]) ) {
               return $options[ $key ];
        } else {
              return $defaults;
        }
    }

endif;

/**
 * Add body classes
 */
if (! function_exists('bhari_body_class') ) :

    /**
     * Add body classes
     *
     * @param  array $classes List of classes.
     * @return array          List of classes.
     */
    function bhari_body_class( $classes ) 
    {

        if (is_home() || is_archive() || is_search() ) {
            $layout = bhari_get_option('sidebar-archive');
        } elseif (is_page() || is_404() ) {
            $layout = bhari_get_option('sidebar-page');
        } elseif (is_single() ) {
            $layout = bhari_get_option('sidebar-single');
        }

        switch ( $layout ) {

        case 'layout-sidebar-content' :         $classes[] = 'layout-sidebar-content';
            break;
        case 'layout-content-sidebar' :         $classes[] = 'layout-content-sidebar';
            break;
        case 'layout-content-sidebar-sidebar' :    $classes[] = 'layout-content-sidebar-sidebar';
            break;
        case 'layout-sidebar-content-sidebar' :    $classes[] = 'layout-sidebar-content-sidebar';
            break;
        case 'layout-sidebar-sidebar-content' : $classes[] = 'layout-sidebar-sidebar-content';
            break;
        case 'layout-no-sidebar' :
        default:
            $classes[] = 'layout-no-sidebar';
            break;
        }

        return $classes;
    }
    add_filter('body_class', 'bhari_body_class');

endif;

/**
 * Adds custom classes to the array of body classes.
 */
if (! function_exists('bhari_body_classes') ) :

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param  array $classes Classes for the body element.
     * @return array
     */
    function bhari_body_classes( $classes ) 
    {

        // Adds a class of group-blog to blogs with more than 1 published author.
        if (is_multi_author() ) {
            $classes[] = 'group-blog';
        }

        // Adds a class of hfeed to non-singular pages.
        if (! is_singular() ) {
            $classes[] = 'hfeed';
        }

        return $classes;
    }
    add_filter('body_class', 'bhari_body_classes');

endif;

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
if (! function_exists('bhari_pingback_header') ) :

    /**
     * Add a pingback url auto-discovery header for singularly identifiable articles.
     */
    function bhari_pingback_header() 
    {
        if (is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', bloginfo('pingback_url'), '">';
        }
    }
    add_action('wp_head', 'bhari_pingback_header');

endif;
