<?php

/**
 * The public-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    reading-progressbar
 * @subpackage reading-progressbar/public
 */

/**
 * The public-specific functionality of the plugin.
 *
 * @package    reading-progressbar
 * @subpackage reading-progressbar/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
 	add_action( 'wp_enqueue_scripts', 'enqueue_styles_reading_progressbar_public' );
	function enqueue_styles_reading_progressbar_public() {
		wp_enqueue_style( 'rp-public-styles', plugin_dir_url( __FILE__ ) . 'css/rp-public.css', array(), '', 'all' );
	}

 	add_action( 'wp_enqueue_scripts', 'enqueue_scripts_reading_progressbar_public' );
	function enqueue_scripts_reading_progressbar_public() {
		wp_enqueue_script( 'rp-public-scripts', plugin_dir_url( __FILE__ ) . 'js/rp-public.js', array( 'jquery' ), '', false );
	}

	add_action( 'wp_footer', 'rp_show_it', 100 );
	function rp_show_it() {
		if ( get_option( 'rp_settings' ) ) {
			$rpSettings = get_option( 'rp_settings' );
			$rpHeight = $rpSettings['rp_field_height'];
			$rpColor = $rpSettings['rp_field_color'];
			$rpPosition = $rpSettings['rp_field_position'];
		} else {
			$rpHeight = '10';
			$rpColor = '#aaaaaa';
			$rpPosition = 'top';
		}
	    echo '<progress class="readingProgressbar" 
	    		data-color="' . $rpColor . '" 
				data-height="' . $rpHeight . '" 
				data-position="'. $rpPosition .'" 
			value="0"></progress>';
	}
