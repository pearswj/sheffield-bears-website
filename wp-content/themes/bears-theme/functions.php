<?php
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

		// image sizes:
		set_post_thumbnail_size( 451, 300, true );
		add_image_size( 'custom-feature', 451, 300, true );
	}

