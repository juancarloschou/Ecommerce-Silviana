<?php /*
 * meta related functions
 *
 * @package nirvana
 * @subpackage Functions
 */

/**
 * Meta Title
 */
function nirvana_meta_title() {
	global $nirvanas;
	if ($nirvanas['nirvana_iecompat']): echo PHP_EOL.'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'; endif;
}
add_action('cryout_meta_hook', 'nirvana_meta_title', 0);

// mobile meta
function nirvana_mobile_meta() {
	global $nirvanas;
	if ($nirvanas['nirvana_mobile']=='Enable') {
		if ($nirvanas['nirvana_zoom']==1 ) {
			echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0">';
		} else { 
			echo '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">';
		}
		echo PHP_EOL;
	}
	else {
		echo '<meta name="viewport" content="user-scalable = yes">';
		}
}
add_action('cryout_meta_hook', 'nirvana_mobile_meta');

// favicon
function nirvana_fav_icon() {
	global $nirvanas;
	echo '<link rel="shortcut icon" href="' . esc_url($nirvanas['nirvana_favicon']) . '" />';
	echo '<link rel="apple-touch-icon" href="' . esc_url($nirvanas['nirvana_favicon']) . '" />';
}
if ($nirvanas['nirvana_favicon']) add_action ('cryout_header_hook','nirvana_fav_icon');
