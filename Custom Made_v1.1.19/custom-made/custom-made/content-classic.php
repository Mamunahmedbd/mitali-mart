<?php
/**
 * The Classic template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_blog_style = explode('_', custom_made_get_theme_option('blog_style'));
$custom_made_columns = empty($custom_made_blog_style[1]) ? 2 : max(2, $custom_made_blog_style[1]);
$custom_made_expanded = !custom_made_sidebar_present() && custom_made_is_on(custom_made_get_theme_option('expand_content'));
$custom_made_post_format = get_post_format();
$custom_made_post_format = empty($custom_made_post_format) ? 'standard' : str_replace('post-format-', '', $custom_made_post_format);
$custom_made_animation = custom_made_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($custom_made_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_classic post_layout_classic_'.esc_attr($custom_made_columns).' post_format_'.esc_attr($custom_made_post_format) ); ?>
	<?php echo (!custom_made_is_off($custom_made_animation) ? ' data-animation="'.esc_attr(custom_made_get_animation_classes($custom_made_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	custom_made_show_post_featured( array( 'thumb_size' => custom_made_get_thumb_size(
													strpos(custom_made_get_theme_option('body_style'), 'full')!==false 
														? ( $custom_made_columns > 2 ? 'big' : 'huge' )
														: (	$custom_made_columns > 2
															? ($custom_made_expanded ? 'med' : 'small')
															: ($custom_made_expanded ? 'big' : 'med')
															)
														)
										) );

	if ( !in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('custom_made_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('custom_made_action_before_post_meta'); 

			// Post meta
			custom_made_show_post_meta(array(
				'categories' => true,
				'date' => true,
				'edit' => $custom_made_columns < 3,
				'seo' => false,
				'share' => false,
				'counters' => 'comments',
				)
			);
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$custom_made_show_learn_more = true; 
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote'))) {
			custom_made_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $custom_made_show_learn_more ) {
			?><p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'custom-made'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>