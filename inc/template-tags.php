<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ankh-Morpork
 */

if ( ! function_exists( 'ankh_morpork_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function ankh_morpork_posted_on() {
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

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'ankh-morpork' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'ankh-morpork' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'ankh_morpork_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ankh_morpork_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( '</li><li class="category">' );
			if ( $categories_list ) {
			    $categories_list = '<li class="category">' . $categories_list . '</li>';
				printf( '<span class="cat-links"><img src="' . get_template_directory_uri() . '/images/folder.png" class="cat-links"><ul class="cat-links">%1$s</ul></span>', $categories_list ); // WPCS: XSS OK.
			}

			$tags_list = get_the_tag_list( '', '</li><li class="tag">' );
			if ( $tags_list ) {
		        $tags_list = '<li class="tag">' . $tags_list . '</li>';
				printf( '<span class="tags-links"><img src="' . get_template_directory_uri() . '/images/tag.png" class="tags-links"><ul class="tags-links">%1$s</ul></span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
                        if ( get_comments_number() > 1 ) {
                                echo '<img src="' . get_template_directory_uri() . '/images/comments-more.png" class="comments-link">';
                        } else {
                                echo '<img src="' . get_template_directory_uri() . '/images/comments-one.png" class="comments-link">';
                        }
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ankh-morpork' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ankh-morpork' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><img src="' . get_template_directory_uri() . '/images/edit.png" class="edit-link">',
			'</span>'
		);
	}
endif;
