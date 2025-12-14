<?php
/**
 * The template for displaying main menu
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */
$custom_made_header_image = get_query_var('custom_made_header_image');
?>
<div class="top_panel_fixed_wrap"></div>
<div class="top_panel_navi 
			<?php if ($custom_made_header_image!='') echo ' with_bg_image'; ?>
			scheme_<?php echo esc_attr(custom_made_is_inherit(custom_made_get_theme_option('menu_scheme')) 
												? (custom_made_is_inherit(custom_made_get_theme_option('header_scheme')) 
													? custom_made_get_theme_option('color_scheme') 
													: custom_made_get_theme_option('header_scheme')) 
												: custom_made_get_theme_option('menu_scheme')); ?>">
	<div class="menu_main_wrap clearfix menu_hover_<?php echo esc_attr(custom_made_get_theme_option('menu_hover')); ?>">
		<div class="content_wrap">
			<?php
			// Filter header components
			$custom_made_header_parts = apply_filters('custom_made_filter_header_parts', array(
				'logo' => true,
				'menu' => true,
				'socials' => true,
				'search' => true
				),
				'menu_main');
			
			// Logo
			if (!empty($custom_made_header_parts['logo'])) {
				get_template_part( 'templates/header-logo' );
			}
			
			// Display search field
			if (!empty($custom_made_header_parts['search'])) {
				set_query_var('custom_made_search_in_header', true);
				get_template_part( 'templates/search-field' );
			}
			
			// Display socials
			if (!empty($custom_made_header_parts['socials'])) {
				custom_made_show_layout(custom_made_get_socials_links(), '<div class="social_wrap">', '</div>');
			}
			
			// Main menu
			if (!empty($custom_made_header_parts['menu'])) {
				$custom_made_custom_made_menu_main = custom_made_get_nav_menu('menu_main');
				if (empty($custom_made_custom_made_menu_main)) $custom_made_custom_made_menu_main = custom_made_get_nav_menu();
				custom_made_show_layout($custom_made_custom_made_menu_main);
				// Store menu layout for the mobile menu
				set_query_var('custom_made_menu_main', $custom_made_custom_made_menu_main);
			}
			?>
		</div>
	</div>
</div><!-- /.top_panel_navi -->