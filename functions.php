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
define( 'BHARI_VERSION', '1.0.4.9' );
define( 'BHARI_URI', get_template_directory_uri() );
define( 'BHARI_DIR', get_template_directory() );
define( 'BHARI_SUPPORT_FONTAWESOME', true );
define( 'BHARI_POSTMETA_SUPPORT_AUTHOR_IMAGE', true );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'bhari_setup' ) ) :

	/**
	 * Bhari setup
	 */
	function bhari_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bhari, use a find and replace
		 * to change 'bhari' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bhari' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Indicate widget sidebars can use selective refresh in the Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
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
		register_nav_menus(
			array(
			'primary' => esc_html__( 'Primary', 'bhari' ),
			)
		);

		/*
            * Switch default core markup for search form, comment form, and comments
            * to output valid HTML5.
            */
		add_theme_support(
			'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'bhari_custom_background_args', array(
				'default-color' => 'f1f1f1',
				'default-image' => '',
				)
			)
		);

		// Added editor style support.
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
		add_theme_support(
			'starter-content', array(
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
			)
		);

		/**
		 * Enable support for custom logo.
		 *
		 * @since 1.0.4.8
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-height' => true,
		) );
	}

	add_action( 'after_setup_theme', 'bhari_setup' );

endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( ! function_exists( 'bhari_widgets_init' ) ) :

	/**
	 * Bhari Widgets
	 */
	function bhari_widgets_init() {
		register_sidebar(
			array(
			'name'          => esc_html__( 'Right Sidebar', 'bhari' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bhari' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
			'name'          => esc_html__( 'Left Sidebar', 'bhari' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'bhari' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			)
		);
	}
	add_action( 'widgets_init', 'bhari_widgets_init' );
endif;

/**
 * Generate asset URL depend on RTL & SCRIPT_DEBUG.
 *
 * E.g. For request bhari_asset_url( 'editor-style', 'css' );
 * Load one of the below file depends on RTL & SCRIPTS_DEBUG check.
 *
 * NOTE: RTL support is now just for ONLY theme style.css file.
 *
 *    style.min.css         Load normally.
 *    style.min-rtl.css     Load if RTL is on.
 *
 *    style.css             Load if SCRIPT_DEBUG is true.
 *    style-rtl.css         Load if SCRIPT_DEBUG & RTL are true.
 */

if ( ! function_exists( 'bhari_asset_url' ) ) :

	/**
	 * Generate asset URL depend on RTL & SCRIPT_DEBUG.
	 *
	 * How to use?
	 *
	 * @param  string  $file_name       Asset ( CSS / JS ) file name.
	 * @param  string  $type            Asset type either CSS or JS.
	 * @param  boolean $has_rtl_support Use argument for RTL support.
	 * @param  boolean $dir_path        Use argument for loading admin assets.
	 * @return string            URL of asset depend on RTL & SCRIPT_DEBUG.
	 */
	function bhari_asset_url( $file_name = '', $type = '', $has_rtl_support = false, $dir_path = '' ) {

		/**
		 * Load admin assets
		 */
		switch ( $dir_path ) {
			case 'vendor':
				$unmin_url     = '/assets/vendor/' . $type . '/' . $file_name . '.' . $type;
				$min_url       = '/assets/vendor/' . $type . '/' . $file_name . '.min.' . $type;
				$unmin_url_rtl = '/assets/vendor/' . $type . '/rtl/' . $file_name . '-rtl.' . $type;
				$min_url_rtl   = '/assets/vendor/' . $type . '/rtl/' . $file_name . '-rtl.min.' . $type;
			break;
			case 'admin':
				$unmin_url     = '/inc/assets/' . $type . '/' . $file_name . '.' . $type;
				$min_url       = '/inc/assets/' . $type . '/min/' . $file_name . '.min.' . $type;
				$unmin_url_rtl = '/inc/assets/' . $type . '/rtl/' . $file_name . '-rtl.' . $type;
				$min_url_rtl   = '/inc/assets/' . $type . '/min/rtl/' . $file_name . '-rtl.min.' . $type;
			break;
			default:
				$unmin_url     = '/assets/' . $type . '/' . $file_name . '.' . $type;
				$min_url       = '/assets/' . $type . '/min/' . $file_name . '.min.' . $type;
				$unmin_url_rtl = '/assets/' . $type . '/rtl/' . $file_name . '-rtl.' . $type;
				$min_url_rtl   = '/assets/' . $type . '/min/rtl/' . $file_name . '-rtl.min.' . $type;
			break;
		}

		// Load unminified assets.
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {

			$asset_url = $unmin_url; // Load unminified assets.

			if ( $has_rtl_support && is_rtl() ) {
				$asset_url = $unmin_url_rtl; // Load unminified RTL assets.
			}

			// Load minified assets.
		} else {

			$asset_url = $min_url; // Load minified assets.

			if ( $has_rtl_support && is_rtl() ) {
				$asset_url = $min_url_rtl; // Load minified RTL assets.
			}
		}

		return BHARI_URI . $asset_url;
	}
endif;

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'bhari_scripts' ) ) :

	/**
	 * Bhari Scripts
	 */
	function bhari_scripts() {

		/**
		 * Theme Assets
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Unminified & Individual files.
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {

			// CSS.
			wp_enqueue_style( 'bhari-core-css', get_stylesheet_uri() );
			wp_style_add_data( 'bhari-core-css', 'rtl', 'replace' );

			// JS.
			wp_enqueue_script( 'bhari-navigation', BHARI_URI . '/assets/js/navigation.js', array( 'jquery' ), BHARI_VERSION, true );
			wp_enqueue_script( 'bhari-skip-link-focus-fix', BHARI_URI . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), BHARI_VERSION, true );

			// Minified & Combined single files.
		} else {

			// CSS.
			if ( is_rtl() ) {
				wp_enqueue_style( 'bhari-core-css', BHARI_URI . '/assets/css/min/rtl/style.min-rtl.css' );
			} else {
				wp_enqueue_style( 'bhari-core-css', BHARI_URI . '/assets/css/min/style.min.css' );
			}

			// JS.
			wp_enqueue_script( 'bhari-core-js', BHARI_URI . '/assets/js/min/style.min.js', array( 'jquery' ), array( 'jquery' ), BHARI_VERSION, true );
		}

		/**
		 * External assets.
		 */
		if ( BHARI_SUPPORT_FONTAWESOME ) {
			wp_enqueue_style( 'font-awesome', bhari_asset_url( 'font-awesome', 'css', '', 'vendor' ) );
		}
	}
	add_action( 'wp_enqueue_scripts', 'bhari_scripts' );

endif;

/**
 * Theme Hook Alliance hook stub list.
 */
require BHARI_DIR . '/inc/hooks.php';

/**
 * Implement the Custom Header feature.
 */
require BHARI_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require BHARI_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require BHARI_DIR . '/inc/extras.php';

/**
 * Customizer additions.
 */
require BHARI_DIR . '/inc/customizer/customizer.php';

/**
 * Load compatibility files for 3rd party plugins.
 */
require BHARI_DIR . '/inc/compatibility/jetpack.php';
