<?php
/**
 * Admin utilities
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0.1
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('custom_made_admin_theme_setup') ) {
	add_action( 'after_setup_theme', 'custom_made_admin_theme_setup' );
	function custom_made_admin_theme_setup() {
		// Add theme icons
		add_action('admin_footer',	 						'custom_made_admin_footer');

		// Enqueue scripts and styles for admin
		add_action("admin_enqueue_scripts",					'custom_made_admin_scripts');
		add_action("admin_footer",							'custom_made_admin_localize_scripts');
		
		// Show admin notice
		add_action('admin_notices',							'custom_made_admin_notice', 2);
		add_action('wp_ajax_custom_made_hide_admin_notice',		'custom_made_callback_hide_admin_notice');

		// TGM Activation plugin
		add_action('tgmpa_register',						'custom_made_register_plugins');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'custom_made_importer_set_options', 9 );
	}
}

// Show admin notice
if ( !function_exists( 'custom_made_admin_notice' ) ) {
	
	function custom_made_admin_notice() {
		$opt_name = 'custom_made_admin_notice';
		$show = get_option('custom_made_admin_notice');
		if ($show !== false && (int) $show == 0) return;
		get_template_part( 'templates/admin-notice' );
	}
}

// Hide admin notice
if ( !function_exists( 'custom_made_callback_hide_admin_notice' ) ) {
	
	function custom_made_callback_hide_admin_notice() {
		update_option('custom_made_admin_notice', '0');
		exit;
	}
}


//-------------------------------------------------------
//-- Styles and scripts
//-------------------------------------------------------
	
// Load inline styles
if ( !function_exists( 'custom_made_admin_footer' ) ) {
	
	function custom_made_admin_footer() {
		// Get current screen
		$screen = get_current_screen();
		if ($screen->id=='nav-menus') {
			get_template_part( 'templates/icons' );
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'custom_made_admin_scripts' ) ) {
	
	function custom_made_admin_scripts() {

		// Add theme styles
		wp_enqueue_style(  'custom-made-admin',  custom_made_get_file_url('css/admin.css') );

		// Links to selected fonts
		$screen = get_current_screen();
		if (custom_made_options_allow_override($screen->id) && custom_made_options_allow_override($screen->post_type)) {
			// Load fontello icons
			// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
			// and can't be used instead this style!
			wp_enqueue_style(  'fontello-icons', custom_made_get_file_url('css/fontello/css/fontello-embedded.css') );
			wp_enqueue_style(  'fontello-animation', custom_made_get_file_url('css/fontello/css/animation.css') );
			// Load theme fonts
			$links = custom_made_theme_fonts_links();
			if (count($links) > 0) {
				foreach ($links as $slug => $link) {
					wp_enqueue_style( sprintf('custom-made-font-%s', $slug), $link );
				}
			}
		} else if (is_customize_preview() || $screen->id=='nav-menus') {
			// Load fontello icons
			// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
			// and can't be used instead this style!
			wp_enqueue_style(  'fontello-icons', custom_made_get_file_url('css/fontello/css/fontello-embedded.css') );
		}

		// Add theme scripts
		wp_enqueue_script( 'custom-made-utils', custom_made_get_file_url('js/_utils.js'), array('jquery') );
		wp_enqueue_script( 'custom-made-admin', custom_made_get_file_url('js/_admin.js'), array('jquery') );
	}
}
	
// Add variables in the admin mode
if ( !function_exists( 'custom_made_admin_localize_scripts' ) ) {
	
	function custom_made_admin_localize_scripts() {
		$screen = get_current_screen();
		wp_localize_script( 'custom-made-admin', 'CUSTOM_MADE_STORAGE', apply_filters( 'custom_made_filter_localize_script_admin', array(
			'admin_mode' => true,
			'screen_id' => esc_attr($screen->id),
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			'ajax_error_msg' => esc_html__('Server response error', 'custom-made'),
			'icon_selector_msg' => esc_html__('Select the icon for this menu item', 'custom-made'),
			'user_logged_in' => true
			))
		);
	}
}



//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'custom_made_importer_set_options' ) ) {
	
	function custom_made_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Prepare demo data
			$options['demo_url'] = esc_url(custom_made_get_protocol() . '://demofiles.axiomthemes.com/custom-made/');
			// Required plugins
			$options['required_plugins'] = custom_made_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Custom Made Demo', 'custom-made');
			$options['files']['default']['domain_dev'] = esc_url(custom_made_get_protocol() . '://custom-made.axiomthemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(custom_made_get_protocol() . '://custom-made.axiomthemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Third party plugins
//-------------------------------------------------------

// Register optional plugins
if ( !function_exists( 'custom_made_register_plugins' ) ) {
	function custom_made_register_plugins() {
		tgmpa(	apply_filters('custom_made_filter_tgmpa_required_plugins', array(
				// Plugins to include in the autoinstall queue.
				)),
				array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => false,                    // Automatically activate plugins after installation or not.
					'message'      => ''                       // Message to output right before the plugins table.
				)
			);
	}
}
?>