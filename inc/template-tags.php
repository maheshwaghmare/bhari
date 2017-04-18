<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bhari
 */

/**
 * Get sidebar for single page
 */
if ( ! function_exists( 'bhari_get_sidebar_page' ) ) :

	/**
	 * Get sidebar for single page, custom post type etc.
	 *
	 * @see bhari_get_sidebar_layout()
	 * @see bhari_get_option()
	 */
	function bhari_get_sidebar_page() {
		bhari_get_sidebar_layout( bhari_get_option( 'sidebar-page' ) );
	}

endif;

/**
 * Get sidebar for single post
 */
if ( ! function_exists( 'bhari_get_sidebar_single' ) ) :

	/**
	 * Get sidebar for single post only.
	 *
	 * @see bhari_get_sidebar_layout()
	 * @see bhari_get_option()
	 */
	function bhari_get_sidebar_single() {
		bhari_get_sidebar_layout( bhari_get_option( 'sidebar-single' ) );
	}

endif;

/**
 * Get sidebar for archive pages
 */
if ( ! function_exists( 'bhari_get_sidebar_archive' ) ) :

	/**
	 * Get sidebar for archive pages ( tag, category, date ) and search page.
	 *
	 * @see bhari_get_sidebar_layout()
	 * @see bhari_get_option()
	 */
	function bhari_get_sidebar_archive() {
		bhari_get_sidebar_layout( bhari_get_option( 'sidebar-archive' ) );
	}

endif;

/**
 * Archive Title
 */
if ( ! function_exists( 'bhari_the_archive_title' ) ) :

	/**
	 * Archive Title
	 */
	function bhari_the_archive_title() {

		$icons = array(
			'tag'      => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-tag" aria-hidden="true"></i>' : '',
			'category' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-folder" aria-hidden="true"></i>' : '',
			'date'     => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-calendar" aria-hidden="true"></i>' : '',
			'author'   => ( BHARI_POSTMETA_SUPPORT_AUTHOR_IMAGE ) ? get_avatar( esc_url( get_the_author_meta( 'ID' ) ), 50 ) : '',
		);

		if ( is_tag() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['tag'], '</h1>' );
		} elseif ( is_category() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['tag'], '</h1>' );
		} elseif ( is_date() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['tag'], '</h1>' );
		} elseif ( is_author() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['author'], '</h1>' );
		} else {
			the_archive_title( '<h1 class="page-title">', '</h1>' );
		}
	}

endif;

/**
 * Show the post meta
 */
if ( ! function_exists( 'bhari_post_meta' ) ) :

	/**
	 * Show the post meta
	 *
	 * @param  array   $meta_list List of meta data ['author', 'category', 'date' and 'tag'].
	 * @param  string  $before    Wrapper html before meta markup.
	 * @param  string  $after     Wrapper html after meta markup.
	 * @param  boolean $echo      Is true the print markup else return.
	 * @return mixed 			array / html
	 */
	function bhari_post_meta( $meta_list = array(), $before = '', $after = '', $echo = true ) {

		$meta_data = array();
		$meta_args = apply_filters( 'bhari_post_meta_args', array(
			'meta-separator' => '<span class="sep">/</span>',
			'meta' => array(
				'author' => array(
					'before' => ( BHARI_POSTMETA_SUPPORT_AUTHOR_IMAGE ) ? get_avatar( esc_url( get_the_author_meta( 'ID' ) ), 20 ) : '<span class="label">' . _x( 'By ', 'Article written by', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'date' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-calendar" aria-hidden="true"></i> ' : '<span class="label">' . _x( 'On ', 'Article written on', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'category' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-folder" aria-hidden="true"></i> ' : '<span class="label">' . __( 'Categories ', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'tag' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-tags" aria-hidden="true"></i> ' : '<span class="label">' . __( 'Tags ', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'edit_link' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-edit" aria-hidden="true"></i> ' : '',
					'after'  => '',
				),
			),
		) );

		foreach ( $meta_list as $meta_item ) {

			switch ( $meta_item ) {

				/**
				 * Date Meta
				 */
				case 'author':

					$byline = sprintf( // WPCS: XSS OK.
						esc_html_x( '%s ', 'post author', 'bhari' ),
						'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
					);
					$meta_author  = $meta_args['meta']['author']['before'];
					$meta_author .= '<span class="byline">' . $byline . '</span>';
					$meta_author .= $meta_args['meta']['author']['after'];

					// Set author meta.
					$meta_data['author'] = '<span class="meta-author">' . $meta_author . '</span>';
				break;

				/**
				 * Publish Date Meta
				 */
				case 'date':

					$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
					if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
						$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
					}
					$time_string = sprintf( $time_string,
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() ),
						esc_attr( get_the_modified_date( 'c' ) ),
						esc_html( get_the_modified_date() )
					);

					$posted_on = sprintf( // WPCS: XSS OK.
						esc_html_x( '%s ', 'post date', 'bhari' ),
						'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
					);

					$meta_date  = $meta_args['meta']['date']['before'];
					$meta_date .= '<span class="posted-on">' . $posted_on . '</span>';
					$meta_date .= $meta_args['meta']['date']['after'];

					// Set date meta.
					$meta_data['date'] = '<span class="meta-date">' . $meta_date . '</span>';
				break;

				/**
				 * Category meta
				 *
				 * Translators: used between list items, there is a space after the comma.
				 */
				case 'category':

					$categories_list = get_the_category_list( esc_html__( ', ', 'bhari' ) );

					if ( $categories_list && bhari_categorized_blog() ) {

						$meta_category = $meta_args['meta']['category']['before'];
						$meta_category .= sprintf( '<span class="cat-links"> ' . esc_html__( '%1$s ', 'bhari' ) . '</span>', $categories_list ); // WPCS: XSS OK.
						$meta_category .= $meta_args['meta']['category']['after'];

						// Set category meta.
						$meta_data['category'] = '<span class="meta-category">' . $meta_category . '</span>';
					}

				break;

				/**
				 * Tags meta
				 *
				 * Translators: used between list items, there is a space after the comma.
				 */
				case 'tags':

					$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Comma separator for tags.', 'bhari' ) );

					if ( $tags_list ) {
						$meta_tags = $meta_args['meta']['tag']['before'];
						$meta_tags .= sprintf( '<span class="tags-links"> ' . esc_html_x( '%1$s ', 'Tag title.', 'bhari' ) . '</span>', $tags_list ); // WPCS: XSS OK.
						$meta_tags .= $meta_args['meta']['tag']['after'];

						// Set tag meta.
						$meta_data['tag'] = '<span class="meta-tag">' . $meta_tags . '</span>';
					}

				break;

				/**
				 * Edit Link
				 *
				 * Translators: used between list items, there is a space after the comma.
				 */
				case 'edit_link':

					if ( is_user_logged_in() ) {
						$meta_edits  = $meta_args['meta']['edit_link']['before'];

						$meta_edits .= '<span class="edit-link"><a href="' . esc_url( get_edit_post_link() ) . '" />';
						$meta_edits .= sprintf( wp_kses( __( 'Edit <span class="screen-reader-text">%s</span>', 'bhari' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() );
						$meta_edits .= '</span></a>';
						$meta_edits .= $meta_args['meta']['edit_link']['after'];

						// Set edit meta.
						$meta_data['edit_link'] = '<span class="meta-edit">' . $meta_edits . '</span>';
					}

				break;
			}
		}

		/**
		 * Echo / Return meta.
		 */
		if ( $echo ) {

			echo $before;

			echo join( $meta_args['meta-separator'], $meta_data );

			echo $after;

		} else {

			return $meta_data;
		}
	}

endif;

/**
 * Meta information
 */
if ( ! function_exists( 'bhari_entry_footer_contents' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bhari_entry_footer_contents() {

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			$edit_icon = ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-comments" aria-hidden="true"></i> ' : '';
			echo '<span class="comments-link"> ';
			echo $edit_icon;

			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bhari' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';

			// Separator.
			echo '<span class="sep">/</span>';

		}

		if ( 'post' === get_post_type() ) {

			/**
			 * Print post meta
			 *
			 * @see bhari_post_meta($meta_list, $before, $after)
			 */
			bhari_post_meta( array( 'tags', 'edit_link' ) );

		} else {

			/**
			 * Print post meta
			 *
			 * @see bhari_post_meta($meta_list, $before, $after)
			 */
			bhari_post_meta( array( 'edit_link' ) );
		}

	}
	add_action( 'bhari_entry_footer', 'bhari_entry_footer_contents' );

endif;

/**
 * Category blog
 */
if ( ! function_exists( 'bhari_categorized_blog' ) ) :

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function bhari_categorized_blog() {

		if ( false === ( $all_the_cool_cats = get_transient( 'bhari_categories' ) ) ) {

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'bhari_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so bhari_categorized_blog should return true.
			return true;

		} else {
			// This blog has only 1 category so bhari_categorized_blog should return false.
			return false;
		}
	}

endif;

/**
 * Flush out the transients
 */
if ( ! function_exists( 'bhari_category_transient_flusher' ) ) :

	/**
	 * Flush out the transients used in bhari_categorized_blog.
	 */
	function bhari_category_transient_flusher() {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Like, beat it. Dig?
		delete_transient( 'bhari_categories' );
	}
	add_action( 'edit_category', 'bhari_category_transient_flusher' );
	add_action( 'save_post',     'bhari_category_transient_flusher' );

endif;
