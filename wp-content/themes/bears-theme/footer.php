<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				<?php do_action( 'twentyeleven_credits' ); ?>
				Proudly sponsored by
				<p><a href="http://www.walkabout.eu.com/venues/walkabout-sheffield/" title="Walabout Sheffield"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bears-sponsors-walkabout.jpg" height=40 alt="Walkabout Sheffield"/></a></p>	<!-- <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), '<img src="http://www.sheffieldbears.com/images/wordpress-logo.jpg" height=40 alt="WordPress"/></a>' ); ?></a> -->
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
