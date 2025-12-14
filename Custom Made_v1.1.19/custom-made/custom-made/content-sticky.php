<?php
/**
 * The Sticky template for displaying sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$custom_made_post_format = get_post_format();
$custom_made_post_format = empty($custom_made_post_format) ? 'standard' : str_replace('post-format-', '', $custom_made_post_format);
$custom_made_animation = custom_made_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($custom_made_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($custom_made_post_format) ); ?>
	<?php echo (!custom_made_is_off($custom_made_animation) ? ' data-animation="'.esc_attr(custom_made_get_animation_classes($custom_made_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	custom_made_show_post_featured(array(
		'thumb_size' => custom_made_get_thumb_size($custom_made_columns==1 ? 'big' : ($custom_made_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			custom_made_show_post_meta();
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>