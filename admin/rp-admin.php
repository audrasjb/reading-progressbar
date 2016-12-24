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
		wp_enqueue_style( 'wp-color-picker' );
//		wp_enqueue_style( 'rp-admin-styles', plugin_dir_url( __FILE__ ) . 'css/rp-admin.css', array(), '', 'all' );
	}
	
	// Enqueue scripts
	add_action( 'admin_enqueue_scripts', 'enqueue_scripts_reading_progressbar_admin' );
	function enqueue_scripts_reading_progressbar_admin() {
		wp_enqueue_script( 'rp-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/rp-admin.js', array( 'jquery', 'wp-color-picker' ), '', false );
	}	
	
/**
 * Plugin options in reading section
 *
 */
 
add_action( 'admin_menu', 'rp_add_admin_menu' );
add_action( 'admin_init', 'rp_settings_init' );


function rp_add_admin_menu(  ) { 

	add_options_page( 'Reading progressbar options', 'Reading progress', 'manage_options', 'reading-progressbar', 'rp_options_page' );

}


function rp_settings_init(  ) { 

	register_setting( 'pluginPage', 'rp_settings' );

	add_settings_section(
		'rp_pluginPage_section', 
		__( 'Reading progressbar options', 'progressbar' ), 
		'rp_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'rp_field_height', 
		__( 'Height of the bar (pixels)', 'progressbar' ), 
		'rp_field_height_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_color', 
		__( 'Color of the bar', 'progressbar' ), 
		'rp_field_color_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_position', 
		__( 'Position of the bar', 'progressbar' ), 
		'rp_field_position_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_custom_position', 
		__( 'Target fixed HTML element class/id to stick the bar on', 'progressbar' ), 
		'rp_field_custom_position_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

/*
	add_settings_field( 
		'rp_field_location', 
		__( 'On which post types or templates?', 'progressbar' ), 
		'rp_field_location_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);
*/
}


function rp_field_height_render(  ) { 
	$options = get_option( 'rp_settings' );
	?>
	<input type='number' name='rp_settings[rp_field_height]' value='<?php if ($options['rp_field_height']) : echo $options['rp_field_height']; endif; ?>'>
	<?php
}


function rp_field_color_render(  ) { 
	$options = get_option( 'rp_settings' );
	?>
	<input type='text' class='rp-colorpicker' name='rp_settings[rp_field_color]' value='<?php if ($options['rp_field_color']) : echo $options['rp_field_color']; endif; ?>'>
	<?php
}


function rp_field_position_render(  ) { 
	$options = get_option( 'rp_settings' );
	?>
	<select name='rp_settings[rp_field_position]'>
		<option value='top' <?php selected( $options['rp_field_position'], 'top' ); ?>>Top</option>
		<option value='bottom' <?php selected( $options['rp_field_position'], 'bottom' ); ?>>Bottom</option>
		<option value='custom' <?php selected( $options['rp_field_position'], 'custom' ); ?>>Custom</option>
	</select>
<?php
}

function rp_field_custom_position_render(  ) { 
	$options = get_option( 'rp_settings' );
	?>
	<input type='text' name='rp_settings[rp_field_custom_position]' value='<?php if ($options['rp_field_custom_position']) : echo $options['rp_field_custom_position']; endif; ?>'>
	<?php
}

/*
function rp_field_location_render( ) {
	$options = get_option( 'rp_settings' );
	?>
	<select name='rp_settings[rp_field_location]'>
	<?php
	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	foreach ( $post_types as $type => $obj ) {
		?>
		<option value='<?php echo $obj->name; ?>' <?php selected( $options['rp_field_location'], 1 ); ?>><?php echo $obj->labels->name; ?></option>
	<?php
	}
	?>
	</select>
	<?php
}
*/

function rp_settings_section_callback(  ) { 

	echo __( 'Check out the plugin options below.', 'progressbar' );

}


function rp_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

