<?php
/**
 * The template for displaying posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_post_id    = get_the_ID();
$custom_made_post_date  = custom_made_get_date();
$custom_made_post_title = get_the_title();
$custom_made_post_link  = get_permalink();
$custom_made_post_author_id   = get_the_author_meta('ID');
$custom_made_post_author_name = get_the_author_meta('display_name');
$custom_made_post_author_url  = get_author_posts_url($custom_made_post_author_id, '');

$custom_made_args = get_query_var('custom_made_args_widgets_posts');
$custom_made_show_date = isset($custom_made_args['show_date']) ? (int) $custom_made_args['show_date'] : 1;
$custom_made_show_image = isset($custom_made_args['show_image']) ? (int) $custom_made_args['show_image'] : 1;
$custom_made_show_author = isset($custom_made_args['show_author']) ? (int) $custom_made_args['show_author'] : 1;
$custom_made_show_counters = isset($custom_made_args['show_counters']) ? (int) $custom_made_args['show_counters'] : 1;
$custom_made_show_categories = isset($custom_made_args['show_categories']) ? (int) $custom_made_args['show_categories'] : 1;

$custom_made_output = custom_made_storage_get('custom_made_output_widgets_posts');

$custom_made_post_counters_output = '';
if ( $custom_made_show_counters ) {
	$custom_made_post_counters_output = '<span class="post_info_item post_info_counters">'
								. custom_made_get_post_counters('comments')
							. '</span>';
}


$custom_made_output .= '<article class="post_item with_thumb">';

if ($custom_made_show_image) {
	$custom_made_post_thumb = get_the_post_thumbnail($custom_made_post_id, custom_made_get_thumb_size('tiny'), array(
		'alt' => the_title_attribute( array( 'echo' => false ) )
	));
	if ($custom_made_post_thumb) $custom_made_output .= '<div class="post_thumb">' . ($custom_made_post_link ? '<a href="' . esc_url($custom_made_post_link) . '">' : '') . ($custom_made_post_thumb) . ($custom_made_post_link ? '</a>' : '') . '</div>';
}

$custom_made_output .= '<div class="post_content">'
			. ($custom_made_show_categories 
					? '<div class="post_categories">'
						. custom_made_get_post_categories()
						. $custom_made_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($custom_made_post_link ? '<a href="' . esc_url($custom_made_post_link) . '">' : '') . ($custom_made_post_title) . ($custom_made_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('custom_made_filter_get_post_info', 
								'<div class="post_info">'
									. ($custom_made_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($custom_made_post_link ? '<a href="' . esc_url($custom_made_post_link) . '" class="post_info_date">' : '') 
											. esc_html($custom_made_post_date) 
											. ($custom_made_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($custom_made_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'custom-made') . ' ' 
											. ($custom_made_post_link ? '<a href="' . esc_url($custom_made_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($custom_made_post_author_name) 
											. ($custom_made_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$custom_made_show_categories && $custom_made_post_counters_output
										? $custom_made_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
custom_made_storage_set('custom_made_output_widgets_posts', $custom_made_output);
?>