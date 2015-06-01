<?php
/**
 * momo Theme Customizer
 *
 * @package momo
 * @link http://ottopress.com/tag/customizer/
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 */
function momo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'momo_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since _s 1.2
 */
function momo_customize_preview_js() {
	wp_enqueue_script( 'momo_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'momo_customize_preview_js' );

add_action ('admin_menu', 'momo_admin');
function momo_admin() {

	// add the Customize link to the admin menu
	add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' ); 

}


// add settings to create various social media text areas.

add_action('customize_register', 'momo_customize');
function momo_customize($wp_customize) {

	$wp_customize->add_section( 'momo_socmed_settings', array(
		'title'          => 'Social Media Settings',
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'twitter', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'twitter', array(
		'label'   => __( 'Twitter url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'facebook', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'facebook', array(
		'label'   => __( 'Facebook url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'googleplus', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'googleplus', array(
		'label'   => __( 'Google + url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'linkedin', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'linkedin', array(
		'label'   => __( 'LinkedIn url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'flickr', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'flickr', array(
		'label'   => __( 'Flickr url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'pinterest', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'pinterest', array(
		'label'   => __( 'Pinterest url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'youtube', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'youtube', array(
		'label'   => __( 'YouTube url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'vimeo', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'vimeo', array(
		'label'   => __( 'Vimeo url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'tumblr', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'tumblr', array(
		'label'   => __( 'Tumblr url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'dribble', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'dribble', array(
		'label'   => __( 'Dribble url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'github', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'github', array(
		'label'   => __( 'Github url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	$wp_customize->add_setting( 'instagram', array(
		'default'        => '',
		'sanitize_callback' => 'momo_sanitize_text',
	) );

	$wp_customize->add_control( 'instagram', array(
		'label'   => __( 'Instagram url:', 'momo' ),
		'section' => 'momo_socmed_settings',
		'type'    => 'text',
	) );
	
	
}
