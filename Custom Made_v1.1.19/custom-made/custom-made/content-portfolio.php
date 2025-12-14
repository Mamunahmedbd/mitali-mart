<?php
/**
 * The Portfolio template for displaying content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($custom_made_columns).' post_format_'.esc_attr($custom_made_post_format) ); ?>
	<?php echo (!custom_made_is_off($custom_made_animation) ? ' data-animation="'.esc_attr(custom_made_get_animation_classes($custom_made_animation)).'"' : ''); ?>
	>

	<?php
	$custom_made_image_hover = custom_made_get_theme_option('image_hover');
	// Featured image
	custom_made_show_post_featured(array(
		'thumb_size' => custom_made_get_thumb_size(strpos(custom_made_get_theme_option('body_style'), 'full')!==false || $custom_made_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $custom_made_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $custom_made_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>