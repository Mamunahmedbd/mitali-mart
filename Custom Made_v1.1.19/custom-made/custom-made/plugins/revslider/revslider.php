<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_revslider_theme_setup9', 9 );
	function custom_made_revslider_theme_setup9() {
		if (is_admin()) {
			add_filter( 'custom_made_filter_tgmpa_required_plugins',	'custom_made_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'custom_made_exists_revslider' ) ) {
	function custom_made_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'custom_made_revslider_tgmpa_required_plugins' ) ) {
	
	function custom_made_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', custom_made_storage_get('required_plugins'))) {
			$path = custom_made_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'custom-made'),
					'slug' 		=> 'revslider',
					'version'   => '6.7.31',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
?>