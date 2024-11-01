<?php
/**
 * Plugin Name: Festival Snow Effect
 * Description: Falling snow effect to any kind of festival in world.
 * Version:     1.0
 * Author:      Gravity Master
 * License:     GPLv2 or later
 * Text Domain: gmse
 */

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/* All constants should be defined in this file. */
if ( ! defined( 'GMSE_PREFIX' ) ) {
	define( 'GMSE_PREFIX', 'gmse' );
}
if ( ! defined( 'GMSE_PLUGINDIR' ) ) {
	define( 'GMSE_PLUGINDIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GMSE_PLUGINBASENAME' ) ) {
	define( 'GMSE_PLUGINBASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GMSE_PLUGINURL' ) ) {
	define( 'GMSE_PLUGINURL', plugin_dir_url( __FILE__ ) );
}

/* Auto-load all the necessary classes. */
if( ! function_exists( 'gmse_class_auto_loader' ) ) {
	
	function gmse_class_auto_loader( $class ) {
		
	 	$includes = GMSE_PLUGINDIR . 'includes/' . $class . '.php';
		
		if( is_file( $includes ) && ! class_exists( $class ) ) {
			include_once( $includes );
			return;
		}
		
	}
}
spl_autoload_register('gmse_class_auto_loader');
new GMSE_Cron();
new GMSE_Admin();
new GMSE_Frontend();
?>