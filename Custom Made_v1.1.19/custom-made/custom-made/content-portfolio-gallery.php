<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_blog_style = explode('_', custom_made_get_theme_option('blog_style'));
$custom_made_columns = empty($custom_made_blog_style[1]) ? 2 : max(2, $custom_made_blog_style[1]);
$custom_made_post_format = get_post_format();
$custom_made_post_format = empty($custom_made_post_format) ? 'standard' : str_replace('post-format-', '', $custom_made_post_format);
$custom_made_animation = custom_made_get_theme_option('blog_animation');
$custom_made_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($custom_made_columns).' post_format_'.esc_attr($custom_made_post_format) ); ?>
	<?php echo (!custom_made_is_off($custom_made_animation) ? ' data-animation="'.esc_attr(custom_made_get_animation_classes($custom_made_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($custom_made_image[1]) && !empty($custom_made_image[2])) echo intval($custom_made_image[1]) .'x' . intval($custom_made_image[2]); ?>"
	data-src="<?php if (!empty($custom_made_image[0])) echo esc_url($custom_made_image[0]); ?>"
	>

	<?php
	$custom_made_image_hover = 'icon';	
	if (in_array($custom_made_image_hover, array('icons', 'zoom'))) $custom_made_image_hover = 'dots';
	// Featured image
	custom_made_show_post_featured(array(
		'hover' => $custom_made_image_hover,
		'thumb_size' => custom_made_get_thumb_size( strpos(custom_made_get_theme_option('body_style'), 'full')!==false || $custom_made_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. custom_made_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'custom-made') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>