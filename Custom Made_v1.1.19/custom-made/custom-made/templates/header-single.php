<?php
/**
 * The template for displaying Featured image in the single post
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

if ( get_query_var('custom_made_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	set_query_var('custom_made_featured_showed', true);
	$custom_made_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($custom_made_src[0])) {
		?><div class="post_featured post_featured_fullwide <?php echo esc_attr(custom_made_add_inline_style('background-image:url('.esc_url($custom_made_src[0]).');')); ?>"></div><?php
	}
}
?>