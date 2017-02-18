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
			'tag'      => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-tag"></i>' : '',
			'category' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-folder"></i>' : '',
			'date'     => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-calendar"></i>' : '',
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
			'meta-seperator' => '<span class="sep">/</span>',
			'meta' => array(
				'author' => array(
					'before' => ( BHARI_POSTMETA_SUPPORT_AUTHOR_IMAGE ) ? get_avatar( esc_url( get_the_author_meta( 'ID' ) ), 20 ) : '<span class="label">' . __( 'By ', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'date' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-calendar"></i> ' : '<span class="label">' . __( 'On ', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'category' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-folder"></i> ' : '<span class="label">' . __( 'Categories ', 'bhari' ) . '</span>',
					'after'  => '',
				),
				'tag' => array(
					'before' => ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-tags"></i> ' : '<span class="label">' . __( 'Tags ', 'bhari' ) . '</span>',
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
					$meta_author .= '<span class="byline">';
					$meta_author .= $byline;
					$meta_author .= '</span>';
					$meta_author .= $meta_args['meta']['author']['after'];
					$meta_data['author'] = $meta_author;
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
					$meta_date .= '<span class="posted-on">';
					$meta_date .= $posted_on;
					$meta_date .= '</span>'; // WPCS: XSS OK.
					$meta_date .= $meta_args['meta']['date']['after'];
					$meta_data['date'] = $meta_date;
				break;

				/**
				 * Category meta
				 *
				 * Translators: used between list items, there is a space after the comma.
				 */
				case 'category':
					$categories_list = get_the_category_list( esc_html__( ', ', 'bhari' ) );
					if ( $categories_list && bhari_categorized_blog() ) {
						$meta_category         = $meta_args['meta']['category']['before'];
						$meta_category         .= sprintf( '<span class="cat-links"> ' . esc_html__( '%1$s ', 'bhari' ) . '</span>', $categories_list ); // WPCS: XSS OK.
						$meta_category         .= $meta_args['meta']['category']['after'];
						$meta_data['category'] = $meta_category;
					}
				break;

				/**
				 * Tags meta
				 *
				 * Translators: used between list items, there is a space after the comma.
				 */
				case 'tags':
						$tags_list = get_the_tag_list( '', esc_html__( ', ', 'bhari' ) );
					if ( $tags_list ) {
						$meta_tags        = $meta_args['meta']['tag']['before'];
						$meta_tags        .= sprintf( '<span class="tags-links"> ' . esc_html__( '%1$s ', 'bhari' ) . '</span>', $tags_list ); // WPCS: XSS OK.
						$meta_tags        .= $meta_args['meta']['tag']['after'];
						$meta_data['tag'] = $meta_tags;
					}
				break;
			}
		}

		if ( $echo ) {

			echo $before;
			echo join( $meta_args['meta-seperator'], $meta_data );

			/**
			 * Edit link
			 */
			$edit_icon = ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-edit"></i> ' : '';
			$edit_icon = $meta_args['meta-seperator'] . $edit_icon;
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'bhari' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">' . $edit_icon,
				'</span>'
			);

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
			echo '<span class="comments-link"> <i class="fa fa-comments"></i> ';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bhari' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		/**
		 * Edit link
		 */
		$edit_icon = ( BHARI_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-edit"></i> ' : '';
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'bhari' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">' . $edit_icon,
			'</span>'
		);
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
