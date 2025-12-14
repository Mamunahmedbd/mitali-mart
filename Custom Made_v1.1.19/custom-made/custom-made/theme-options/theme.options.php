<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// -----------------------------------------------------------------
// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
// -- Internal theme settings
// -----------------------------------------------------------------
custom_made_storage_set('settings', array(
	
	'custom_sidebars'			=> 8,							// How many custom sidebars will be registered (in addition to theme preset sidebars): 0 - 10

	'ajax_views_counter'		=> true,						// Use AJAX for increment posts counter (if cache plugins used) 
																// or increment posts counter then loading page (without cache plugin)
	'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins

	'max_load_fonts'			=> 3,							// Max fonts number to load from Google fonts or from uploaded fonts

	'breadcrumbs_max_level' 	=> 3,							// Max number of the nested categories in the breadcrumbs (0 - unlimited)

	'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio

	'max_excerpt_length'		=> 60,							// Max words number for the excerpt in the blog style 'Excerpt'.
																// For style 'Classic' - get half from this value
	'message_maxlength'			=> 1000							// Max length of the message from contact form
	
));



// -----------------------------------------------------------------
// -- Theme fonts (Google and/or custom fonts)
// -----------------------------------------------------------------

// Fonts to load when theme start
// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'

custom_made_storage_set('load_fonts', array(
	// Google font
	array(
		'name'	 => 'Crimson Text',
		'family' => 'serif',
		'styles' => '400,400i,600,600i,700,700i'		// Parameter 'style' used only for the Google fonts
		),
	// Google font
	array(
		'name'   => 'Lato',
		'family' => 'sans-serif'
		)
));

// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
custom_made_storage_set('load_fonts_subset', 'latin,latin-ext');

// Settings of the main tags
custom_made_storage_set('theme_fonts', array(
	'p' => array(
		'title'				=> esc_html__('Main text', 'custom-made'),
		'description'		=> esc_html__('Font settings of the main text of the site', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '1rem',
		'font-weight'		=> '400',
		'font-style'		=> 'normal',
		'line-height'		=> '1.45em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '1.5em'
		),
	'h1' => array(
		'title'				=> esc_html__('Heading 1', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '2.66rem',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.25em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.15em',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '0.75em'
		),
	'h2' => array(
		'title'				=> esc_html__('Heading 2', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '3.8rem',
		'font-weight'		=> '600',
		'font-style'		=> 'italic',
		'line-height'		=> '1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '0.31em'
		),
	'h3' => array(
		'title'				=> esc_html__('Heading 3', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '2.77em',
		'font-weight'		=> '600',
		'font-style'		=> 'italic',
		'line-height'		=> '1.1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '0.3em'
		),
	'h4' => array(
		'title'				=> esc_html__('Heading 4', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '2em',
		'font-weight'		=> '600',
		'font-style'		=> 'italic',
		'line-height'		=> '1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '0.44em'
		),
	'h5' => array(
		'title'				=> esc_html__('Heading 5', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '1.66em',
		'font-weight'		=> '600',
		'font-style'		=> 'italic',
		'line-height'		=> '1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '0.55em'
		),
	'h6' => array(
		'title'				=> esc_html__('Heading 6', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '0.89em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.25em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '0.9em'
		),
	'logo' => array(
		'title'				=> esc_html__('Logo text', 'custom-made'),
		'description'		=> esc_html__('Font settings of the text case of the logo', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '1.6em',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.25em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '1px'
		),
	'button' => array(
		'title'				=> esc_html__('Buttons', 'custom-made'),
		'font-family'		=> '"Lato", sans-serif',
		'font-size' 		=> '0.833em',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.2em'
		),
	'input' => array(
		'title'				=> esc_html__('Input fields', 'custom-made'),
		'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'custom-made'),
		'font-family'		=> '"Crimson Text", serif',
		'font-size' 		=> '1em',
		'font-weight'		=> '400',
		'font-style'		=> 'italic',
		'line-height'		=> '1.2em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> ''
		),
	'info' => array(
		'title'				=> esc_html__('Post meta', 'custom-made'),
		'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'custom-made'),
		'font-family'		=> '"Lato", sans-serif',
		'font-size' 		=> '11px',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.5em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.1em',
		'margin-top'		=> '0',
		'margin-bottom'		=> ''
		),
	'menu' => array(
		'title'				=> esc_html__('Main menu', 'custom-made'),
		'description'		=> esc_html__('Font settings of the main menu items', 'custom-made'),
		'font-family'		=> '"Lato", sans-serif',
		'font-size' 		=> '11px',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.5em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.2em'
		),
	'submenu' => array(
		'title'				=> esc_html__('Dropdown menu', 'custom-made'),
		'description'		=> esc_html__('Font settings of the dropdown menu items', 'custom-made'),
		'font-family'		=> '"Lato", sans-serif',
		'font-size' 		=> '11px',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.5em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.2em'
		)
));


// -----------------------------------------------------------------
// -- Theme colors for customizer
// -- Attention! Inner scheme must be last in the array below
// -----------------------------------------------------------------
custom_made_storage_set('schemes', array(

	// Color scheme: 'default'
	'default' => array(
		'title'	 => esc_html__('Default', 'custom-made'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#ffffff',
			'bd_color'				=> '#edeef2',

			// Text and links colors
			'text'					=> '#7a7a7a',
			'text_light'			=> '#919191',
			'text_dark'				=> '#2a2a2a',
			'text_link'				=> '#dd4026',
			'text_hover'			=> '#2a2a2a',

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#222222',
			'alter_bg_hover'		=> '#181818',
			'alter_bd_color'		=> '#181818',
			'alter_bd_hover'		=> '#222222',
			'alter_text'			=> '#7a7a7a',
			'alter_light'			=> '#919191',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#dd4026',
			'alter_hover'			=> '#ffffff',

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '#ffffff',
			'input_bg_hover'		=> '#f1f5f8',
			'input_bd_color'		=> '#edeef2',
			'input_bd_hover'		=> '#e5ecf1',
			'input_text'			=> '#7a7a7a',
			'input_light'			=> '#919191',
			'input_dark'			=> '#2a2a2a',
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#ffffff',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#dd4026',

			// Additional accented colors (if used in the current theme)
			
			'accent2'				=> '#dd4026'
		
		)
	),

	// Color scheme: 'dark'
	'dark' => array(
		'title'  => esc_html__('Dark', 'custom-made'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#222222',
			'bd_color'				=> '#181818',

			// Text and links colors
			'text'					=> '#7a7a7a',
			'text_light'			=> '#919191',
			'text_dark'				=> '#ffffff',
			'text_link'				=> '#dd4026',
			'text_hover'			=> '#ffffff',

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#ffffff',
			'alter_bg_hover'		=> '#f7f8fc',
			'alter_bd_color'		=> '#edeef2',
			'alter_bd_hover'		=> '#ffffff',
			'alter_text'			=> '#7a7a7a',
			'alter_light'			=> '#919191',
			'alter_dark'			=> '#2a2a2a',
			'alter_link'			=> '#dd4026',
			'alter_hover'			=> '#2a2a2a',

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '#252525',
			'input_bg_hover'		=> '#2a2a2a',
			'input_bd_color'		=> '#212121',
			'input_bd_hover'		=> '#212121',
			'input_text'			=> '#7a7a7a',
			'input_light'			=> '#919191',
			'input_dark'			=> '#2a2a2a',
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#ffffff',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#dd4026',
		
			// Additional accented colors (if used in the current theme)
			
			'accent2'				=> '#dd4026'

		)
	)

));



// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('custom_made_options_create')) {

	function custom_made_options_create() {

		custom_made_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'custom-made'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'custom-made') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'custom-made'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'custom-made') ),
				"type" => "section"
				),
			'header_hide_image' => array(
				"title" => esc_html__("Hide header image", 'custom-made'),
				"desc" => wp_kses_data( __("Hide header image if it exists", 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'custom-made'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_video' => array(
				"title" => esc_html__('Header video', 'custom-made'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => '',
				"type" => "video"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'custom-made'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 'header-default',
				"options" => apply_filters('custom_made_filter_list_header_styles', array(
					'header-default' => esc_html__('Default Header',	'custom-made')
				)),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'custom-made'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 'default',
				"options" => array(
					'default' => esc_html__('Default','custom-made'),
					'over' => esc_html__('Over',	'custom-made'),
					'under' => esc_html__('Under',	'custom-made')
				),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'custom-made'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 'inherit',
				"options" => custom_made_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'custom-made'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'custom-made'),
					'right'	=> esc_html__('Right',	'custom-made')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'custom-made'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 'inherit',
				"options" => custom_made_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'custom-made'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'custom-made') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services',
					'section' => esc_html__('Header', 'custom-made'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'custom-made') ),
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'custom-made'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"dependency" => array(
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => custom_made_get_list_range(0,6),
				"type" => "select"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'custom-made'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'show_page_title' => array(
				"title" => esc_html__('Show Page Title', 'custom-made'),
				"desc" => wp_kses_data( __('Do you want to show page title area (page/post/category title and breadcrumbs)?', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'custom-made')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'show_breadcrumbs' => array(
				"title" => esc_html__('Show breadcrumbs', 'custom-made'),
				"desc" => wp_kses_data( __('Do you want to show breadcrumbs in the page title area?', 'custom-made') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'custom-made'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'custom-made') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'custom-made'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'custom-made') ),
				"std" => '',
				"type" => "image"
				),
			'mobile_layout_width' => array(
				"title" => esc_html__('Mobile layout from', 'custom-made'),
				"desc" => wp_kses_data( __('Window width to show mobile layout of the header', 'custom-made') ),
				"std" => 959,
				"type" => "text"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'custom-made'),
				"desc" => wp_kses_data( __('Options for the content area', 'custom-made') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'custom-made'),
				"desc" => wp_kses_data( __('Select width of the body content', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Content', 'custom-made')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed' => esc_html__( 'Boxed', 'custom-made' ),
					'wide'  => esc_html__( 'Wide', 'custom-made' ),
					'fullwide'  => esc_html__( 'Fullwidth', 'custom-made' ),
					'fullscreen'  => esc_html__( 'Fullscreen', 'custom-made' ),
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'custom-made'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"std" => 'default',
				"options" => custom_made_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'custom-made'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Content', 'custom-made')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'custom-made'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Content', 'custom-made')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'custom-made'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'custom-made') ),
				"std" => 0,
				"type" => "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'custom-made'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'custom-made') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'custom-made') ),
                "type"  => "text"
            ),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'custom-made'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'custom-made') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Color Scheme', 'custom-made'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"std" => 'side',
				"options" => custom_made_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'custom-made'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => custom_made_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'custom-made')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'custom-made'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'custom-made') ),
				"type" => "section"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'custom-made'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'custom-made')
				),
				"std" => 'default',
				"options" => custom_made_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'custom-made')
				),
				"std" => 'footer_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'custom-made'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'custom-made')
				),
				"dependency" => array(
					'footer_widgets' => array('^hide')
				),
				"std" => 3,
				"options" => custom_made_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'custom-made'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'custom-made') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'custom-made')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'custom-made'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'custom-made') ),
				'refresh' => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'custom-made'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'custom-made') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'custom-made'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'custom-made') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'custom-made'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'custom-made') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'custom-made'),
				"desc" => wp_kses_data( __('Copyright text in the footer', 'custom-made') ),
				"std" => esc_html__('AxiomThemes &copy; {Y}. All rights reserved.', 'custom-made'),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'custom-made'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'custom-made') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'custom-made'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'custom-made') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'custom-made'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'custom-made') ),
				"std" => 'excerpt',
				"options" => custom_made_get_list_blog_styles(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'custom-made'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'custom-made') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'custom-made') ),
				"std" => 'header_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'custom-made') ),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'custom-made'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'custom-made') ),
				"refresh" => false,
				"std" => 'right',
				"options" => custom_made_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'custom-made'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'custom-made') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'custom-made'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'custom-made') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'custom-made'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => 'excerpt',
				"options" => custom_made_get_list_blog_styles(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'custom-made'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'custom-made') ),
				"std" => 2,
				"options" => custom_made_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'custom-made'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => custom_made_get_list_posts_types(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'custom-made'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => custom_made_array_merge(array(0 => esc_html__('- Select category -', 'custom-made')), custom_made_get_list_categories()),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'custom-made'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'custom-made'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'custom-made'),
					'links'	=> esc_html__("Older/Newest", 'custom-made'),
					'more'	=> esc_html__("Load more", 'custom-made'),
					'infinite' => esc_html__("Infinite scroll", 'custom-made')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'custom-made'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'custom-made'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'custom-made') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'custom-made'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'custom-made') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'custom-made'),
					'fullpost'	=> esc_html__('Full post',	'custom-made')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'custom-made'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'custom-made') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'custom-made'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'custom-made') ),
				"std" => 2,
				"options" => custom_made_get_list_range(2,4),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for posts', 'custom-made'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'custom-made') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => "none",
				"options" => custom_made_get_list_animations_in(),
				"type" => "select"
				),
			"animation_on_mobile" => array( 
				"title" => esc_html__('Allow animation on mobile', 'custom-made'),
				"desc" => wp_kses_data( __('Allow extended animation effects on mobile devices', 'custom-made') ),
				"std" => 'yes',
				"dependency" => array(
					'blog_animation' => array('^none')
				),
				"options" => custom_made_get_list_yesno(),
				"type" => "switch"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'custom-made'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'custom-made') ),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'custom-made'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'custom-made') ),
				"refresh" => false,
				"std" => 'right',
				"options" => custom_made_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'custom-made'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'custom-made') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'custom-made'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'custom-made') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'custom-made') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'custom-made'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'custom-made'),
					"advanced" => esc_html__("Advanced", 'custom-made')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'custom-made'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'custom-made') ),
				"std" => 'default',
				"options" => custom_made_get_list_schemes(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'custom-made'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'custom-made'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'custom-made'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'custom-made'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'custom-made'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'custom-made'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'custom-made') ),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'custom-made'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'custom-made') ),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'custom-made'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'custom-made'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'custom-made'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'custom-made'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'custom-made'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'custom-made'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'custom-made'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'custom-made'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'custom-made'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the active field', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'custom-made'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),

			'accent2' => array(
				"title" => esc_html__('Accent2', 'custom-made'),
				"desc" => wp_kses_data( __('Color of the custom accented areas', 'custom-made') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$custom_made_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'custom-made'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'custom-made') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'custom-made')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'custom-made'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'custom-made') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'custom-made')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'custom-made'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'custom-made'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'custom-made') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'custom-made') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'custom-made'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'custom-made') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'custom-made') ),
				"refresh" => false,
				"std" => '$custom_made_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=custom_made_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(esc_html__('Font %s', 'custom-made'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'custom-made'),
				"desc" => '',
				"refresh" => false,
				"std" => '$custom_made_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'custom-made'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'custom-made') )
							: '',
				"refresh" => false,
				"std" => '$custom_made_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'custom-made'),
					'serif' => esc_html__('serif', 'custom-made'),
					'sans-serif' => esc_html__('sans-serif', 'custom-made'),
					'monospace' => esc_html__('monospace', 'custom-made'),
					'cursive' => esc_html__('cursive', 'custom-made'),
					'fantasy' => esc_html__('fantasy', 'custom-made')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'custom-made'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'custom-made') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'custom-made') )
							: '',
				"refresh" => false,
				"std" => '$custom_made_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = custom_made_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(esc_html__('%s settings', 'custom-made'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'custom-made'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = custom_made_get_list_load_fonts(true);
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'custom-made'),
						'100' => esc_html__('100 (Light)', 'custom-made'), 
						'200' => esc_html__('200 (Light)', 'custom-made'), 
						'300' => esc_html__('300 (Thin)',  'custom-made'),
						'400' => esc_html__('400 (Normal)', 'custom-made'),
						'500' => esc_html__('500 (Semibold)', 'custom-made'),
						'600' => esc_html__('600 (Semibold)', 'custom-made'),
						'700' => esc_html__('700 (Bold)', 'custom-made'),
						'800' => esc_html__('800 (Black)', 'custom-made'),
						'900' => esc_html__('900 (Black)', 'custom-made')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'custom-made'),
						'normal' => esc_html__('Normal', 'custom-made'), 
						'italic' => esc_html__('Italic', 'custom-made')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'custom-made'),
						'none' => esc_html__('None', 'custom-made'), 
						'underline' => esc_html__('Underline', 'custom-made'),
						'overline' => esc_html__('Overline', 'custom-made'),
						'line-through' => esc_html__('Line-through', 'custom-made')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'custom-made'),
						'none' => esc_html__('None', 'custom-made'), 
						'uppercase' => esc_html__('Uppercase', 'custom-made'),
						'lowercase' => esc_html__('Lowercase', 'custom-made'),
						'capitalize' => esc_html__('Capitalize', 'custom-made')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$custom_made_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		custom_made_storage_merge_array('options', '', $fonts);
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('custom_made_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'custom_made_options_theme_setup2', 2 );
	function custom_made_options_theme_setup2() {
		custom_made_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('custom_made_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'custom_made_options_theme_setup5', 5 );
	function custom_made_options_theme_setup5() {
		custom_made_storage_set('options_reloaded', false);
		custom_made_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('custom_made_load_custom_options')) {
		add_action( 'wp_loaded', 'custom_made_load_custom_options' );
		function custom_made_load_custom_options() {
			if (!custom_made_storage_get('options_reloaded')) {
				custom_made_storage_set('options_reloaded', true);
				custom_made_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('custom_made_load_theme_options') ) {
	function custom_made_load_theme_options() {
		$options = custom_made_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$custom_made_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = custom_made_get_value_gp($k);
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				custom_made_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			custom_made_customizer_save_css();
		} else {
			do_action('custom_made_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('custom_made_override_theme_options') ) {
	add_action( 'wp', 'custom_made_override_theme_options', 1 );
	function custom_made_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			custom_made_storage_set('blog_archive', true);
			custom_made_storage_set('blog_template', get_the_ID());
		}
		custom_made_storage_set('blog_mode', custom_made_detect_blog_mode());
		if (is_singular()) {
			custom_made_storage_set('options_meta', get_post_meta(get_the_ID(), 'custom_made_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('custom_made_get_theme_option')) {
	function custom_made_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!custom_made_storage_isset('post_options_meta', $post_id))
				custom_made_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'custom_made_options', true));
			if (custom_made_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = custom_made_storage_get_array('post_options_meta', $post_id, $name);
				if (!custom_made_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && custom_made_storage_isset('options')) {
			if ( !custom_made_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'custom-made'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						wp_die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = custom_made_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = custom_made_get_value_gp($name . '_' . $blog_mode);
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = custom_made_get_value_gp($name);
				// Override option from current page settings (if exists)
				} else if (custom_made_storage_isset('options_meta', $name) && !custom_made_is_inherit(custom_made_storage_get_array('options_meta', $name))) {
					$rez = custom_made_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && custom_made_storage_isset('options', $name . '_' . $blog_mode, 'val') && !custom_made_is_inherit(custom_made_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = custom_made_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (custom_made_storage_isset('options', $name, 'val')) {
					$rez = custom_made_storage_get_array('options', $name, 'val');
				// Get Custom Made Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('custom_made_check_theme_option')) {
	function custom_made_check_theme_option($name) {
		return custom_made_storage_isset('options', $name);
	}
}

// Get dependencies list from the Theme Options
if ( !function_exists('custom_made_get_theme_dependencies') ) {
	function custom_made_get_theme_dependencies() {
		$options = custom_made_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('custom_made_get_theme_setting')) {
	function custom_made_get_theme_setting($name) {
		return custom_made_storage_isset('settings', $name) ? custom_made_storage_get_array('settings', $name) : false;
	}
}


// Set theme setting
if ( !function_exists( 'custom_made_set_theme_setting' ) ) {
	function custom_made_set_theme_setting($option_name, $value) {
		if (custom_made_storage_isset('settings', $option_name))
			custom_made_storage_set_array('settings', $option_name, $value);
	}
}
?>