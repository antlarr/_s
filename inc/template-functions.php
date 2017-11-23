<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Ankh-Morpork
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ankh_morpork_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ankh_morpork_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ankh_morpork_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ankh_morpork_pingback_header' );

function ankh_morpork_get_the_post_navigation( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'prev_text'          => '%title',
        'next_text'          => '%title',
        'in_same_term'       => false,
        'excluded_terms'     => '',
        'taxonomy'           => 'category',
        'screen_reader_text' => __( 'Post navigation' ),
    ) );

    $navigation = '';

    $previous = get_previous_post_link(
        '<div class="nav-previous">%link</div>',
        '<span class="nav-previous-arrow">&lt;</span>' . $args['prev_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );

    $next = get_next_post_link(
        '<div class="nav-next">%link</div>',
        $args['next_text'] . '<span class="nav-next-arrow">&gt;</span>',
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );

    // Only add markup if there's somewhere to navigate to.
    if ( $previous || $next ) {
        $navigation = _navigation_markup( $previous . $next, 'post-navigation', $args['screen_reader_text'] );
    }

    return $navigation;
}

function ankh_morpork_the_post_navigation() {
    echo ankh_morpork_get_the_post_navigation( $args );
}

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'loop_start', 'jptweak_remove_share' );


function ankh_morpork_synved_social_share_markup() {
    if (!function_exists('synved_social_share_markup'))
       return '';

    $params = array('message' => get_the_title());
    $buttons = array('facebook' => null,
                     'twitter' => null,
                     'google_plus' => null,
                     'reddit' => null,
/*                   'pinterest' => null,
                     'linkedin' => null,
                     'tumblr' => null,*/
                     'mail' => null
                    );

    return synved_social_share_markup($params, $buttons);
}

