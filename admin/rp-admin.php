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
		__( 'Progressbar height (pixels)', 'progressbar' ), 
		'rp_field_height_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_color', 
		__( 'Progressbar color', 'progressbar' ), 
		'rp_field_color_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_position', 
		__( 'Progressbar position', 'progressbar' ), 
		'rp_field_position_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_custom_position', 
		__( 'Target fixed HTML element class/id to stick the bar on it’s bottom', 'progressbar' ), 
		'rp_field_custom_position_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_templates', 
		__( 'Select templates to apply progressbar', 'progressbar' ), 
		'rp_field_templates_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);

	add_settings_field( 
		'rp_field_posttypes', 
		__( 'Select post types to apply progressbar', 'progressbar' ), 
		'rp_field_posttypes_render', 
		'pluginPage', 
		'rp_pluginPage_section' 
	);
}


function rp_field_height_render(  ) { 
	$options = get_option( 'rp_settings' );
	if (isset($options['rp_field_height'])) {
		$optionHeight = $options['rp_field_height'];
	} else {
		$optionHeight = '';		
	}
	?>
	<input type='number' name='rp_settings[rp_field_height]' value='<?php echo $optionHeight; ?>'>
	<?php
}


function rp_field_color_render(  ) { 
	$options = get_option( 'rp_settings' );
	if (isset($options['rp_field_color'])) {
		$optionColor = $options['rp_field_color'];
	} else {
		$optionColor = '';		
	}
	?>
	<input type='text' class='rp-colorpicker' name='rp_settings[rp_field_color]' value='<?php echo $optionColor; ?>'>
	<?php
}


function rp_field_position_render(  ) { 
	$options = get_option( 'rp_settings' );
	if (isset($options['rp_field_position'])) {
		$optionPosition = $options['rp_field_position'];
	} else {
		$optionPosition = '';		
	}
	?>
	<select name='rp_settings[rp_field_position]'>
		<option value='top' <?php selected( $optionPosition, 'top' ); ?>>Top</option>
		<option value='bottom' <?php selected( $optionPosition, 'bottom' ); ?>>Bottom</option>
		<option value='custom' <?php selected( $optionPosition, 'custom' ); ?>>Custom</option>
	</select>
<?php
}

function rp_field_custom_position_render(  ) { 
	$options = get_option( 'rp_settings' );
	if (isset($options['rp_field_custom_position'])) {
		$optionCustomPosition = $options['rp_field_custom_position'];
	} else {
		$optionCustomPosition = '';		
	}
	?>
	<input type='text' name='rp_settings[rp_field_custom_position]' value='<?php echo $optionCustomPosition; ?>'>
	<?php
}

function rp_field_templates_render( ) {
	$options = get_option( 'rp_settings' );
	if (isset($options['rp_field_templates'])) {
		$optionTemplates = $options['rp_field_templates'];
		if (isset($optionTemplates['home'])) : $optionTemplatesHome = $optionTemplates['home']; else : $optionTemplatesHome = ''; endif;
		if (isset($optionTemplates['blog'])) : $optionTemplatesBlog = $optionTemplates['blog']; else : $optionTemplatesBlog = ''; endif;
		if (isset($optionTemplates['archive'])) : $optionTemplatesArchive = $optionTemplates['archive']; else : $optionTemplatesArchive = ''; endif;
		if (isset($optionTemplates['single'])) : $optionTemplatesSingle = $optionTemplates['single']; else : $optionTemplatesSingle = ''; endif;
	} else {
		$optionTemplates = '';
		$optionTemplatesHome = '';
		$optionTemplatesBlog = '';
		$optionTemplatesArchive = '';
		$optionTemplatesSingle = '';
	}
	?>
	<p><input type='checkbox' name='rp_settings[rp_field_templates][home]' <?php checked( $optionTemplatesHome == '1' ); ?> value='1' /> <?php echo __('Home / front-page', 'progressbar' ); ?></p>
	<p><input type='checkbox' name='rp_settings[rp_field_templates][blog]' <?php checked( $optionTemplatesBlog == '1' ); ?> value='1' /> <?php echo __('Blog page', 'progressbar' ); ?></p>
	<p><input type='checkbox' name='rp_settings[rp_field_templates][archive]' <?php checked( $optionTemplatesArchive == '1' ); ?> value='1' /> <?php echo __('Archives and categories / taxonomies for posts or custom post types (you need to include concerned post types below)', 'progressbar' ); ?></p>
	<p><input type='checkbox' name='rp_settings[rp_field_templates][single]' <?php checked( $optionTemplatesSingle == '1' ); ?> value='1' /> <?php echo __('Single post / page / custom post type (you need to include concerned post types below)', 'progressbar' ); ?></p>
	<?php
}

function rp_field_posttypes_render( ) {
	$options = get_option( 'rp_settings' );
	if (isset($options['rp_field_posttypes'])) {
		$optionPostTypes = $options['rp_field_posttypes'];
	} else {
		$optionPostTypes = '';
	}
	$post_types = get_post_types( 
	array( 'public' => true ), 'objects' );
	foreach ( $post_types as $type => $obj ) {
		?>
		<p><input type='checkbox' name='rp_settings[rp_field_posttypes][<?php echo $obj->name; ?>]' <?php checked( $optionPostTypes == '1' ); ?> value='<?php $obj->name; ?>' /> <?php echo $obj->labels->name; ?></p>
		<?php
	}
}

	/* TODO… OR NOT ?
	// List post formats
	if ( current_theme_supports( 'post-formats' ) ) {
    	$postFormats = get_theme_support( 'post-formats' );
		foreach ( $postFormats[0] as $postFormat ) {
			?>
			<p><input type='checkbox' name='rp_settings[rp_field_templates]' <?php checked( $optionTemplates, $postFormat ); ?> value='<?php echo $postFormat; ?>' /> <?php echo ucfirst($postFormat); ?></p>
			<?php
		}
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

