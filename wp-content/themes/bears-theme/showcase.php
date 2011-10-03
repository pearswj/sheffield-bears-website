<?php
/**
 * Template Name: Homepage Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

// Enqueue showcase script for the slider
wp_enqueue_script( 'twentyeleven-showcase', get_stylesheet_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

get_header(); ?>

		<div id="primary" class="showcase">
			<div id="content" role="main">

				<?php the_post(); ?>

				<?php
					/**
					 * We are using a heading by rendering the_content
					 * If we have content for this page, let's display it.
					 */
					if ( '' != get_the_content() )
						get_template_part( 'content', 'intro' );
				?>

				<?php
					/**
					 * Begin the featured posts section.
					 *
					 * See if we have any sticky posts and use them to create our featured posts.
					 * We limit the featured posts at ten.
					 */
					$sticky = get_option( 'sticky_posts' );

					// Proceed only if sticky posts exist.
					if ( ! empty( $sticky ) ) :

					$featured_args = array(
						'post__in' => $sticky,
						'post_status' => 'publish',
						'posts_per_page' => 2,
						'no_found_rows' => true,
					);

					// The Featured Posts query.
					$featured = new WP_Query( $featured_args );

					// Proceed only if published posts exist
					if ( $featured->have_posts() ) :

					/**
					 * We will need to count featured posts starting from zero
					 * to create the slider navigation.
					 */
					$counter_slider = 0;

					?>
				<div id="announce">
					<?php
					while ( $featured->have_posts() ) : $featured->the_post();
					if ( ! has_post_thumbnail() ) {
					?>
						<h2 class="entry-title">Announcement: <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php
					}
					endwhile;
					?>
				</div>
				<div id="column1">
				<section class="featured-posts2 home-section">
					<div id="showcase-heading">
						<h1><?php _e( 'Featured News', 'twentyeleven' ); ?></h1>
					</div>

				<?php
					// Let's roll.
					while ( $featured->have_posts() ) : $featured->the_post();
					// Render only if post has featured image
					if ( has_post_thumbnail() ) {
					// Increase the counter.
					$counter_slider++;

					// Let's add some class for the featured image...
						$feature_class = 'feature-image small';

						/*// Hang on. Let's check this here image out.
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) );

						// Is it bigger than or equal to our header?
						if ( $image[1] >= HEADER_IMAGE_WIDTH ) {
							// If bigger, let's add a BIGGER class. It's EXTRA classy now.
							$feature_class = 'feature-image large';
						}*/
				?>

					<section class="featured-post <?php echo $feature_class; ?>" id="featured-post-<?php echo $counter_slider; ?>">

						<?php
							/**
							 * If the thumbnail is as big as the header image
							 * make it a large featured post, otherwise render it small
							 */
							/*if ( has_post_thumbnail() ) {
								if ( $image[1] >= HEADER_IMAGE_WIDTH )
									$thumbnail_size = 'large-feature';
								else*/
									//$thumbnail_size = 'small-feature';
									$thumbnail_size = 'custom-feature';
								?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
								<?php
							//}
						?>
						<?php get_template_part( 'content', 'featured' ); ?>
					</section>
				<?php }
					endwhile; ?>

				<?php
					// Show slider only if we have more than one featured post.
					//if ( $featured->post_count > 1 ) :
					if ( $counter_slider > 1 ) :
				?>
				<nav class="feature-slider">
					<ul>
					<?php

						// Reset the counter so that we end up with matching elements
				    	$counter_slider = 0;

						// Begin from zero
				    	rewind_posts();

						// Let's roll again.
				    	while ( $featured->have_posts() ) : $featured->the_post();
					// Again, only render slider for posts with a featured image...
					if ( has_post_thumbnail() ) {
				    		$counter_slider++;
							if ( 1 == $counter_slider )
								$class = 'class="active"';
							else
								$class = '';
				    	?>
						<li><a href="#featured-post-<?php echo $counter_slider; ?>" title="<?php printf( esc_attr__( 'Featured: %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $class; ?>></a></li>
					<?php }
						endwhile; ?>
					</ul>
				</nav>
				<?php endif; // End check for more than one sticky post. ?>
				</section><!-- .featured-posts -->
				<?php endif; // End check for published posts. ?>
				<?php endif; // End check for sticky posts. ?>

				<section class="games home-section">
					<div id="showcase-heading">
						<h1><?php _e( 'Latest Games', 'twentyeleven' ); ?></h1>
					</div>
					<!-- BUIHA -->
					<?php echo do_shortcode('[matches league_id=5 mode=home time=prev template=prev order="date DESC LIMIT 3"]'); ?>
					<?php echo do_shortcode('[matches league_id=5 mode=home time=next template=next order="date LIMIT 5"]'); ?>
				</section><!-- .games -->
				</div><!-- column1 -->
				<div id="column2">
				<section class="recent-posts2 home-section">
					<div id="showcase-heading">
						<h1><?php _e( 'Recent News', 'twentyeleven' ); ?></h1>
					</div>

					<?php

					// Display our recent posts, showing full content for the very latest, ignoring Aside posts.
					$recent_args = array(
						'order' => 'DESC',
						//'post__not_in' => get_option( 'sticky_posts' ),
						'ignore_sticky_posts' => 1,
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'terms' => array( 'post-format-aside', 'post-format-link', 'post-format-quote', 'post-format-status' ),
								'field' => 'slug',
								'operator' => 'NOT IN',
								'posts_per_page' => 6,
							),
						),
						'no_found_rows' => true,
					);

					// Our new query for the Recent Posts section.
					$recent = new WP_Query( $recent_args );

				/*	// The first Recent post is displayed normally
					if ( $recent->have_posts() ) : $recent->the_post();

						// Set $more to 0 in order to only get the first part of the post.
						global $more;
						$more = 0;

						get_template_part( 'content', get_post_format() );	*/

						echo '<ol class="other-recent-posts">';

					//endif;

					// For all other recent posts, just display the title and comment status.
					while ( $recent->have_posts() ) : $recent->the_post(); ?>

						<li>
						<!--	<h1 class="entry-date"><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_time('d M'); ?></a></h1> -->
							<!--h2 class="entry-date"><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_date(); ?></a></h2-->
							<h2 class="entry-title"><?php the_category(' '); ?>// <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<!-- <span class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentyeleven' ) . '</span>', __( '<b>1</b> Reply', 'twentyeleven' ), __( '<b>%</b> Replies', 'twentyeleven' ) ); ?>
							</span> -->
						</li>

					<?php
					endwhile;

					// If we had some posts, close the <ol>
					if ( $recent->post_count > 0 )
						echo '</ol>';
					?>
				</section><!-- .recent-posts -->

				<section class="bears-twitter home-section">
					<div id="showcase-heading">
						<h1><?php _e( 'Bears On Twitter', 'twentyeleven' ); ?></h1>
					</div>
						<script src="http://widgets.twimg.com/j/2/widget.js"></script>
						<script>
							new TWTR.Widget({
							  version: 2,
							  type: 'profile',
							   rpp: 5,
							   interval: 6000,
							   width: 250,
							   height: 300,
							   theme: {
							     shell: {
							       background: 'none',
							       color: '#fff'
							     },
							     tweets: {
							       background: 'none',
							       color: '#ddd',
							       links: '#ffea00'
							     }
							   },
							   features: {
							     scrollbar: false,
							     loop: false,
							     live: false,
							     hashtags: true,
							     timestamp: true,
							     avatars: false,
							     behavior: 'all'
							   }
							 }).render().setUser('SheffieldBears').start();
						</script>
					<div id="blanker"></div>
				</section><!-- .bears-twitter -->
				</div><!-- column2 -->
				<!-- <div class="widget-area" role="complementary">
					<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

						<?php
						the_widget( 'Twenty_Eleven_Ephemera_Widget', '', array( 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
						?>

					<?php endif; // end sidebar widget area ?>
				</div> --><!-- .widget-area -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php //get_sidebar('recent'); ?>
<?php //get_sidebar('two'); ?>
<?php get_footer(); ?>
