<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_essential_grid_theme_setup9', 9 );
	function custom_made_essential_grid_theme_setup9() {
		if (custom_made_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'custom_made_essential_grid_frontend_scripts', 1100 );
			add_filter( 'custom_made_filter_merge_styles',					'custom_made_essential_grid_merge_styles' );
			add_filter( 'custom_made_filter_get_css',						'custom_made_essential_grid_get_css', 10, 3 );
		}
		if (is_admin()) {
			add_filter( 'custom_made_filter_tgmpa_required_plugins',		'custom_made_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'custom_made_exists_essential_grid' ) ) {
	function custom_made_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'custom_made_essential_grid_tgmpa_required_plugins' ) ) {
	
	function custom_made_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', custom_made_storage_get('required_plugins'))) {
			$path = custom_made_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'custom-made'),
						'slug' 		=> 'essential-grid',
						'version'   => '3.1.8',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'custom_made_essential_grid_frontend_scripts' ) ) {
	
	function custom_made_essential_grid_frontend_scripts() {
		if (custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('plugins/essential-grid/essential-grid.css')))
			wp_enqueue_style( 'custom-made-essential-grid',  custom_made_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'custom_made_essential_grid_merge_styles' ) ) {
	
	function custom_made_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}

// Add plugin's specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'custom_made_essential_grid_get_css' ) ) {
	
	function custom_made_essential_grid_get_css($css, $colors, $fonts) {
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