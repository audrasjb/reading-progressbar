<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    reading-progressbar
 * @subpackage reading-progressbar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    reading-progressbar
 * @subpackage reading-progressbar/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
	// Enqueue styles
	add_action( 'admin_enqueue_scripts', 'enqueue_styles_reading_progressbar_admin' );
	function enqueue_styles_reading_progressbar_admin() {
//		wp_enqueue_style( 'reading_progressbar', plugin_dir_url( __FILE__ ) . 'css/rp-admin.css', array(), '', 'all' );
	}
	
	// Enqueue scripts
	add_action( 'admin_enqueue_scripts', 'enqueue_scripts_reading_progressbar_admin' );
	function enqueue_scripts_reading_progressbar_admin() {
//		wp_enqueue_script( 'asagenda', plugin_dir_url( __FILE__ ) . 'js/rp-admin.js', array( 'jquery', 'wp-color-picker' ), '', false );
	}
	
	
