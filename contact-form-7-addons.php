<?php
/*
Plugin Name: Bridhy CF7 - Ultimate Contact Form 7 Addons
Plugin URI: https://wpgrids.com
Description: The Bridhy is an Contact Form 7 helping plugin that will make your designing work easier.
Our specialities are custom CSS, Nested section, Creative Buttons.
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

