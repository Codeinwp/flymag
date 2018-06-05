<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FlyMag
 */

if ( ! function_exists( 'flymag_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function flymag_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation clearfix" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'flymag' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous button"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'flymag' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next button"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'flymag' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'flymag_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function flymag_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation clearfix" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'flymag' ); ?></h1>
			<div class="nav-links">
				<?php
				previous_post_link( '<div class="nav-previous button">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'flymag' ) );
				next_post_link( '<div class="nav-next button">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'flymag' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'flymag_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function flymag_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			'<i class="fa fa-calendar"></i> %s',
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			'<i class="fa fa-user"></i> %s',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	}
endif;

if ( ! function_exists( 'flymag_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function flymag_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( __( ', ', 'flymag' ) );
			if ( $categories_list && flymag_categorized_blog() && get_theme_mod( 'flymag_single_cats' ) != 1 ) {
				echo '<i class="fa fa-folder"></i>&nbsp;<span class="cat-links">' . $categories_list . '</span>';
			}
			$tags_list = get_the_tag_list( '', __( ', ', 'flymag' ) );
			if ( $tags_list && is_single() && get_theme_mod( 'flymag_single_tags' ) != 1 ) {
				echo '<i class="fa fa-tags"></i>&nbsp;<span class="tags-links">' . $tags_list . '</span>';
			}
		}

		edit_post_link( __( 'Edit', 'flymag' ), '<span class="edit-link"><i class="fa fa-pencil"></i>&nbsp;', '</span>' );
	}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after Optional. Content to append to the title. Default empty.
	 */
	function the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			/* translators: archive category */
			$title = sprintf( __( 'Category: %s', 'flymag' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			/* translators: archive tag */
			$title = sprintf( __( 'Tag: %s', 'flymag' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			/* translators: archive author */
			$title = sprintf( __( 'Author: %s', 'flymag' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			/* translators: archive year */
			$title = sprintf( __( 'Year: %s', 'flymag' ), get_the_date( _x( 'Y', 'yearly archives date format', 'flymag' ) ) );
		} elseif ( is_month() ) {
			/* translators: archive month */
			$title = sprintf( __( 'Month: %s', 'flymag' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'flymag' ) ) );
		} elseif ( is_day() ) {
			/* translators: archive day */
			$title = sprintf( __( 'Day: %s', 'flymag' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'flymag' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'flymag' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'flymag' );
			}
		} elseif ( is_post_type_archive() ) {
			/* translators: archive title */
			$title = sprintf( __( 'Archives: %s', 'flymag' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'flymag' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'flymag' );
		}// End if().

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo $before . $description . $after;
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function flymag_categorized_blog() {
	$all_the_cool_cats = get_transient( 'flymag_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'flymag_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so flymag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so flymag_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in flymag_categorized_blog.
 */
function flymag_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'flymag_categories' );
}

add_action( 'edit_category', 'flymag_category_transient_flusher' );
add_action( 'save_post', 'flymag_category_transient_flusher' );
