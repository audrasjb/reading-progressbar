<?php

/**
 * @link              http://jeanbaptisteaudras.com/portfolio/wordpress-reading-progressbar-indicator-plugin/
 * @since             1.0
 * @package           Reading progressbar
 *
 * @wordpress-plugin
 * Plugin Name:       Reading progressbar
 * Plugin URI:        http://jeanbaptisteaudras.com/portfolio/wordpress-reading-progressbar-indicator-plugin/
 * Description:       A reading position indicator that you can use where you want: top, bottom or custom position in differents templates or post types.
 * Version:           1.0
 * Author:            Jean-Baptiste Audras, project manager @ Whodunit
 * Author URI:        http://jeanbaptisteaudras.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       progressbar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * i18n
 */
//require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/includes/rp-i18n.php';

/**
 * Admin
 */
if (is_admin()) {
 require_once plugin_dir_path( dirname( __FILE__ ) ) . '/reading-progressbar/admin/rp-admin.php';
}
/**
 * Public
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/reading-progressbar/public/rp-public.php';
