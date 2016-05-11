<?php
/* 
 * Master Array of all icons gathered from the separate icon files
 * Generates a large array of all icons
 */
function all_icons() {
	$icons = array();
	require_once SH_ROOT_PATH . '/core/font-awesome-icons.php';
	require_once SH_ROOT_PATH . '/core/linear-icons.php';
	require_once SH_ROOT_PATH . '/core/ion-icons.php';
	$icons['font_awesome'] = fa_font_icons();
	$icons['linear_icons'] = linearicons();
	$icons['ion_icons']    = ionicons();
	return $icons;
}

