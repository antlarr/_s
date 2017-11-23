<?php
/**
 * _s Theme Customizer
 *
 * @package Ankh-Morpork
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ankh_morpork_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'footer' )->transport           = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ankh_morpork_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ankh_morpork_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'footer', array(
			'selector'        => '.site-info',
			'render_callback' => 'ankh_morpork_customize_partial_siteinfo',
		) );
	}
}
add_action( 'customize_register', 'ankh_morpork_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ankh_morpork_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ankh_morpork_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site info line for the selective refresh partial.
 *
 * @return void
 */
function ankh_morpork_customize_partial_siteinfo() {
	bloginfo( 'footer' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ankh_morpork_customize_preview_js() {
	wp_enqueue_script( 'ankh-morpork-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ankh_morpork_customize_preview_js' );
