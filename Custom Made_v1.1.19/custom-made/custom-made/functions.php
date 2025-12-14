<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */


/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
}

// Theme storage
$CUSTOM_MADE_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'essential-grid',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'woocommerce',
		'contact-form-7',
		'trx_updater'
	),
	'theme_demo_url' => '//custom-made.axiomthemes.com'
);


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

if ( !function_exists('custom_made_theme_setup1') ) {
	add_action( 'after_setup_theme', 'custom_made_theme_setup1', 1 );
	function custom_made_theme_setup1() {
		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'custom_made_filter_content_width', 1170 );
	}
}

if ( !function_exists('custom_made_theme_setup') ) {
	add_action( 'after_setup_theme', 'custom_made_theme_setup' );
	function custom_made_theme_setup() {


		// Add wide and full blocks support
		add_theme_support( 'align-wide' );

		// The theme supports responsive embedded content
		add_theme_support( "responsive-embeds" );


		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('custom_made_filter_add_thumb_sizes', array(
			'custom-made-thumb-huge'		=> array(1170, 658, true),
			'custom-made-thumb-big' 		=> array( 740, 416, true),
			'custom-made-thumb-med' 		=> array( 370, 208, true),
			'custom-made-thumb-tiny' 		=> array(  90,  90, true),
			'custom-made-thumb-masonry-big' => array( 770,   0, false),		// Only downscale, not crop
			'custom-made-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = custom_made_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'custom_made_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false
			)
		);


		// Custom logo
		add_theme_support( 'custom-logo',
			array(
				'width'       => 250,
				'height'      => 60,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// WooCommerce Support
		add_theme_support( 'woocommerce' );

        // Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
        add_theme_support( 'wc-product-gallery-zoom' );

        // Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
        add_theme_support( 'wc-product-gallery-slider' );

        // Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
        add_theme_support( 'wc-product-gallery-lightbox' );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				custom_made_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			custom_made_theme_fonts_for_editor()
			)
		);	
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'custom-made', custom_made_get_folder_dir('languages') );
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'custom-made'),
			'menu_footer' => esc_html__('Footer Menu', 'custom-made')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'custom_made_excerpt_length' );
		add_filter( 'excerpt_more',							'custom_made_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'custom_made_wp_head', 1);
		
		// Add custom inline styles
		add_action('wp_footer',		 						'custom_made_wp_footer');
		add_action('admin_footer',	 						'custom_made_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'custom_made_wp_scripts', 1000);			//priority 1000 - load styles before the plugin's support custom styles (priority 1100)
		add_action('wp_footer',		 						'custom_made_localize_scripts');
		add_action('wp_enqueue_scripts', 					'custom_made_wp_scripts_responsive', 2000);	//priority 2000 - load responsive after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'custom_made_add_body_classes' );

		// Register sidebars
		add_action('widgets_init', 							'custom_made_widgets_init');
	}

}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( !function_exists('custom_made_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'custom_made_image_sizes' );
	function custom_made_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('custom_made_filter_add_thumb_sizes', array(
			'custom-made-thumb-huge'		=> esc_html__( 'Fullsize image', 'custom-made' ),
			'custom-made-thumb-big'			=> esc_html__( 'Large image', 'custom-made' ),
			'custom-made-thumb-med'			=> esc_html__( 'Medium image', 'custom-made' ),
			'custom-made-thumb-tiny'		=> esc_html__( 'Small square avatar', 'custom-made' ),
			'custom-made-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'custom-made' ),
			'custom-made-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'custom-made' ),
			)
		);
		$mult = custom_made_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'custom-made' );
		}
		return $sizes;
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'custom_made_wp_scripts' ) ) {
	
	function custom_made_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = custom_made_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('custom-made-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello-icons',  custom_made_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'custom-made-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'custom-made-child', $child_stylesheet, array('custom-made-main'), null );
		}
		
		// Animations
		if ( (custom_made_get_theme_option('blog_animation')!='none' || custom_made_get_theme_option('menu_animation_in')!='none' || custom_made_get_theme_option('menu_animation_out')!='none') && (custom_made_get_theme_option('animation_on_mobile')=='yes' || !wp_is_mobile()) && (!function_exists('custom_made_vc_is_frontend') || !custom_made_vc_is_frontend()))
			wp_enqueue_style( 'custom-made-animation',	custom_made_get_file_url('css/animation.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && custom_made_is_off(custom_made_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'custom-made-colors', custom_made_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'custom-made-main', custom_made_customizer_get_css() );

		// Merged styles
		if ( custom_made_is_off(custom_made_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'custom-made-styles', custom_made_get_file_url('css/__styles.css') );

		// Add post nav background
		custom_made_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( substr(custom_made_get_theme_option('blog_style'), 0, 7) == 'gallery' || substr(custom_made_get_theme_option('blog_style'), 0, 9) == 'portfolio' )
			wp_enqueue_script( 'modernizr', custom_made_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );
		
		// Merged scripts
		if ( custom_made_is_off(custom_made_get_theme_option('debug_mode')) ) {
            wp_enqueue_script('custom-made-init', custom_made_get_file_url('js/__scripts.js'), array('jquery'), null, true);
        } else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', custom_made_get_file_url('js/skip-link-focus-fix.js') );
			// Superfish Menu
			wp_enqueue_script( 'superfish', custom_made_get_file_url('js/superfish.js'), array('jquery') );
			// Background video
			$header_video = custom_made_get_theme_option('header_video');
			if (!empty($header_video) && !custom_made_is_inherit($header_video))
				wp_enqueue_script( 'bideo', custom_made_get_file_url('js/bideo.js'), array() );
			// Theme scripts
			wp_enqueue_script( 'custom-made-utils', custom_made_get_file_url('js/_utils.js'), array( 'jquery' ), null, true );
			wp_enqueue_script( 'custom-made-init', custom_made_get_file_url('js/_init.js'), array( 'jquery' ), null, true );
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (custom_made_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'custom_made_localize_scripts' ) ) {
	
	function custom_made_localize_scripts() {
		wp_localize_script( 'custom-made-init', 'CUSTOM_MADE_STORAGE', apply_filters( 'custom_made_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Menu width for mobile mode
			'mobile_layout_width' => max(480, custom_made_get_theme_option('mobile_layout_width')),

			// Stretch sidemenu to window height
			'menu_stretch' => custom_made_is_on(custom_made_get_theme_option('menu_stretch')),

			// Menu animation
			'menu_animation_in' => custom_made_get_theme_option('menu_animation_in'),
            'menu_animation_out' => custom_made_get_theme_option('menu_animation_out'),

			// Video background
			'background_video' => custom_made_get_theme_option('header_video'),

			// Video and Audio tag wrapper
			'use_mediaelements' => custom_made_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'message_maxlength'	=> intval(custom_made_get_theme_setting('message_maxlength')),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', custom_made_get_theme_option('color_scheme')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'custom-made'),
					'error_global'		=> esc_html__('Error data validation!', 'custom-made'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'custom-made'),
					'name_long'			=> esc_html__('Too long name', 'custom-made'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'custom-made'),
					'email_long'		=> esc_html__('Too long email address', 'custom-made'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'custom-made'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'custom-made'),
					'text_long'			=> esc_html__('Too long message text', 'custom-made'),
					'search_error'		=> esc_html__('Search error! Try again later.', 'custom-made'),
					'send_complete'		=> esc_html__("Send message complete!", 'custom-made'),
					'send_error'		=> esc_html__('Transmit failed!', 'custom-made')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'custom_made_wp_scripts_responsive' ) ) {
	
	function custom_made_wp_scripts_responsive() {
		wp_enqueue_style( 'custom-made-responsive', custom_made_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('custom_made_wp_head')) {
	
	function custom_made_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('custom_made_add_body_classes') ) {
	
	function custom_made_add_body_classes( $classes ) {
		$blog_mode = custom_made_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'body_style_' . esc_attr(custom_made_get_theme_option('body_style'));
		$classes[] = 'scheme_' . esc_attr(custom_made_get_theme_option('color_scheme'));
		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(custom_made_get_theme_option('blog_style'));
		}
		if (custom_made_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(custom_made_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (custom_made_is_on(custom_made_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		if (custom_made_is_on(custom_made_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(custom_made_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(custom_made_get_theme_option("header_position"));
		$classes[] = 'header_title_' . esc_attr(custom_made_need_page_title() ? 'on' : 'off');

		$menu_style= custom_made_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load inline styles
if ( !function_exists( 'custom_made_wp_footer' ) ) {
	
	//and add_action('admin_footer', 'custom_made_wp_footer');
	function custom_made_wp_footer() {
		// Get inline styles from storage
		if (($css = custom_made_storage_get('inline_styles')) != '') {
			wp_enqueue_style(  'custom-made-inline-styles',  custom_made_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'custom-made-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('custom_made_widgets_init') ) {
	function custom_made_widgets_init() {
		$sidebars = custom_made_get_list_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$name) {
				$description = esc_html__('Additional widget sets.', 'custom-made');
				if($id == 'sidebar_widgets')
					$description = esc_html__('Widgets appear on the side of the page.', 'custom-made');
				if($id == 'header_widgets')
					$description = esc_html__('Widgets appear at the header of the page.', 'custom-made');
				if($id == 'above_page_widgets')
					$description = esc_html__('Widgets appear above the page.', 'custom-made');
				if($id == 'above_content_widgets')
					$description = esc_html__('Widgets appear above the content area of the page.', 'custom-made');
				if($id == 'below_content_widgets')
					$description = esc_html__('Widgets appear below the content area of the page.', 'custom-made');
				if($id == 'below_page_widgets')
					$description = esc_html__('Widgets appear above below the page.', 'custom-made');
				if($id == 'footer_widgets')
					$description = esc_html__('Widgets appear at the footer area of the page.', 'custom-made');
				if($id == 'woocommerce_widgets')
					$description = esc_html__('Widgets appear on the side of the page.', 'custom-made');
				register_sidebar( array(
										'name'          => $name,
										'id'            => $id,
										'description'   => $description,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('custom_made_theme_fonts_links') ) {
	function custom_made_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Google fonts: on or off', 'custom-made' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Custom fonts (included in the theme): on or off', 'custom-made' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !custom_made_storage_empty('load_fonts') ) {
			$load_fonts = custom_made_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = custom_made_get_load_fonts_slug($font['name']);
					$url  = custom_made_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '%7C' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('//fonts.googleapis.com/css?family=%s&subset=%s', $google_fonts, custom_made_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('custom_made_theme_fonts_for_editor') ) {
	function custom_made_theme_fonts_for_editor() {
		$links = array_values(custom_made_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('custom_made_excerpt_length') ) {
	function custom_made_excerpt_length( $length ) {
		return max(1, custom_made_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('custom_made_excerpt_more') ) {
	function custom_made_excerpt_more( $more ) {
		return '&hellip;';
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once trailingslashit( get_template_directory() ) . 'includes/utils.php';
require_once trailingslashit( get_template_directory() ) . 'includes/storage.php';
require_once trailingslashit( get_template_directory() ) . 'includes/lists.php';
require_once trailingslashit( get_template_directory() ) . 'includes/wp.php';

require_once trailingslashit( get_template_directory() ) . 'includes/theme.tags.php';
require_once trailingslashit( get_template_directory() ) . 'includes/theme.hovers/theme.hovers.php';

if (is_admin()) {
	require_once trailingslashit( get_template_directory() ) . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/admin.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/fixes/fix_urls.php';
}

require_once trailingslashit( get_template_directory() ) . 'theme-options/theme.customizer.php';

// Plugins support
if (is_array($CUSTOM_MADE_STORAGE['required_plugins']) && count($CUSTOM_MADE_STORAGE['required_plugins']) > 0) {
	foreach ($CUSTOM_MADE_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = sanitize_file_name($plugin_slug);
		$plugin_path = trailingslashit( get_template_directory() ) . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'custom_made_exists_gdpr_framework' ) ) {
	function custom_made_exists_gdpr_framework() {
		return defined( 'GDPR_FRAMEWORK_VERSION' );
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'custom_made_exists_wp_gdpr_compliance' ) ) {
	function custom_made_exists_wp_gdpr_compliance() {
		return defined( 'WP_GDPR_C_ROOT_FILE' ) || defined( 'WPGDPRC_ROOT_FILE' );
	}
}

// Add checkbox with "I agree ..."
if ( ! function_exists( 'custom_made_comment_form_agree' ) ) {
    add_filter('comment_form_fields', 'custom_made_comment_form_agree', 11);
	function custom_made_comment_form_agree( $comment_fields ) {
		$privacy_text = custom_made_get_privacy_text();
		if ( ! empty( $privacy_text )
			&& ( ! function_exists( 'custom_made_exists_gdpr_framework' ) || ! custom_made_exists_gdpr_framework() )
			&& ( ! function_exists( 'custom_made_exists_wp_gdpr_compliance' ) || ! custom_made_exists_wp_gdpr_compliance() )
		) {
			$comment_fields['i_agree_privacy_policy'] = custom_made_single_comments_field(
				array(
					'form_style'        => 'default',
					'field_type'        => 'checkbox',
					'field_req'         => '',
					'field_icon'        => '',
					'field_value'       => '1',
					'field_name'        => 'i_agree_privacy_policy',
					'field_title'       => $privacy_text,
				)
			);
		}
		return $comment_fields;
	}
}
?>