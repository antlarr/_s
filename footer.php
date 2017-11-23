<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ankh-Morpork
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
                        &#169; <?php echo date("Y") . ' ' . get_bloginfo( 'name' ) ?>
                        <span class="sep"> • </span>
			Powered by <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ankh-morpork' ) ); ?>">WordPress</a> and <a href="<?php echo esc_url( __( 'https://github.com/antlarr/ankh-morpork/', 'ankh-morpork' ) ); ?>">Ankh-Morpork</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
