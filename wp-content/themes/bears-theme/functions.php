<?php

/* override date format for posts */
/* (due to leaguemanager using date format set in dashboard) */

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'l, j F Y' ) ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'twentyeleven' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

add_action( 'after_setup_theme', 'my_child_theme_setup' );
	function my_child_theme_setup() {
		// We are providing our own filter for excerpt_length...
		remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
		function custom_excerpt_length( $length ) {
			return 33;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length' );

		// image sizes: (maybe these should go outside of this function?)
		set_post_thumbnail_size( 451, 300, true );
		add_image_size( 'custom-feature', 451, 300, true );
	}

/* header image size */

define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 751 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 180 ) );

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

/* add widget to dashboard */
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Using the Sheffield Bears website', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo "<p>Welcome to the Sheffield Bears website! For details on how to use a couple of the more bespoke features of the site, see below...</p>
      <h2>1. Featured Posts</h2>
      <p>To have a post show up in the 'Featured Posts' section, mark it as <b>sticky</b> and add a <b>featured image</b>.</p>
      <h2>2. Announcements</h2>
      <p>To have a post show up in the 'Announcements' section, mark it as <b>sticky</b> only.</p>";
}

?>
