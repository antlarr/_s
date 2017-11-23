<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Ankh-Morpork
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function ankh_morpork_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ankh_morpork_infinite_scroll_render',
		'footer'    => 'page',
		'footer_callback' => 'ankh_morpork_custom_footer',
		'posts_per_page' => '3',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'ankh-morpork-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'ankh_morpork_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function ankh_morpork_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

function ankh_morpork_custom_footer() {
?>
    <div id="infinite-footer" style="bottom: 0px;">
                                <div class="blog-info">
                         &#169; <?php echo date("Y") . ' ' . get_bloginfo( 'name' ) ?>
                         <span class="sep"> • </span>
                        Powered by <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ankh-morpork' ) ); ?>">WordPress</a> and <a href="<?php echo esc_url( __( 'https://github.com/antlarr/ankh-m  orpork/', 'ankh-morpork' ) ); ?>">Ankh-Morpork</a>
                                </div>
                </div>
<?php
}
