<?php
/**
 * Table Of Contents
 *
 * meridian_one_features_scripts ( Enqueue scripts and styled )
 * meridian_one_features_scripts_customizer  ( Enqueue scripts for customizer )
 * meridian_one_features_scripts_admin ( Enqueue scripts for admin )
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! function_exists( 'meridian_one_features_scripts' ) ) {

	/**
	 * Enqueue scripts and styles
	 *
	 * @since 1.0
	 */
	function meridian_one_features_scripts() {

		// styles
		if ( ! defined( 'MERIDIAN_ONE_FEATURES_DISABLE_CSS' ) || ! MERIDIAN_ONE_FEATURES_DISABLE_CSS ) {
			wp_enqueue_style( 'meridian-one-features-style', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/css/front.css' , array(), MERIDIAN_ONE_FEATURES_VERSION );
			wp_enqueue_style( 'font-awesome', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/css/fonts/font-awesome/font-awesome.css' );
		}

	}

} add_action( 'wp_enqueue_scripts', 'meridian_one_features_scripts' );

if ( ! function_exists( 'meridian_one_features_scripts_customizer' ) ) {

	/**
	 * Enqueue script for customizer
	 */
	function meridian_one_features_scripts_customizer() {

		// styles
		wp_enqueue_style( 'font-awesome', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/css/fonts/font-awesome/font-awesome.css', array(), MERIDIAN_ONE_FEATURES_VERSION );
		wp_enqueue_style( 'meridian-one-customizer-css', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/css/admin.css', array(), MERIDIAN_ONE_FEATURES_VERSION );

		// scripts
		wp_enqueue_script( 'media-upload' );
	   	wp_enqueue_media();
		wp_enqueue_script( 'meridian-one-customizer-js', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/js/admin.js', array( 'jquery' ), MERIDIAN_ONE_FEATURES_VERSION, true );
		wp_localize_script( 'meridian-one-customizer-js', 'MeridianOneIcons', meridian_one_features_get_icons_array() );

	} 

} add_action( 'customize_controls_enqueue_scripts', 'meridian_one_features_scripts_customizer' );

if ( ! function_exists( 'meridian_one_features_scripts_admin' ) ) {

	/**
	 * Enqueue script for custom widget controls.
	 */
	function meridian_one_features_scripts_admin( $page ) {
		
		if ( $page == 'widgets.php' ) {

			// styles
			wp_enqueue_style( 'font-awesome', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/css/fonts/font-awesome/font-awesome.css', array(), MERIDIAN_ONE_FEATURES_VERSION );
			wp_enqueue_style( 'meridian-one-admin-css', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/css/admin.css', array(), MERIDIAN_ONE_FEATURES_VERSION );

			// scripts
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_media();
			wp_enqueue_script( 'meridian-one-admin-js', MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL . '/js/admin.js', array( 'jquery' ), MERIDIAN_ONE_FEATURES_VERSION, true );
			wp_localize_script( 'meridian-one-admin-js', 'MeridianOneIcons', meridian_one_features_get_icons_array() );

		}

	} 

} add_action( 'admin_enqueue_scripts', 'meridian_one_features_scripts_admin' );