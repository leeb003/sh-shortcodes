<?php
/**
 * Plugin Name: SH Shortcodes
 * Plugin URI: http://www.sh-themes.com
 * Description: A group of useful shortcodes
 * Version: 1.3.4
 * Author: SH-Themes
 * Author URI: http://www.sh-themes.com
 */
if(defined('SH_PLUGIN_VERSION') || isset($GLOBALS['lsPluginPath'])) {
    die('ERROR: It looks like you already have one instance of SH Shortcodes installed. WordPress cannot activate and handle two instanced at the same time, you need to remove the old one first.');
}


// Constants
    define('SH_ROOT_FILE', __FILE__);
    define('SH_ROOT_PATH', dirname(__FILE__));
    define('SH_ROOT_URL', plugins_url('', __FILE__));
    define('SH_PLUGIN_VERSION', '1.3.3');
    define('SH_PLUGIN_SLUG', basename(dirname(__FILE__)));
    define('SH_PLUGIN_BASE', plugin_basename(__FILE__));
    define('SH_DB_TABLE', 'shshortcodes');

	require_once SH_ROOT_PATH.'/core/create-shortcodes.php';
	new Create_Shortcodes;
	require_once SH_ROOT_PATH.'/core/sh-styles.php';
	new shStyles;
	// Custom post types
	require_once SH_ROOT_PATH . '/core/register-custom-posts.php';

	// Visual Composer include shortcodes
	if(function_exists('vc_set_as_theme')) {
    	require_once SH_ROOT_PATH . '/core/vc-extend.php';
		require_once SH_ROOT_PATH . '/core/vc-nestedshortcodes.php';
	}

	// Back-end only
    if(is_admin()) {
        require_once SH_ROOT_PATH.'/core/admin.php';
		new Admin_Shortcodes;

    } 

	/*
	   Technically Back-end as well
	   Pass our Tiny MCE iframed code through wordpress to get wordpress functionality ( e.g. translations )
	   using query_vars check our query and if matched load up the iframe window file
	*/
	add_filter('query_vars', 'shshort_add_trigger');

	function shshort_add_trigger($vars) {
		$vars[] = 'scshort_trigger';
		return $vars;
	}

	add_action('template_redirect', 'scshort_trigger_check');
	function scshort_trigger_check() {
		if(intval(get_query_var('scshort_trigger')) == 1) {
			require_once SH_ROOT_PATH . '/js/mcev4/sc-window.php';
			exit;
		}
	}

	/*
	   Translations
	*/
	add_action('plugins_loaded', 'shshortc_load_textdomain');
	function shshortc_load_textdomain() {
		load_plugin_textdomain('shshortc', false, basename( dirname( __FILE__ ) ) . '/languages');
	}


