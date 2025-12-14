<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_cf7_theme_setup9', 9 );
	function custom_made_cf7_theme_setup9() {
		
		if (custom_made_exists_cf7()) {
			add_filter('wpcf7_autop_or_not', '__return_false');
			add_action( 'wp_enqueue_scripts', 								'custom_made_cf7_frontend_scripts', 1100 );
			add_filter( 'custom_made_filter_merge_styles',						'custom_made_cf7_merge_styles' );
			add_filter( 'custom_made_filter_get_css',							'custom_made_cf7_get_css', 10, 3 );
			add_filter( 'custom_made_filter_merge_scripts', 'custom_made_cf7_merge_scripts' );
		}
		if (is_admin()) {
			add_filter( 'custom_made_filter_tgmpa_required_plugins',			'custom_made_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'custom_made_cf7_tgmpa_required_plugins' ) ) {
	
	function custom_made_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', custom_made_storage_get('required_plugins'))) {
			$list[] = array(
					'name' 		=> esc_html__('Contact Form 7', 'custom-made'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'custom_made_exists_cf7' ) ) {
	function custom_made_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'custom_made_cf7_frontend_scripts' ) ) {
	
	function custom_made_cf7_frontend_scripts() {
		if (custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('plugins/contact-form-7/contact-form-7.css'))) {
			wp_enqueue_style( 'custom-made-contact-form-7',  custom_made_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
		}
		if (custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('plugins/contact-form-7/contact-form-7.js'))) {
			wp_enqueue_script( 'custom-made-contact-form-7',  custom_made_get_file_url('plugins/contact-form-7/contact-form-7.js'), array('jquery'), null, true);
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'custom_made_cf7_merge_styles' ) ) {
	
	function custom_made_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}

// Merge custom scripts
if ( !function_exists( 'custom_made_cf7_merge_scripts' ) ) {
	
	function custom_made_cf7_merge_scripts($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.js';
		return $list;
	}
}


// Add cf7 specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'custom_made_cf7_get_css' ) ) {
	
	function custom_made_cf7_get_css($css, $colors, $fonts) {
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