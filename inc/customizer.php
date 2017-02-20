<?php
/**
 * _s Theme Customizer
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function comingspoon_customize_register( $wp_customize ) {
	/**
	 * Add the Theme Options section
	 */
	$wp_customize->add_section( 'comingspoon_options', array(
		'title'          => esc_html__( 'Coming Soon Mode', 'comingspoon' ),
		'description'    => esc_html__( 'Not quite ready to publish your site yet? Configure a coming soon page to let your visitors know.', 'comingspoon' ),
	) );

	$wp_customize->add_setting( 'comingspoon_options[enabled]', array(
		'capability'        => 'manage_options',
		'default'           => false,
		'sanitize_callback' => 'comingspoon_sanitize_checkbox',
		'type'              => 'option',
	) );

	$wp_customize->add_control( 'comingspoon_options[enabled]', array(
		'label'   => esc_html__( 'Enable coming soon mode.', 'comingspoon' ),
		'section' => 'comingspoon_options',
		'type'    => 'checkbox',
	) );
}
add_action( 'customize_register', 'comingspoon_customize_register' );

/**
 * Sanitize a true/false checkbox
 */
function comingspoon_sanitize_checkbox( $input ) {
	if ( ! in_array( $input, array( true, false ) ) ) {
		$input = false;
	}
	return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
//add_action( 'customize_preview_init', '_s_customize_preview_js' );
