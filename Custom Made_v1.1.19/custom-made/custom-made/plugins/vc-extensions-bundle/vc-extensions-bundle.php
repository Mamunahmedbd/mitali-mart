<?php
/* WPBakery Page Builder Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_vc_extensions_theme_setup9', 9 );
	function custom_made_vc_extensions_theme_setup9() {
		if (custom_made_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 										'custom_made_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'custom_made_filter_merge_styles',						'custom_made_vc_extensions_merge_styles' );
			add_filter( 'custom_made_filter_get_css',							'custom_made_vc_extensions_get_css', 10, 3 );
		}
	
		if (is_admin()) {
			add_filter( 'custom_made_filter_tgmpa_required_plugins',		'custom_made_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'custom_made_vc_extensions_tgmpa_required_plugins' ) ) {
	
	function custom_made_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (in_array('vc-extensions-bundle', custom_made_storage_get('required_plugins'))) {
			$list[] = array(
					'name' 		=> esc_html__('WPBakery Page Builder Extensions Bundle', 'custom-made'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'custom_made_exists_vc_extensions' ) ) {
	function custom_made_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'custom_made_vc_extensions_frontend_scripts' ) ) {
	
	function custom_made_vc_extensions_frontend_scripts() {
		if (custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')))
			wp_enqueue_style( 'custom-made-vc-extensions-bundle',  custom_made_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'custom_made_vc_extensions_merge_styles' ) ) {
	
	function custom_made_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}


// Add VC specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'custom_made_vc_extensions_get_css' ) ) {
	
	function custom_made_vc_extensions_get_css($css, $colors, $fonts) {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

CSS;
		}
		
		return $css;
	}
}
?>