<?php
/*
 * Plugin Name: Confetti for WooCommerce
 * Plugin URI: https://eguler.net/woocommerce-konfeti-yagmuru-eklentisi/
 * Description: You can "start a confetti rain and display a message" according to WooCommerce cart amount with this plugin.
 * Version: 1.1.0
 * WC requires at least: 2.5
 * WC tested up to: 8.2.2
 * Author: Emre Güler
 * Author URI: https://eguler.net
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wc-confetti
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WC_CONFETTI_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-confetti-activator.php
 */
function activate_wc_confetti() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-confetti-activator.php';
	Wc_Confetti_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-confetti-deactivator.php
 */
function deactivate_wc_confetti() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-confetti-deactivator.php';
	Wc_Confetti_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_confetti' );
register_deactivation_hook( __FILE__, 'deactivate_wc_confetti' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-confetti.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_confetti() {

	$plugin = new Wc_Confetti();
	$plugin->run();

}
run_wc_confetti();
