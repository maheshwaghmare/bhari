<?php
/**
 * Feature Social Shares.
 *
 * Added social share links on single post. Locations in single post header & footer.
 * To disable social shares add filter `add_filter( 'bhari_social_shares', '__return_false' );`
 * In bhari child theme.
 * 
 * @package Bhari
 */

if( ! class_exists('Bhari_Social_Shares') ) :

	/**
	 * Bhari_Social_Shares initial setup
	 *
	 * @since 1.0.7
	 */
	class Bhari_Social_Shares {

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

			add_action( 'init', 	array( $this, 'social_shares' ) );

		}

		/**
		 * Social Shares
		 *
		 * @since 1.0.4.7
		 */
		function social_shares() {

			if( apply_filters( 'bhari_social_shares', true ) ) {
				add_action( 'wp_enqueue_scripts', 			array( $this, 'scripts' ) );
				add_action( 'bhari_pagination_before', 		array( $this, 'social_share_markup' ) );
				add_action( 'bhari_entry_header_bottom', 	array( $this, 'social_share_markup' ) );
			}

		}

		/**
		 * Enqueue Social Shares
		 *
		 * @since 1.0.4.7
		 */
		function scripts() {
			wp_enqueue_style( 'bhari-social-shares-css', BHARI_URI . '/assets/css/social-shares.css' );
		}

		/**
		 * Add Markup of Social Shares
		 *
		 * @since 1.0.4.7
		 */
		function social_share_markup() {

			if( is_single() ) {
				?>
				<div class="social-shares">
					<h3> <?php _e( 'Share', 'bhari' ); ?> </h3>
					<ul>
					    <li><a target="_blank" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() ); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
					    <li><a target="_blank" href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url='.get_the_permalink().'&text='.get_the_title().'&via='.site_url() ); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
					    <li><a target="_blank" href="<?php echo esc_url( 'https://plus.google.com/share?url='.get_the_permalink() ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
				<?php
			}
		}
	}
	
	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Bhari_Social_Shares::get_instance();

endif;