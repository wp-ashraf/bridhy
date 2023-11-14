<?php
/*
Plugin Name: Bridhy CF7 - Ultimate Contact Form 7 Addons
Plugin URI: https://wpgrids.com
Description: The Bridhy plugin is a powerful tool designed to enhance your Contact Form 7 experience with the help of Elementor. With Bridhy, you can effortlessly create stunning forms by utilizing our advanced features and functionalities.
Version: 1.0.0
Author: wpgrids
Author URI: https://profiles.wordpress.org/wpgrids/
License: GPLv2 or later
Text Domain: fbth
 */

if (!defined('ABSPATH')) {
    exit;
}

//Set plugin version constant.
define('FBTH_VERSION', '1.0.0');
/* Set constant path to the plugin directory. */
define('FBTH_WIDGET', trailingslashit(plugin_dir_path(__FILE__)));
// Plugin Function Folder Path
define('FBTH_WIDGET_INC', plugin_dir_path(__FILE__) . 'inc/');
define('FBTH_WIDGET_LIB', plugin_dir_path(__FILE__) . 'lib/');

// Plugin Extensions Folder Path
define('FBTH_WIDGET_EXTENSIONS', plugin_dir_path(__FILE__) . 'extensions/');

// Plugin Widget Folder Path
define('FBTH_WIDGET_DIR', plugin_dir_path(__FILE__) . 'widgets/');

// Assets Folder URL
define('FBTH_ASSETS_PUBLIC', plugins_url('assets', __FILE__));

// Assets Folder URL
define('FBTH_ASSETS_VERDOR', plugins_url('assets/vendor', __FILE__));

require_once FBTH_WIDGET_INC . 'helper-function.php';


require_once FBTH_WIDGET_INC . 'elmentor-extender.php';




require_once FBTH_WIDGET . 'base.php';

