<?php
/**
 * The template to display custom header from the Custom Made Addons Layouts
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0.06
 */

$custom_made_header_css = $custom_made_header_image = '';
$custom_made_header_video = wp_is_mobile() ? '' : custom_made_get_theme_option('header_video');
if (true || empty($custom_made_header_video)) {
	$custom_made_header_image = get_header_image();
	if (custom_made_is_on(custom_made_get_theme_option('header_image_override')) && apply_filters('custom_made_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($custom_made_cat_img = custom_made_get_category_image()) != '')
				$custom_made_header_image = $custom_made_cat_img;
		} else if (is_singular() || custom_made_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$custom_made_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($custom_made_header_image)) $custom_made_header_image = $custom_made_header_image[0];
			} else
				$custom_made_header_image = '';
		}
	}
}

// Store header image for navi
set_query_var('custom_made_header_image', $custom_made_header_image || $custom_made_header_video);

// Get post with custom header
$custom_made_header_id = str_replace('header-custom-', '', custom_made_get_theme_option("header_style"));
$custom_made_header_post = get_post($custom_made_header_id);

if (!empty($custom_made_header_post->post_content)) {
	?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($custom_made_header_id);
						echo !empty($custom_made_header_image) || !empty($custom_made_header_video) ? ' with_bg_image' : ' without_bg_image';
						if ($custom_made_header_video!='') echo ' with_bg_video';
						if ($custom_made_header_image!='') echo ' '.esc_attr(custom_made_add_inline_style('background-image: url('.esc_url($custom_made_header_image).');'));
						if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
						?> scheme_<?php echo esc_attr(custom_made_is_inherit(custom_made_get_theme_option('header_scheme')) 
														? custom_made_get_theme_option('color_scheme') 
														: custom_made_get_theme_option('header_scheme'));
						?>"><?php
		
		custom_made_show_layout(do_shortcode($custom_made_header_post->post_content));
		
	?></header><?php
}
?>