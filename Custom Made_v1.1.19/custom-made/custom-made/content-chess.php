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
$custom_made_columns = empty($custom_made_blog_style[1]) ? 1 : max(1, $custom_made_blog_style[1]);
$custom_made_expanded = !custom_made_sidebar_present() && custom_made_is_on(custom_made_get_theme_option('expand_content'));
$custom_made_post_format = get_post_format();
$custom_made_post_format = empty($custom_made_post_format) ? 'standard' : str_replace('post-format-', '', $custom_made_post_format);
$custom_made_animation = custom_made_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($custom_made_columns).' post_format_'.esc_attr($custom_made_post_format) ); ?>
	<?php echo (!custom_made_is_off($custom_made_animation) ? ' data-animation="'.esc_attr(custom_made_get_animation_classes($custom_made_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($custom_made_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.the_title_attribute( array( 'echo' => false ) ).'"]');
	}

	// Featured image
	custom_made_show_post_featured( array(
											'class' => $custom_made_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => custom_made_get_thumb_size(
																	strpos(custom_made_get_theme_option('body_style'), 'full')!==false
																		? ( $custom_made_columns > 1 ? 'big' : 'original' )
																		: (	$custom_made_columns > 1 ? 'med' : 'big')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('custom_made_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('custom_made_action_before_post_meta'); 

			// Post meta
			$custom_made_post_meta = custom_made_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => $custom_made_columns == 1,
									'seo' => false,
									'share' => false,
									'counters' => $custom_made_columns < 3 ? 'comments' : '',
									'echo' => false
									)
								);
			custom_made_show_layout($custom_made_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$custom_made_show_learn_more = !in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote'));
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
				custom_made_show_layout($custom_made_post_meta);
			}
			// More button
			if ( $custom_made_show_learn_more ) {
				?><p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'custom-made'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>