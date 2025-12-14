<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('custom_made_woocommerce_theme_setup1')) {
	add_action( 'after_setup_theme', 'custom_made_woocommerce_theme_setup1', 1 );
	function custom_made_woocommerce_theme_setup1() {
		add_filter( 'custom_made_filter_list_sidebars', 	'custom_made_woocommerce_list_sidebars' );
		add_filter( 'custom_made_filter_list_posts_types',	'custom_made_woocommerce_list_post_types');
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('custom_made_woocommerce_theme_setup3')) {
	add_action( 'after_setup_theme', 'custom_made_woocommerce_theme_setup3', 3 );
	function custom_made_woocommerce_theme_setup3() {
		if (custom_made_exists_woocommerce()) {
			custom_made_storage_merge_array('options', '', array(
				// Section 'WooCommerce' - settings for show pages
				'shop' => array(
					"title" => esc_html__('Shop', 'custom-made'),
					"desc" => wp_kses_data( __('Select parameters to display the shop pages', 'custom-made') ),
					"type" => "section"
					),
				'expand_content_shop' => array(
					"title" => esc_html__('Expand content', 'custom-made'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'custom-made') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts_shop' => array(
					"title" => esc_html__('Related products', 'custom-made'),
					"desc" => wp_kses_data( __('How many related products should be displayed in the single product page  (from 2 to 4)?', 'custom-made') ),
					"std" => 2,
					"options" => custom_made_get_list_range(2,4),
					"type" => "select"
					),
				'shop_mode' => array(
					"title" => esc_html__('Shop mode', 'custom-made'),
					"desc" => wp_kses_data( __('Select style for the products list', 'custom-made') ),
					"std" => 'thumbs',
					"options" => array(
						'thumbs'=> esc_html__('Thumbnails', 'custom-made'),
						'list'	=> esc_html__('List', 'custom-made'),
					),
					"type" => "select"
					),
				'shop_hover' => array(
					"title" => esc_html__('Hover style', 'custom-made'),
					"desc" => wp_kses_data( __('Hover style on the products in the shop archive', 'custom-made') ),
					"std" => 'shop',
					"options" => apply_filters('custom_made_filter_shop_hover', array(
						'none' => esc_html__('None', 'custom-made'),
						'shop' => esc_html__('Icons', 'custom-made'),
						'shop_buttons' => esc_html__('Buttons', 'custom-made')
					)),
					"type" => "select"
				),

				'header_widgets_shop' => array(
					"title" => esc_html__('Header widgets', 'custom-made'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the shop pages', 'custom-made') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_widgets_shop' => array(
					"title" => esc_html__('Sidebar widgets', 'custom-made'),
					"desc" => wp_kses_data( __('Select sidebar to show on the shop pages', 'custom-made') ),
					"std" => 'woocommerce_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_position_shop' => array(
					"title" => esc_html__('Sidebar position', 'custom-made'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the shop pages', 'custom-made') ),
					"refresh" => false,
					"std" => 'left',
					"options" => custom_made_get_list_sidebars_positions(),
					"type" => "select"
					),
				'widgets_above_page_shop' => array(
					"title" => esc_html__('Widgets above the page', 'custom-made'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'custom-made') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_above_content_shop' => array(
					"title" => esc_html__('Widgets above the content', 'custom-made'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'custom-made') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_content_shop' => array(
					"title" => esc_html__('Widgets below the content', 'custom-made'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'custom-made') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_page_shop' => array(
					"title" => esc_html__('Widgets below the page', 'custom-made'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'custom-made') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'footer_scheme_shop' => array(
					"title" => esc_html__('Footer Color Scheme', 'custom-made'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'custom-made') ),
					"std" => 'dark',
					"options" => custom_made_get_list_schemes(true),
					"type" => "select"
					),
				'footer_widgets_shop' => array(
					"title" => esc_html__('Footer widgets', 'custom-made'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'custom-made') ),
					"std" => 'footer_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'custom-made')), custom_made_get_list_sidebars()),
					"type" => "select"
					),
				'footer_columns_shop' => array(
					"title" => esc_html__('Footer columns', 'custom-made'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'custom-made') ),
					"dependency" => array(
						'footer_widgets_shop' => array('^hide')
					),
					"std" => 3,
					"options" => custom_made_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_shop' => array(
					"title" => esc_html__('Footer fullwide', 'custom-made'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'custom-made') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_woocommerce_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_woocommerce_theme_setup9', 9 );
	function custom_made_woocommerce_theme_setup9() {
		
		if (custom_made_exists_woocommerce()) {
			add_action( 'wp_enqueue_scripts', 								'custom_made_woocommerce_frontend_scripts', 1100 );
			add_filter( 'custom_made_filter_merge_styles',						'custom_made_woocommerce_merge_styles' );
			add_filter( 'custom_made_filter_get_css',							'custom_made_woocommerce_get_css', 10, 3 );
			add_filter( 'custom_made_filter_get_post_info',		 				'custom_made_woocommerce_get_post_info');
			add_filter( 'custom_made_filter_post_type_taxonomy',				'custom_made_woocommerce_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'custom_made_filter_detect_blog_mode',				'custom_made_woocommerce_detect_blog_mode' );
				add_filter( 'custom_made_filter_get_blog_all_posts_link', 		'custom_made_woocommerce_get_blog_all_posts_link');
				add_filter( 'custom_made_filter_get_blog_title', 				'custom_made_woocommerce_get_blog_title');
				add_filter( 'custom_made_filter_need_page_title', 				'custom_made_woocommerce_need_page_title');
				add_filter( 'custom_made_filter_sidebar_present',				'custom_made_woocommerce_sidebar_present' );
				add_filter( 'custom_made_filter_get_post_categories', 			'custom_made_woocommerce_get_post_categories');
				add_filter( 'custom_made_filter_allow_override_header_image',	'custom_made_woocommerce_allow_override_header_image' );
				add_action( 'custom_made_action_before_post_meta',				'custom_made_woocommerce_action_before_post_meta');
			}
		}
		if (is_admin()) {
			add_filter( 'custom_made_filter_tgmpa_required_plugins',			'custom_made_woocommerce_tgmpa_required_plugins' );
		}

		// Add wrappers and classes to the standard WooCommerce output
		if (custom_made_exists_woocommerce()) {

			// Remove WOOC sidebar
			remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 10 );

			// Remove link around product item
			remove_action('woocommerce_before_shop_loop_item',			'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_product_link_close', 5);
			
			// Remove link around product category
			remove_action('woocommerce_before_subcategory',				'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory',				'woocommerce_template_loop_category_link_close', 10);
			
			// Open main content wrapper - <article>
			remove_action( 'woocommerce_before_main_content',			'woocommerce_output_content_wrapper', 10);
			add_action(    'woocommerce_before_main_content',			'custom_made_woocommerce_wrapper_start', 10);
			// Close main content wrapper - </article>
			remove_action( 'woocommerce_after_main_content',			'woocommerce_output_content_wrapper_end', 10);		
			add_action(    'woocommerce_after_main_content',			'custom_made_woocommerce_wrapper_end', 10);

			// Close header section
			add_action( 'woocommerce_archive_description',				'custom_made_woocommerce_archive_description', 15 );

			// Add theme specific search form
			add_filter(    'get_product_search_form',					'custom_made_woocommerce_get_product_search_form' );

			// Change text on 'Add to cart' button
			add_filter(    'woocommerce_product_add_to_cart_text',		'custom_made_woocommerce_add_to_cart_text' );
			add_filter(    'woocommerce_product_single_add_to_cart_text','custom_made_woocommerce_add_to_cart_text' );

			// Add list mode buttons
			add_action(    'woocommerce_before_shop_loop', 				'custom_made_woocommerce_before_shop_loop', 10 );

			// Set columns number for the products loop
			add_filter(    'product_cat_class',							'custom_made_woocommerce_loop_shop_columns_class', 10, 3 );
			// Open product/category item wrapper
			add_action(    'woocommerce_before_subcategory_title',		'custom_made_woocommerce_item_wrapper_start', 9 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'custom_made_woocommerce_item_wrapper_start', 9 );
			// Close featured image wrapper and open title wrapper
			add_action(    'woocommerce_before_subcategory_title',		'custom_made_woocommerce_title_wrapper_start', 20 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'custom_made_woocommerce_title_wrapper_start', 20 );
			// Wrap product title into link
			add_action(    'the_title',									'custom_made_woocommerce_the_title');
			// Close title wrapper and add description in the list mode
			add_action(    'woocommerce_after_shop_loop_item_title',	'custom_made_woocommerce_title_wrapper_end', 7);
			add_action(    'woocommerce_after_subcategory_title',		'custom_made_woocommerce_title_wrapper_end2', 10 );
			// Close product/category item wrapper
			add_action(    'woocommerce_after_subcategory',				'custom_made_woocommerce_item_wrapper_end', 20 );
			add_action(    'woocommerce_after_shop_loop_item',			'custom_made_woocommerce_item_wrapper_end', 20 );

			// Add product ID into product meta section (after categories and tags)
			add_action(    'woocommerce_product_meta_end',				'custom_made_woocommerce_show_product_id', 10);
			
			// Set columns number for the product's thumbnails
			add_filter(    'woocommerce_product_thumbnails_columns',	'custom_made_woocommerce_product_thumbnails_columns' );

			// Set columns number for the related products
			add_filter(    'woocommerce_output_related_products_args',	'custom_made_woocommerce_output_related_products_args' );

			// Decorate price
			add_filter(    'woocommerce_get_price_html',				'custom_made_woocommerce_get_price_html' );

			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );


			// Add 'Out of stock' label
			add_action( 'custom_made_action_woocommerce_item_featured_link_start', 'custom_made_woocommerce_add_out_of_stock_label' );
	
			// Wrap a category title with a link (from WooCommerce 3.2.2+ )
			add_action( 'woocommerce_before_subcategory_title', 'custom_made_woocommerce_before_subcategory_title', 22, 1 );
			add_action( 'woocommerce_after_subcategory_title', 'custom_made_woocommerce_after_subcategory_title', 2, 1 );
			
			// Detect current shop mode
			if (!is_admin()) {
				$shop_mode = custom_made_get_value_gpc('custom_made_shop_mode');
				if (empty($shop_mode) && custom_made_check_theme_option('shop_mode'))
					$shop_mode = custom_made_get_theme_option('shop_mode');
				if (empty($shop_mode))
					$shop_mode = 'thumbs';
				custom_made_storage_set('shop_mode', $shop_mode);
			}
		}
	}
}



// Check if WooCommerce installed and activated
if ( !function_exists( 'custom_made_exists_woocommerce' ) ) {
	function custom_made_exists_woocommerce() {
		return class_exists('Woocommerce');
	}
}

// Return true, if current page is any woocommerce page
if ( !function_exists( 'custom_made_is_woocommerce_page' ) ) {
	function custom_made_is_woocommerce_page() {
		$rez = false;
		if (custom_made_exists_woocommerce())
			$rez = is_woocommerce() || is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'custom_made_woocommerce_detect_blog_mode' ) ) {
	
	function custom_made_woocommerce_detect_blog_mode($mode='') {
		if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy())
			$mode = 'shop';
		else if (is_product() || is_cart() || is_checkout() || is_account_page())
			$mode = 'shop';
		return $mode;
	}
}

// Wrap category title to the link: open tag
if ( ! function_exists( 'custom_made_woocommerce_before_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'custom_made_woocommerce_before_subcategory_title', 10, 1 );
	function custom_made_woocommerce_before_subcategory_title( $cat ) {
		if ( custom_made_storage_get( 'in_product_item' ) && is_object( $cat ) ) {
			?>
			<a href="<?php echo esc_url( get_term_link( $cat->slug, 'product_cat' ) ); ?>">
			<?php
		}
	}
}

// Wrap category title to the link: close tag
if ( ! function_exists( 'custom_made_woocommerce_after_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'custom_made_woocommerce_after_subcategory_title', 10, 1 );
	function custom_made_woocommerce_after_subcategory_title( $cat ) {
		if ( custom_made_storage_get( 'in_product_item' ) && is_object( $cat ) ) {
			?>
			</a>
			<?php
		}
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'custom_made_woocommerce_post_type_taxonomy' ) ) {
	
	function custom_made_woocommerce_post_type_taxonomy($tax='', $post_type='') {
		if ($post_type == 'product')
			$tax = 'product_cat';
		return $tax;
	}
}

// Return current page title
if ( !function_exists( 'custom_made_woocommerce_get_blog_title' ) ) {
	
	function custom_made_woocommerce_get_blog_title($title='') {
		if (is_woocommerce() && is_shop()) {
			$id = custom_made_woocommerce_get_shop_page_id();
			$title = $id ? get_the_title($id) : esc_html__('Shop', 'custom-made');
		}
		return $title;
	}
}

// Return link to main shop page for the breadcrumbs
if ( !function_exists( 'custom_made_woocommerce_get_blog_all_posts_link' ) ) {
	
	function custom_made_woocommerce_get_blog_all_posts_link($link='') {
		if (empty($link) && custom_made_is_woocommerce_page() && !is_shop()) {
			$id = custom_made_woocommerce_get_shop_page_id();
			$link = '<a href="'.esc_url(custom_made_woocommerce_get_shop_page_link()).'">'.($id ? get_the_title($id) : esc_html__('Shop', 'custom-made')).'</a>';
		}
		return $link;
	}
}

// Return true if page title section is allowed
if ( !function_exists( 'custom_made_woocommerce_need_page_title' ) ) {
	
	function custom_made_woocommerce_need_page_title($need=false) {
		if (!$need)
			$need = is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_product();
		return $need;
	}
}

// Return true if page title section is allowed
if ( !function_exists( 'custom_made_woocommerce_allow_override_header_image' ) ) {
	
	function custom_made_woocommerce_allow_override_header_image($allow=true) {
		return is_product() ? false : $allow;
	}
}

// Return shop page ID
if ( !function_exists( 'custom_made_woocommerce_get_shop_page_id' ) ) {
	function custom_made_woocommerce_get_shop_page_id() {
		return get_option('woocommerce_shop_page_id');
	}
}

// Return shop page link
if ( !function_exists( 'custom_made_woocommerce_get_shop_page_link' ) ) {
	function custom_made_woocommerce_get_shop_page_link() {
		$url = '';
		$id = custom_made_woocommerce_get_shop_page_id();
		if ($id) $url = get_permalink($id);
		return $url;
	}
}

// Show categories of the current product
if ( !function_exists( 'custom_made_woocommerce_get_post_categories' ) ) {
	
	function custom_made_woocommerce_get_post_categories($cats='') {
		if (get_post_type()=='product') {
			$cats = custom_made_get_post_terms(', ', get_the_ID(), 'product_cat');
		}
		return $cats;
	}
}

// Show categories of the team, courses, etc.
if ( !function_exists( 'custom_made_woocommerce_list_post_types' ) ) {
	
	function custom_made_woocommerce_list_post_types($list=array()) {
		$list['product'] = esc_html__('Products', 'custom-made');
		return $list;
	}
}

// Show price of the current product in the widgets and search results
if ( !function_exists( 'custom_made_woocommerce_get_post_info' ) ) {
	
	function custom_made_woocommerce_get_post_info($post_info='') {
		if (get_post_type()=='product') {
			global $product;
			if ( $price_html = $product->get_price_html() ) {
				$post_info = '<div class="post_price product_price price">' . trim($price_html) . '</div>' . $post_info;
			}
		}
		return $post_info;
	}
}

// Show price of the current product in the search results streampage
if ( !function_exists( 'custom_made_woocommerce_action_before_post_meta' ) ) {
	
	function custom_made_woocommerce_action_before_post_meta() {
		if (get_post_type()=='product') {
			global $product;
			if ( $price_html = $product->get_price_html() ) {
				?><div class="post_price product_price price"><?php custom_made_show_layout($price_html); ?></div><?php
			}
		}
	}
}
	
// Enqueue WooCommerce custom styles
if ( !function_exists( 'custom_made_woocommerce_frontend_scripts' ) ) {
	
	function custom_made_woocommerce_frontend_scripts() {
			if (custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('plugins/woocommerce/woocommerce.css')))
				wp_enqueue_style( 'custom-made-woocommerce',  custom_made_get_file_url('plugins/woocommerce/woocommerce.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'custom_made_woocommerce_merge_styles' ) ) {
	
	function custom_made_woocommerce_merge_styles($list) {
		$list[] = 'plugins/woocommerce/woocommerce.css';
		return $list;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'custom_made_woocommerce_tgmpa_required_plugins' ) ) {
	
	function custom_made_woocommerce_tgmpa_required_plugins($list=array()) {
		if (in_array('woocommerce', custom_made_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('WooCommerce', 'custom-made'),
					'slug' 		=> 'woocommerce',
					'required' 	=> false
				);

		return $list;
	}
}



// Add WooCommerce specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( !function_exists( 'custom_made_woocommerce_list_sidebars' ) ) {
	
	function custom_made_woocommerce_list_sidebars($list=array()) {
		$list['woocommerce_widgets'] = esc_html__('WooCommerce Widgets', 'custom-made');
		return $list;
	}
}




// Decorate WooCommerce output: Loop
//------------------------------------------------------------------------

// Before main content
if ( !function_exists( 'custom_made_woocommerce_wrapper_start' ) ) {
	
	function custom_made_woocommerce_wrapper_start() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			<article class="post_item_single post_type_product">
			<?php
		} else {
			?>
			<div class="list_products shop_mode_<?php echo !custom_made_storage_empty('shop_mode') ? custom_made_storage_get('shop_mode') : 'thumbs'; ?>">
				<div class="list_products_header">
			<?php
		}
	}
}

// After main content
if ( !function_exists( 'custom_made_woocommerce_wrapper_end' ) ) {
	
	function custom_made_woocommerce_wrapper_end() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			</article><!-- /.post_item_single -->
			<?php
		} else {
			?>
			</div><!-- /.list_products -->
			<?php
		}
	}
}

// Close header section
if ( !function_exists( 'custom_made_woocommerce_archive_description' ) ) {
	
	function custom_made_woocommerce_archive_description() {
		?>
		</div><!-- /.list_products_header -->
		<?php
	}
}

// Add list mode buttons
if ( !function_exists( 'custom_made_woocommerce_before_shop_loop' ) ) {
	
	function custom_made_woocommerce_before_shop_loop() {
		?>
		<div class="custom_made_shop_mode_buttons"><form action="<?php echo esc_url(custom_made_get_current_url()); ?>" method="post"><input type="hidden" name="custom_made_shop_mode" value="<?php echo esc_attr(custom_made_storage_get('shop_mode')); ?>" /><a href="#" class="woocommerce_thumbs icon-th" title="<?php esc_attr_e('Show products as thumbs', 'custom-made'); ?>"></a><a href="#" class="woocommerce_list icon-th-list" title="<?php esc_attr_e('Show products as list', 'custom-made'); ?>"></a></form></div><!-- /.custom_made_shop_mode_buttons -->
		<?php
	}
}

// Add column class into product item in shop streampage
if ( !function_exists( 'custom_made_woocommerce_loop_shop_columns_class' ) ) {
	
	
	function custom_made_woocommerce_loop_shop_columns_class($class, $class2='', $cat='') {
		if (!is_product() && !is_cart() && !is_checkout() && !is_account_page()) {
			$cols = function_exists('wc_get_default_products_per_row') ? wc_get_default_products_per_row() : 2;
			$class[] = ' column-1_' . $cols;
		}
		return $class;
	}
}


// Open item wrapper for categories and products
if ( ! function_exists( 'custom_made_woocommerce_item_wrapper_start' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'custom_made_woocommerce_item_wrapper_start', 9 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'custom_made_woocommerce_item_wrapper_start', 9 );
	function custom_made_woocommerce_item_wrapper_start( $cat = '' ) {
		custom_made_storage_set( 'in_product_item', true );
		$hover = custom_made_get_theme_option( 'shop_hover' );
		?>
		<div class="post_item post_layout_<?php
			echo esc_attr( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()
				? custom_made_storage_get( 'shop_mode' )
				: 'thumbs'
			);
			?>"

		>
			<div class="post_featured hover_<?php echo esc_attr( $hover ); ?>">
				<?php do_action( 'custom_made_action_woocommerce_item_featured_start' ); ?>
				<a href="<?php echo esc_url( is_object( $cat ) ? get_term_link( $cat->slug, 'product_cat' ) : get_permalink() ); ?>">
				<?php
				do_action( 'custom_made_action_woocommerce_item_featured_link_start' );
	}
}

// Add label 'out of stock'
if ( ! function_exists( 'custom_made_woocommerce_add_out_of_stock_label' ) ) {
	//Handler of the add_action( 'custom_made_action_woocommerce_item_featured_link_start', 'custom_made_woocommerce_add_out_of_stock_label' );
	function custom_made_woocommerce_add_out_of_stock_label() {
		global $product;
		$cat = custom_made_storage_get( 'in_product_category' );
		if ( empty($cat) || ! is_object($cat) ) {
			if ( is_object( $product ) && ! $product->is_in_stock() ) {
				?>
				<span class="outofstock_label"><?php esc_html_e( 'Out of stock', 'custom-made' ); ?></span>
				<?php
			}
		}
	}
}


// Open item wrapper for categories and products
if ( !function_exists( 'custom_made_woocommerce_open_item_wrapper' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'custom_made_woocommerce_title_wrapper_start', 20 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'custom_made_woocommerce_title_wrapper_start', 20 );
function custom_made_woocommerce_title_wrapper_start($cat='') {
	?>
	</a>
	<?php
	if (($hover = custom_made_get_theme_option('shop_hover')) != 'none') {
		?><div class="mask"></div><?php
		custom_made_hovers_add_icons($hover, array('cat'=>$cat));
	}
	?>
	</div><!-- /.post_featured -->
	<div class="post_data">
	<div class="post_header entry-header">
	<?php
}
}



// Display product's tags before the title
if ( !function_exists( 'custom_made_woocommerce_title_tags' ) ) {
	
	function custom_made_woocommerce_title_tags() {
		global $product;
		custom_made_show_layout(wc_get_product_tag_list( $product->get_id(), ', ', '<div class="post_tags product_tags">', '</div>' ));
	}
}

// Wrap product title into link
if ( !function_exists( 'custom_made_woocommerce_the_title' ) ) {
	
	function custom_made_woocommerce_the_title($title) {
		if (custom_made_storage_get('in_product_item') && get_post_type()=='product') {
			$title = '<a href="'.get_permalink().'">'.esc_html($title).'</a>';
		}
		return $title;
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'custom_made_woocommerce_title_wrapper_end' ) ) {
	
	function custom_made_woocommerce_title_wrapper_end() {
		?>
			</div><!-- /.post_header -->
		<?php
		if (custom_made_storage_get('shop_mode') == 'list' && (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()) && !is_product()) {
		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
			?>
			<div class="post_content entry-content"><?php custom_made_show_layout($excerpt); ?></div>
			<?php
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'custom_made_woocommerce_title_wrapper_end2' ) ) {
	
	function custom_made_woocommerce_title_wrapper_end2($category) {
		?>
			</div><!-- /.post_header -->
		<?php
		if (custom_made_storage_get('shop_mode') == 'list' && is_shop() && !is_product()) {
			?>
			<div class="post_content entry-content"><?php custom_made_show_layout($category->description); ?></div><!-- /.post_content -->
			<?php
		}
	}
}

// Close item wrapper for categories and products
if ( !function_exists( 'custom_made_woocommerce_close_item_wrapper' ) ) {
	
	
	function custom_made_woocommerce_item_wrapper_end($cat='') {
		?>
			</div><!-- /.post_data -->
		</div><!-- /.post_item -->
		<?php
		custom_made_storage_set('in_product_item', false);
	}
}

// Change text on 'Add to cart' button
if ( ! function_exists( 'custom_made_woocommerce_add_to_cart_text' ) ) {
    function custom_made_woocommerce_add_to_cart_text( $text = '' ) {
        global $product;
        return is_object( $product ) && $product->is_in_stock() && $product->is_purchasable()
			&& 'grouped' !== $product->get_type()
			&& 'variable' !== $product->get_type()
			&& ( 'external' !== $product->get_type() || $product->get_button_text() == '' )
            ? esc_html__( 'Buy now', 'custom-made' )
            : $text;
    }
}

// Decorate price
if ( !function_exists( 'custom_made_woocommerce_get_price_html' ) ) {
	
	function custom_made_woocommerce_get_price_html($price='') {
		if (!empty($price)) {
			$sep = get_option('woocommerce_price_decimal_sep');
			if (empty($sep)) $sep = '.';
			$price = preg_replace('/([0-9,]+)(\\'.trim($sep).')([0-9]{2})/', '\\1<span class="decimals">\\3</span>', $price);
		}
		return $price;
	}
}

if ( ! function_exists( 'custom_made_woocommerce_price_filter_widget_step' ) ) {
    add_filter('woocommerce_price_filter_widget_step', 'custom_made_woocommerce_price_filter_widget_step');
    function custom_made_woocommerce_price_filter_widget_step( $step = '' ) {
        $step = 1;
        return $step;
    }
}



// Decorate WooCommerce output: Single product
//------------------------------------------------------------------------

// Hide sidebar on the single products and pages
if ( !function_exists( 'custom_made_woocommerce_sidebar_present' ) ) {
	
	function custom_made_woocommerce_sidebar_present($present) {
		return is_product() || is_cart() || is_checkout() || is_account_page() ? false : $present;
	}
}

// Add Product ID for the single product
if ( !function_exists( 'custom_made_woocommerce_show_product_id' ) ) {
	
	function custom_made_woocommerce_show_product_id() {
		$authors = wp_get_post_terms(get_the_ID(), 'pa_product_author');
		if (is_array($authors) && count($authors)>0) {
			echo '<span class="product_author">'.esc_html__('Author: ', 'custom-made');
			$delim = '';
			foreach ($authors as $author) {
				echo  esc_html($delim) . '<span>' . esc_html($author->name) . '</span>';
				$delim = ', ';
			}
			echo '</span>';
		}
		echo '<span class="product_id">'.esc_html__('Product ID: ', 'custom-made') . '<span>' . get_the_ID() . '</span></span>';
	}
}

// Number columns for the product's thumbnails
if ( !function_exists( 'custom_made_woocommerce_product_thumbnails_columns' ) ) {
	
	function custom_made_woocommerce_product_thumbnails_columns($cols) {
		return 4;
	}
}

// Set columns number for the related products
if ( !function_exists( 'custom_made_woocommerce_output_related_products_args' ) ) {
	
	function custom_made_woocommerce_output_related_products_args($args) {
		$args['posts_per_page'] = $args['columns'] = max(2, min(4, custom_made_get_theme_option('related_posts')));
		return $args;
	}
}



// Decorate WooCommerce output: Widgets
//------------------------------------------------------------------------

// Search form
if ( !function_exists( 'custom_made_woocommerce_get_product_search_form' ) ) {
	
	function custom_made_woocommerce_get_product_search_form($form, $role = 'search') {
		return '
		<form role="' . esc_attr( $role ) . '" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__('Search for products &hellip;', 'custom-made') . '" value="' . get_search_query() . '" name="s" /><button class="search_button" type="submit">' . esc_html__('Search', 'custom-made') . '</button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}



// Add WooCommerce specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'custom_made_woocommerce_get_css' ) ) {
	
	function custom_made_woocommerce_get_css($css, $colors, $fonts) {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

.woocommerce .checkout table.shop_table .product-name .variation,
.woocommerce .shop_table.order_details td.product-name .variation {
	{$fonts['p_font-family']}
}
#btn-buy,
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
.woocommerce ul.products li.product .post_header, .woocommerce-page ul.products li.product .post_header,
.woocommerce ul.products li.product .button, .woocommerce div.product form.cart .button,
.woocommerce .woocommerce-message .button,
.woocommerce #review_form #respond p.form-submit input[type="submit"], .woocommerce-page #review_form #respond p.form-submit input[type="submit"],
.woocommerce table.my_account_orders .order-actions .button,
.woocommerce .button, .woocommerce-page .button,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button
.woocommerce #respond input#submit,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"],
.woocommerce .shop_table th,
.woocommerce span.onsale,
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce div.product p.price, .woocommerce div.product span.price,
.woocommerce div.product .summary .stock,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong, .woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta strong,
.woocommerce table.cart td.product-name a, .woocommerce-page table.cart td.product-name a, 
.woocommerce #content table.cart td.product-name a, .woocommerce-page #content table.cart td.product-name a,
.woocommerce .checkout table.shop_table .product-name,
.woocommerce .shop_table.order_details td.product-name,
.woocommerce .order_details li strong,
.woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-content .woocommerce-Address-title a,
.woocommerce td.product-name dl.variation {
	{$fonts['h5_font-family']}
}
.woocommerce ul.products li.product .post_header .post_tags,
.woocommerce div.product .product_meta span > span, .woocommerce div.product .product_meta span > a,
.woocommerce div.product form.cart .reset_variations,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta time, .woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta time {
	{$fonts['info_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Page header */
.woocommerce .woocommerce-breadcrumb {
	color: {$colors['text']};
}
.woocommerce .woocommerce-breadcrumb a {
	color: {$colors['text_link']};
}
.woocommerce .woocommerce-breadcrumb a:hover {
	color: {$colors['text_hover']};
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: {$colors['text_link']};
}

/* List and Single product */
.woocommerce .woocommerce-ordering select {
	border-color: {$colors['bd_color']};
}
.woocommerce span.onsale {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.woocommerce ul.products li.product .post_featured {
	color: {$colors['bd_color']};
}
.woocommerce ul.products li.product .post_header a {
	color: {$colors['text_dark']};
}
.woocommerce ul.products li.product .post_header a:hover {
	color: {$colors['text_link']};
}
.woocommerce ul.products li.product .post_header .post_tags,
.woocommerce ul.products li.product .post_header .post_tags a {
	color: {$colors['text_link']};
}
.woocommerce ul.products li.product .post_header .post_tags a:hover {
	color: {$colors['text_hover']};
}
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins {
	color: {$colors['text_dark']};
}
.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del {
	color: {$colors['text_light']};
}

.woocommerce div.product p.price, .woocommerce div.product span.price,
.woocommerce span.amount, .woocommerce-page span.amount {
	color: {$colors['text_link']};
}
.woocommerce table.shop_table td span.amount {
	color: {$colors['text_dark']};
}
aside.woocommerce del,
.woocommerce del, .woocommerce del > span.amount, 
.woocommerce-page del, .woocommerce-page del > span.amount {
	color: {$colors['text_light']} !important;
}
.woocommerce .price del:before {
	background-color: {$colors['text_light']};
}
.woocommerce-page form.woocommerce-cart-form div.quantity span,
.woocommerce div.product form.cart div.quantity span, 
.woocommerce-page div.product form.cart div.quantity span {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.woocommerce-page form.woocommerce-cart-form div.quantity span:hover,
.woocommerce div.product form.cart div.quantity span:hover, 
.woocommerce-page div.product form.cart div.quantity span:hover {
	background-color: {$colors['text_hover']};
}
.woocommerce-page form.woocommerce-cart-form div.quantity,
.woocommerce div.product form.cart div.quantity, .woocommerce-page div.product form.cart div.quantity,
.woocommerce div.product form.cart div.quantity input[type="number"], .woocommerce-page div.product form.cart div.quantity input[type="number"] {
	border-color: {$colors['text_link']};
}

.woocommerce div.product .product_meta span > a,
.woocommerce div.product .product_meta span > span {
	color: {$colors['text_dark']};
}
.woocommerce div.product .product_meta a:hover {
	color: {$colors['text_link']};
}

.woocommerce div.product div.images img {
	border-color: {$colors['bd_color']};
}
.woocommerce div.product div.images a:hover img {
	border-color: {$colors['text_link']};
}

.single-product div.product .trx-stretch-width .woocommerce-tabs .wc-tabs li a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.single-product div.product .trx-stretch-width .woocommerce-tabs .wc-tabs li.active a,
.single-product div.product .trx-stretch-width .woocommerce-tabs .wc-tabs li a:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.woocommerce table.shop_attributes tr:nth-child(2n+1) > th {
	background-color: {$colors['alter_bg_color_04']};
}
.woocommerce table.shop_attributes tr:nth-child(2n) > th {
	background-color: {$colors['alter_bg_color_02']};
}
.woocommerce table.shop_attributes th {
	color: {$colors['text_dark']};
}


/* Related Products */
.single-product .related {
	border-color: {$colors['bd_color']};
}
.single-product ul.products li.product .post_data {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_dark']};
}
.single-product ul.products li.product .post_data .price span.amount {
	color: {$colors['inverse_text']};
}
.single-product ul.products li.product .post_data .post_header .post_tags,
.single-product ul.products li.product .post_data .post_header .post_tags a,
.single-product ul.products li.product .post_data a {
	color: {$colors['inverse_text']};
}
.single-product ul.products li.product .post_data .post_header .post_tags a:hover,
.single-product ul.products li.product .post_data a:hover {
	color: {$colors['text_link']};
}
.single-product ul.products li.product .post_data .button {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.single-product ul.products li.product .post_data .button:hover {
	color: {$colors['text_link']} !important;
	background-color: {$colors['inverse_text']};
	border-color: {$colors['inverse_text']};
}

/* Rating */
.star-rating span,
.star-rating:before {
	color: {$colors['text_link']};
}
.woocommerce #review_form #respond p.form-submit input[type="submit"],
#review_form #respond p.form-submit input[type="submit"] {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.woocommerce #review_form #respond p.form-submit input[type="submit"]:hover,
#review_form #respond p.form-submit input[type="submit"]:hover,
#review_form #respond p.form-submit input[type="submit"]:focus {
	color: {$colors['text_dark']} !important;
	background-color: {$colors['bg_color']};
	border-color: {$colors['text_dark']};
}

/* Buttons */
.custom_made_shop_mode_buttons a {
	color: {$colors['text_dark']};
}
.custom_made_shop_mode_buttons a:hover {
	color: {$colors['text_link']};
}
.woocommerce #respond input#submit,
.woocommerce .button, .woocommerce-page .button,
.woocommerce a.button, .woocommerce-page a.button,
.woocommerce button.button, .woocommerce-page button.button,
.woocommerce input.button, .woocommerce-page input.button,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"] {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.woocommerce #respond input#submit:hover,
.woocommerce .button:hover, .woocommerce-page .button:hover,
.woocommerce a.button:hover, .woocommerce-page a.button:hover,
.woocommerce button.button:hover, .woocommerce-page button.button:hover,
.woocommerce input.button:hover, .woocommerce-page input.button:hover,
.woocommerce input[type="button"]:hover, .woocommerce-page input[type="button"]:hover,
.woocommerce input[type="submit"]:hover, .woocommerce-page input[type="submit"]:hover{
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

.woocommerce.widget_shopping_cart .buttons a.checkout, 
.woocommerce .widget_shopping_cart .buttons a.checkout, 
.woocommerce-page.widget_shopping_cart .buttons a.checkout, 
.woocommerce-page .widget_shopping_cart .buttons a.checkout {
	background: linear-gradient(to right,	{$colors['bg_color']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_dark']} !important; 
	border-color: {$colors['text_dark']};
}
.woocommerce.widget_shopping_cart .buttons a.checkout:hover, 
.woocommerce .widget_shopping_cart .buttons a.checkout:hover, 
.woocommerce-page.widget_shopping_cart .buttons a.checkout:hover, 
.woocommerce-page .widget_shopping_cart .buttons a.checkout:hover {
	background-position: left bottom !important;
}

.woocommerce nav.woocommerce-pagination ul li a {
	color: {$colors['text_light']};
	border-color: {$colors['text_light']};
	background: linear-gradient(to right,	{$colors['bg_color']} 50%, {$colors['bg_color']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['bg_color']} !important; 
}

.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background: linear-gradient(to right,	{$colors['bg_color']} 50%, {$colors['bg_color']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['bg_color']} !important; 
}

.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce div.product form.cart .button {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce div.product form.cart .button:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}


/* Messages */
.woocommerce .woocommerce-message,
.woocommerce .woocommerce-info {
	background-color: {$colors['bd_color']};
	border-top-color: {$colors['text_dark']};
}
.woocommerce .woocommerce-error {
	background-color: {$colors['bd_color']};
	border-top-color: {$colors['text_link']};
}
.woocommerce .woocommerce-message:before,
.woocommerce .woocommerce-info:before {
	color: {$colors['text_dark']};
}
.woocommerce .woocommerce-error:before {
	color: {$colors['text_link']};
}
#btn-buy,
.woocommerce .woocommerce-message .button,
.woocommerce .woocommerce-error .button,
.woocommerce .woocommerce-info .button {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
#btn-buy:hover,
.woocommerce .woocommerce-message .button:hover,
.woocommerce .woocommerce-info .button:hover {
	color: {$colors['text_dark']};
	background-color: {$colors['inverse_text']};
	border-color: {$colors['text_dark']};
}


/* Cart */
.woocommerce table.shop_table td {
	border-color: {$colors['bd_color']} !important;
}
.woocommerce table.shop_table th {
	border-color: {$colors['bd_color']} !important;
}
.woocommerce table.shop_table tfoot th, .woocommerce-page table.shop_table tfoot th {
	color: {$colors['text_dark']};
	border-color: transparent !important;
	background-color: transparent;
}
.woocommerce .quantity input.qty, .woocommerce #content .quantity input.qty, .woocommerce-page .quantity input.qty, .woocommerce-page #content .quantity input.qty {
	color: {$colors['input_dark']};
}
.woocommerce .cart-collaterals .cart_totals table select, .woocommerce-page .cart-collaterals .cart_totals table select {
	color: {$colors['input_light']};
	background-color: {$colors['input_bg_color']};
}
.woocommerce .cart-collaterals .cart_totals table select:focus, .woocommerce-page .cart-collaterals .cart_totals table select:focus {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_hover']};
}
.woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button:after, .woocommerce-page .cart-collaterals .shipping_calculator .shipping-calculator-button:after {
	color: {$colors['text_dark']};
}
.woocommerce table.shop_table .cart-subtotal .amount, .woocommerce-page table.shop_table .cart-subtotal .amount,
.woocommerce table.shop_table .shipping td, .woocommerce-page table.shop_table .shipping td {
	color: {$colors['text_dark']};
}
.woocommerce table.cart td+td a, .woocommerce #content table.cart td+td a, .woocommerce-page table.cart td+td a, .woocommerce-page #content table.cart td+td a,
.woocommerce table.cart td+td span, .woocommerce #content table.cart td+td span, .woocommerce-page table.cart td+td span, .woocommerce-page #content table.cart td+td span {
	color: {$colors['text_dark']};
}
.woocommerce table.cart td+td a:hover, .woocommerce #content table.cart td+td a:hover, .woocommerce-page table.cart td+td a:hover, .woocommerce-page #content table.cart td+td a:hover {
	color: {$colors['text_link']};
}
#add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text {
	border-color: {$colors['input_bd_color']};
}
.woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li img, .woocommerce-page ul.cart_list li img, .woocommerce-page ul.product_list_widget li img {
	border-color: {$colors['bd_color']};
}
.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled] {
	color: {$colors['inverse_text']};
}
.woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}

/* Checkout */
.woocommerce-checkout #payment {
	background-color:{$colors['bd_color']};
}
.woocommerce .order_details li strong, .woocommerce-page .order_details li strong {
	color: {$colors['text_dark']};
}
.woocommerce .order_details.woocommerce-thankyou-order-details {
	color:{$colors['alter_text']};
	background-color:{$colors['bd_color']};
}
.woocommerce .order_details.woocommerce-thankyou-order-details strong {
	color:{$colors['alter_dark']};
}
.woocommerce-checkout .woocommerce .order_details.woocommerce-thankyou-order-details strong {
	color:{$colors['text_dark']};
}

/* My Account */
.woocommerce-account .woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-navigation ul li,
.woocommerce-MyAccount-navigation li+li {
	border-color: {$colors['bd_color']};
}
.woocommerce-MyAccount-navigation li.is-active a {
	color: {$colors['text_link']};
}

/* Widgets */
.widget_product_search form:after {
	color: {$colors['input_light']};
}
.widget_product_search form:hover:after {
	color: {$colors['input_dark']};
}
.widget_product_search .search_button {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_text']};
}
.widget_shopping_cart .total {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}
.widget_layered_nav ul li.chosen a {
	color: {$colors['text_dark']};
}
.widget_price_filter .price_slider_wrapper .ui-widget-content { 
	background: {$colors['text_light']};
}
.widget_price_filter .price_label span {
	color: {$colors['text_dark']};
}

.woocommerce .shop_mode_thumbs .custom_made_shop_mode_buttons .woocommerce_thumbs,
.woocommerce .shop_mode_list .custom_made_shop_mode_buttons .woocommerce_list{
    color: {$colors['text_link']};
}

.woocommerce .shop_mode_thumbs .custom_made_shop_mode_buttons .woocommerce_list,
.woocommerce .shop_mode_list .custom_made_shop_mode_buttons .woocommerce_thumbs{
    color: {$colors['text_hover']};
}

.woocommerce .shop_mode_thumbs .custom_made_shop_mode_buttons .woocommerce_list:hover,
.woocommerce .shop_mode_list .custom_made_shop_mode_buttons .woocommerce_thumbs:hover{
    color: {$colors['text_link']};
}

.woocommerce table.shop_attributes,
.woocommerce table.shop_attributes th,
.woocommerce table.shop_attributes td {
	border-color: {$colors['bd_color']};
}

.woocommerce form .show-password-input,
.woocommerce-page form .show-password-input {
	background-color: transparent !important;
	color: {$colors['text_dark']};
}

CSS;
		}
		
		return $css;
	}
}
?>