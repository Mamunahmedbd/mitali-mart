<?php
/**
 * The template for displaying side menu
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */
?>
<div class="menu_side_wrap scheme_<?php echo esc_attr(custom_made_is_inherit(custom_made_get_theme_option('menu_scheme')) 
																	? (custom_made_is_inherit(custom_made_get_theme_option('header_scheme')) 
																		? custom_made_get_theme_option('color_scheme') 
																		: custom_made_get_theme_option('header_scheme')) 
																	: custom_made_get_theme_option('menu_scheme')); ?>">
	<span class="menu_side_button icon-menu-2"></span>

	<div class="menu_side_inner<?php echo esc_attr(!custom_made_is_on(custom_made_get_theme_option('menu_stretch')) ? ' menu_stretch_off' : '');?>">
		<?php
		?>
		<div class="toc_menu_item">
			<a href="#" class="toc_menu_description menu_mobile_description button_description"><span class="toc_menu_description_title"><?php esc_html_e('Main menu', 'custom-made'); ?></span></a>
			<a class="menu_mobile_button toc_menu_icon" href="#"><span><?php esc_html_e('Menu', 'custom-made'); ?></span></a>
		</div>		
		<?php
		// Main menu
		$custom_made_custom_made_menu_main = custom_made_get_nav_menu('menu_main');
		if (empty($custom_made_custom_made_menu_main)) $custom_made_custom_made_menu_main = custom_made_get_nav_menu();
		// Store menu layout for the mobile menu
		set_query_var('custom_made_menu_main', $custom_made_custom_made_menu_main);
		?>
	</div>
	
</div><!-- /.menu_side_wrap -->