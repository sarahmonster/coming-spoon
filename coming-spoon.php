<?php
/**
 * Plugin Name: Coming Spoon
 * Plugin URI: https://github.com/wpdocde/slim-maintenance-mode
 * Description:  A simple and flexible coming soon/maintenance mode plugin for WordPress. Has nothing to do with spoons.
 * Version: 0.1.0
 * Author: sarah semark
 * Author URI: https://triggersandsparks.com
 * Text Domain: coming-spoon
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 * Coming Spoon is based on Slim Maintenance Mode by Johannes Ries.
 * https://github.com/wpdocde/slim-maintenance-mode
 */

/**
 * Avoid direct calls
*/
defined( 'ABSPATH' ) or die( 'No direct requests for security reasons.' );

/*
 * Require plugin.php
 */
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

/**
 * Activation with Cache Support
*/
function comingspoon_on_activation()	{
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "activate-plugin_{$plugin}" );

	// Clear Cachify Cache
	if ( has_action('cachify_flush_cache') ) {
		do_action('cachify_flush_cache');
	}

	// Clear Super Cache
	if ( function_exists( 'wp_cache_clear_cache' ) ) {
		ob_end_clean();
		wp_cache_clear_cache();
	}

	// Clear W3 Total Cache
	if ( function_exists( 'w3tc_pgcache_flush' ) ) {
		ob_end_clean();
		w3tc_pgcache_flush();
	}

	// Clear WP-Rocket Cache
	if ( function_exists( 'rocket_clean_domain' ) ) {
		rocket_clean_domain();
	}
}
register_activation_hook( __FILE__, 'comingspoon_on_activation' );

/**
 * Deactivation with Cache Support
*/
function comingspoon_on_deactivation() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "deactivate-plugin_{$plugin}" );

	// Clear Cachify Cache
	if ( has_action('cachify_flush_cache') ) {
		do_action('cachify_flush_cache');
	}

	// Clear Super Cache
	if ( function_exists( 'wp_cache_clear_cache' ) ) {
		ob_end_clean();
		wp_cache_clear_cache();
	}

	// Clear W3 Total Cache
	if ( function_exists( 'w3tc_pgcache_flush' ) ) {
		ob_end_clean();
		w3tc_pgcache_flush();
	}

	// Clear WP-Rocket Cache
	if ( function_exists( 'rocket_clean_domain' ) ) {
		rocket_clean_domain();
	}
}
register_deactivation_hook( __FILE__, 'comingspoon_on_deactivation' );

/**
 * Localization
*/
load_plugin_textdomain( 'coming-spoon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

/*
 * Check to see if coming soon mode is enabled.
 */
function comingspoon_enabled() {
	if ( get_option( 'comingspoon_options' )['enabled'] ) :
		return true;
	else :
		return false;
	endif;
}

/**
 * Alert message when active
*/
function comingspoon_admin_notice() {
	if ( comingspoon_enabled() ) :
		echo '<div id="message" class="error fade"><p>' . __( '<strong>Maintenance mode</strong> is <strong>active</strong>!', 'slim-maintenance-mode' ) . ' <a href="plugins.php#slim-maintenance-mode">' . __( 'Deactivate it, when work is done.', 'slim-maintenance-mode' ) . '</a></p></div>';
	endif;
}
add_action( 'admin_notices', 'comingspoon_admin_notice' );

// Show alert on multisite installs.
if ( is_multisite() && is_plugin_active_for_network( plugin_basename( __FILE__ ) && comingspoon_enabled() ) ) {
	add_action( 'network_admin_notices', 'comingspoon_admin_notice' );
}

// Show alert for attempted login.
function comingspoon_login_notice() {
	if ( comingspoon_enabled() ) :
		return '<div id="login_error">' . __( '<strong>Maintenance mode</strong> is <strong>active</strong>!', 'slim-maintenance-mode' ) . '</div>';
	endif;
}
add_filter( 'login_message', 'comingspoon_login_notice' );

/*
 * Change the admin bar colour so it's obvious we're in coming soon mode,
 * even if you're a logged-in user looking at your own site.
 */
function comingspoon_admin_bar_color() {
	if ( comingspoon_enabled() ) :
		wp_enqueue_style( 'comingspoon-admin', plugin_dir_url( __FILE__ ) . 'assets/stylesheets/admin-bar.css', array(), '20170220', 'all' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'comingspoon_admin_bar_color' );
add_action( 'admin_enqueue_scripts', 'comingspoon_admin_bar_color' );

/*
 * Add a bit of clarifying text to coloured admin bar,
 *
 */
function comingspoon_admin_bar_text( $wp_admin_bar ) {
	if ( comingspoon_enabled() ) :
		$wp_admin_bar->add_node( array(
			'id'    => 'comingspoon-enabled-text',
			'title' => 'Coming soon mode enabled',
			'meta'  => array( 'class' => 'comingspoon-enabled-text' )
		) );
	endif;
}
add_action( 'admin_bar_menu', 'comingspoon_admin_bar_text', 999 );


/**
 * Determine the path and URL for our plugin, so that we can easily reference
 * files without having to worry about weird directory structure nonsense.
 */
function comingspoon_plugin_dir( $return = 'url' ) {
	$path = plugin_dir_path( dirname( __FILE__ ) );
	$url = plugin_dir_url( __FILE__ );
	if ( 'path' === $return ) :
		return $path;
	else :
		return $url;
	endif;
}

/**
 * Load the "Coming Soon" template!
*/
function comingspoon_load_template() {
	nocache_headers();
	if( comingspoon_enabled() && ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) ) {
		if ( $overridden_template = locate_template( 'coming-soon-template.php' ) ) {
			// If either the child theme or the parent theme have overridden the template
			load_template( $overridden_template );
		} else {
			// If neither the child nor parent theme have overridden the template,
			// we load the template from the 'templates' sub-directory of the directory this file is in
			load_template( dirname( __FILE__ ) . '/templates/coming-soon-template.php' );
		}
		exit();
		//wp_die( '', __( 'Maintenance', 'slim-maintenance-mode' ), array('response' => '503') );
	}
}
add_action( 'get_header', 'comingspoon_load_template' );

/*
 * Customizer additions.
 *
 */
require( 'inc/customizer.php' );

?>
