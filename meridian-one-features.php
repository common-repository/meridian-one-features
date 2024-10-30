<?php
/*
	Plugin Name: Meridian One Features
	Plugin URI: http://meridianthemes.net/meridian-one-features
	Description: Shortcodes and custom post types for Meridian One theme.
	Version: 1.0.2
	Author: MeridianThemes
	Author URI: http://meridianthemes.net
	Text Domain: meridian-one-features
	Domain Path: /languages
	License: GPLv2
	
	Meridian One Features is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.
	 
	Meridian One Features is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	 
	You should have received a copy of the GNU General Public License
	along with Meridian One Features. If not, see https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

define( 'MERIDIAN_ONE_FEATURES_VERSION', '1.0' );
define( 'MERIDIAN_ONE_FEATURES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MERIDIAN_ONE_FEATURES_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

// functions
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/logic.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/display.php';

// widgets
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.team-member.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.feature.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.about.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.service.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.process.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.testimonial.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.contact-info.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.pricing.php';
include MERIDIAN_ONE_FEATURES_PLUGIN_DIR . 'inc/widgets/widget.slide.php';

function meridian_one_features_register_plus_widget() {
    
    register_widget( 'meridian_one_about_widget' );
    register_widget( 'meridian_one_contact_info_widget' );
    register_widget( 'meridian_one_feature_widget' );
    register_widget( 'meridian_one_process_widget' );
    register_widget( 'meridian_one_service_widget' );
    register_widget( 'meridian_one_slide_widget' );
    register_widget( 'meridian_one_team_member_widget' );
    register_widget( 'meridian_one_testimonial_widget' );

    if ( defined( 'MERIDIAN_ONE_PLUS' ) ) {
		register_widget( 'meridian_one_pricing_widget' );
		register_widget( 'meridian_one_slide_widget' );
    }
    
} add_action( 'widgets_init', 'meridian_one_features_register_plus_widget' );