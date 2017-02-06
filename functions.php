<?php

/**
 * Bhari functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bhari
 */

/**
 * Define constants
 */
define( 'BHARI_SUPPORT_FONTAWESOME', false );
define( 'BHARI_POSTMETA_SUPPORT_AUTHOR_IMAGE', true );

/**
 * Replacement for print_r & var_dump.
 *
 * @param mixed $var
 * @param bool $dump. (default: false)
 */
if ( ! function_exists( 'vl' ) ) {

    function vl( $var, $dump = 0 ) {
        ?>

        <style type="text/css">
            .vl_pre {
                text-align: left;
                margin: 30px 15px;
                padding: 1em;
                border: 0px;
                outline: 0px;
                font-size: 14px;
                font-family: monospace;
                vertical-align: baseline;
                max-width: 100%;
                overflow: auto;
                color: rgb(248,248,242);
                direction: ltr;
                word-spacing: normal;
                line-height: 1.5;
                border-radius: 0.3em;
                word-wrap: normal;
                letter-spacing: 0.266667px;
                background: rgb(61,69,75);
            }
        </style>

        <?php
        
        echo "<pre class='vl_pre'><xmp>";
        if ( true == $dump ) {
            var_dump( $var );
        } else {

            if ( is_array( $var ) || is_object( $var ) ) {
                print_r( $var );
            } else {
                echo $var;
            }

        }
        echo "</xmp></pre>";
    }
    
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'bhari_setup' ) ) :
	function bhari_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bhari, use a find and replace
		 * to change 'bhari' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bhari', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Indicate widget sidebars can use selective refresh in the Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'bhari' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bhari_custom_background_args', array(
			'default-color' => 'f1f1f1',
			'default-image' => '',
		) ) );

		//	Added editor style support
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		$GLOBALS['content_width'] = apply_filters( 'bhari_content_width', 640 );

		/**
		 * Added starter content
		 */
		add_theme_support( 'starter-content', array(

			'widgets' => array(
				'sidebar-1' => array(
					'search',
					'recent-posts',
					'recent-comments',
					'archives',
					'categories',
					'meta',
				),
				'sidebar-2' => array(
					'text_about',
					'calendar',
					'text_business_info',
				),
			),

			// 'posts' => array(
			// 	'home',
			// 	'about' => array(
			// 		'thumbnail' => '{{image-sandwich}}',
			// 	),
			// 	'contact' => array(
			// 		'thumbnail' => '{{image-espresso}}',
			// 	),
			// 	'blog' => array(
			// 		'thumbnail' => '{{image-coffee}}',
			// 	),
			// 	'homepage-section' => array(
			// 		'thumbnail' => '{{image-espresso}}',
			// 	),
			// ),

			// 'attachments' => array(
			// 	'image-espresso' => array(
			// 		'post_title' => _x( 'Espresso', 'Theme starter content', 'bhari' ),
			// 		'file' => 'assets/images/espresso.jpg',
			// 	),
			// 	'image-sandwich' => array(
			// 		'post_title' => _x( 'Sandwich', 'Theme starter content', 'bhari' ),
			// 		'file' => 'assets/images/sandwich.jpg',
			// 	),
			// 	'image-coffee' => array(
			// 		'post_title' => _x( 'Coffee', 'Theme starter content', 'bhari' ),
			// 		'file' => 'assets/images/coffee.jpg',
			// 	),
			// ),

			// 'options' => array(
			// 	'show_on_front' => 'page',
			// 	'page_on_front' => '{{home}}',
			// 	'page_for_posts' => '{{blog}}',
			// ),

			// 'theme_mods' => array(
			// 	'panel_1' => '{{homepage-section}}',
			// 	'panel_2' => '{{about}}',
			// 	'panel_3' => '{{blog}}',
			// 	'panel_4' => '{{contact}}',
			// ),

			// 'nav_menus' => array(
			// 	'top' => array(
			// 		'name' => __( 'Top Menu', 'bhari' ),
			// 		'items' => array(
			// 			'page_home',
			// 			'page_about',
			// 			'page_blog',
			// 			'page_contact',
			// 		),
			// 	),
			// 	'social' => array(
			// 		'name' => __( 'Social Links Menu', 'bhari' ),
			// 		'items' => array(
			// 			'link_yelp',
			// 			'link_facebook',
			// 			'link_twitter',
			// 			'link_instagram',
			// 			'link_email',
			// 		),
			// 	),
			// ),
		) );
	}

	add_action( 'after_setup_theme', 'bhari_setup' );

endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if( ! function_exists('bhari_widgets_init') ) :
	function bhari_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'bhari' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bhari' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'bhari' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'bhari' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	add_action( 'widgets_init', 'bhari_widgets_init' );
endif;

/**
 * Enqueue scripts and styles.
 */
if( ! function_exists('bhari_scripts') ) :
	function bhari_scripts() {

		/**
		 * Minified
		 */
		if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			wp_enqueue_style( 'bhari-core-css', get_stylesheet_uri() );
			wp_enqueue_script( 'bhari-navigation', get_template_directory_uri() . '/assets/unminified/js/navigation.js', array(), '20151215', true );
			wp_enqueue_script( 'bhari-skip-link-focus-fix', get_template_directory_uri() . '/assets/unminified/js/skip-link-focus-fix.js', array(), '20151215', true );

			if( BHARI_SUPPORT_FONTAWESOME ) {
				wp_enqueue_style( 'bhari-font-awesome', get_template_directory_uri() . '/assets/unminified/css/font-awesome.css' );
			}

		/**
		 * Minified + Combined
		 */
		} else {
			wp_enqueue_style( 'bhari-core-css', get_template_directory_uri() . '/assets/minified/css/bhari.min.css' );
			wp_enqueue_script( 'bhari-core-js', get_template_directory_uri() . '/assets/minified/js/bhari.min.js', array(), '20151215', true );

			if( BHARI_SUPPORT_FONTAWESOME ) {
				wp_enqueue_style( 'bhari-font-awesome', get_template_directory_uri() . '/assets/minified/css/font-awesome.min.css' );
			}
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'bhari_scripts' );
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';