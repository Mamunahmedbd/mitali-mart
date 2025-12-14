<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_mailchimp_theme_setup9', 9 );
	function custom_made_mailchimp_theme_setup9() {
		if (custom_made_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'custom_made_mailchimp_frontend_scripts', 1100 );
			add_filter( 'custom_made_filter_merge_styles',					'custom_made_mailchimp_merge_styles');
			add_filter( 'custom_made_filter_get_css',						'custom_made_mailchimp_get_css', 10, 3);
		}
		if (is_admin()) {
			add_filter( 'custom_made_filter_tgmpa_required_plugins',		'custom_made_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'custom_made_exists_mailchimp' ) ) {
	function custom_made_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'custom_made_mailchimp_tgmpa_required_plugins' ) ) {
	
	function custom_made_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', custom_made_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'custom-made'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'custom_made_mailchimp_frontend_scripts' ) ) {
	
	function custom_made_mailchimp_frontend_scripts() {
		if (custom_made_exists_mailchimp()) {
			if (custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')))
				wp_enqueue_style( 'custom-made-mailchimp-for-wp',  custom_made_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'custom_made_mailchimp_merge_styles' ) ) {
	
	function custom_made_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}

// Add css styles into global CSS stylesheet
if (!function_exists('custom_made_mailchimp_get_css')) {
	
	function custom_made_mailchimp_get_css($css, $colors, $fonts) {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		}
		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: transparent;
	border-color: {$colors['input_bd_color']};
	color: {$colors['input_text']};
}
.mc4wp-form input[type="submit"] {
	background: linear-gradient(to right,	{$colors['text_link']} 50%, {$colors['input_bd_color']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['input_bd_color']} !important;
	border-color: {$colors['input_bd_color']};
	color: {$colors['inverse_text']};
}
.mc4wp-form input[type="submit"]:hover {
	border-color: {$colors['text_link']};
	color: {$colors['inverse_text']};
	background-position: left bottom !important; 
}

CSS;
		}

		return $css;
	}
}
?>