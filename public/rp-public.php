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
			$rpForegroundColor = $rpSettings['rp_field_fg_color'];
			$rpBackgroundColor = $rpSettings['rp_field_bg_color'];
			$rpPosition = $rpSettings['rp_field_position'];
			$rpCustomPosition = $rpSettings['rp_field_custom_position'];
			if ( isset( $rpSettings['rp_field_templates'] ) ) { 
				$optionTemplates = $rpSettings['rp_field_templates'];
				if ( isset($optionTemplates['home']) && (is_home() && is_front_page() || is_front_page()) ) {
					echo '<progress class="readingProgressbar" 
						data-height="' . $rpHeight . '" 
						data-position="'. $rpPosition .'" 
						data-custom-position="'. $rpCustomPosition .'" 
						data-foreground="' . $rpForegroundColor . '" 
						data-background="' . $rpBackgroundColor . '" 
						data-mobile="' . $rpMobile . '" 
						value="0"></progress>';
				} elseif ( isset($optionTemplates['blog']) && (is_home() && !is_front_page()) ) {
					echo '<progress class="readingProgressbar" 
						data-height="' . $rpHeight . '" 
						data-position="'. $rpPosition .'" 
						data-custom-position="'. $rpCustomPosition .'" 
						data-foreground="' . $rpForegroundColor . '" 
						data-background="' . $rpBackgroundColor . '" 
						data-mobile="' . $rpMobile . '" 
						value="0"></progress>';
				} elseif ( isset($optionTemplates['archive']) && (is_archive()) ) {
					echo '<progress class="readingProgressbar" 
						data-height="' . $rpHeight . '" 
						data-position="'. $rpPosition .'" 
						data-custom-position="'. $rpCustomPosition .'" 
						data-foreground="' . $rpForegroundColor . '" 
						data-background="' . $rpBackgroundColor . '" 
						data-mobile="' . $rpMobile . '" 
						value="0"></progress>';
				} elseif ( isset($optionTemplates['single']) && (is_singular() && !is_front_page()) ) {
					$optionPostTypes = $rpSettings['rp_field_posttypes'];
					$currentPostType = get_post_type();
					if (isset($optionPostTypes[$currentPostType])) {
						echo '<progress class="readingProgressbar" 
							data-height="' . $rpHeight . '" 
							data-position="'. $rpPosition .'" 
							data-custom-position="'. $rpCustomPosition .'" 
							data-foreground="' . $rpForegroundColor . '" 
							data-background="' . $rpBackgroundColor . '" 
							data-mobile="' . $rpMobile . '" 
							value="0"></progress>';
					} 
				} 
			}
		}
	}
