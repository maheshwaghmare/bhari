<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @package Bhari
 */

/**
 * Bhari_Hooks initial setup
 *
 * @since 1.0.0
 */
if( ! class_exists('Bhari_Hooks' ) ) {

	class Bhari_Hooks {

		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'wp_head', 			array( $this, 'head' ) );
			add_action( 'bhari_hook_header', 	array( $this, 'masthead' ) );
			add_action( 'bhari_hook_header', 	array( $this, 'header_image' ) );
			add_action( 'bhari_hook_footer', 	array( $this, 'footer' ) );

			add_action( 'bhari_hook_page_header', 	array( $this, 'page_header' ) );

		}

		function page_header() {
			if( is_404() ) :
			?>
			<header class="page-header">
				<h1 class="page-title">
					<?php if ( BHARI_SUPPORT_FONTAWESOME ) : ?>
						<i class="fa fa-window-close-o"></i>
					<?php endif; ?>
					<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bhari' ); ?>
				</h1>
			</header><!-- .page-header -->
			<?php
			endif;
			if( is_search() ) :
			?>
			<header class="page-header">
				<h1 class="page-title">
					<?php if ( BHARI_SUPPORT_FONTAWESOME ) : ?>
						<i class="fa fa-search"></i>
					<?php endif; ?>
					<?php printf( __( 'Search Results for: %s', 'bhari' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header><!-- .page-header -->
			<?php
			endif;
		}

		function footer() {
			?>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bhari' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'bhari' ), 'WordPress' ); ?></a>
					<span class="sep"> <?php _e( '|', 'bhari' ); ?> </span>
					<?php printf( esc_html__( 'Theme: %1$s', 'bhari' ), '<a href="http://maheshwaghmare.wordpress.com/" rel="designer">Bhari</a>' ); ?>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
			<?php
		}

		function head() {
			?>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php
		}

		function masthead() {
			?>
			<header id="masthead" class="site-header" role="banner">
			
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php $description = get_bloginfo( 'description', 'display' ); ?>
					<?php if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<?php if ( BHARI_SUPPORT_FONTAWESOME ) : ?>
							<i class="fa fa-reorder"></i>
						<?php endif; ?>
						<?php esc_html_e( 'Primary Menu', 'bhari' ); ?>
					</button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->

			</header><!-- #masthead -->
			<?php
		}

		function header_image() {
			?>
			<?php if ( get_header_image() ) : ?>
			<div class="custom-headers">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			</div>
			<?php endif; // End header image check. ?>
			<?php
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
$bhari_hooks = Bhari_Hooks::get_instance();



