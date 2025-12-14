<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_post_format = get_post_format();
$custom_made_post_format = empty($custom_made_post_format) ? 'standard' : str_replace('post-format-', '', $custom_made_post_format);
$custom_made_full_content = custom_made_get_theme_option('blog_content') != 'excerpt' || in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote'));
$custom_made_animation = custom_made_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($custom_made_post_format) ); ?>
	<?php echo (!custom_made_is_off($custom_made_animation) ? ' data-animation="'.esc_attr(custom_made_get_animation_classes($custom_made_animation)).'"' : ''); ?>
	><?php
	
	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('custom_made_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

			do_action('custom_made_action_before_post_meta'); 

			// Post meta
			custom_made_show_post_meta(array(
				'categories' => false,
				'date' => true,
				'author' => true,
				'edit' => false,
				'seo' => false,
				'share' => false,
				'counters' => 'comments'
				)
			);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Featured image
	custom_made_show_post_featured(array( 'thumb_size' => custom_made_get_thumb_size( strpos(custom_made_get_theme_option('body_style'), 'full')!==false ? 'full' : 'huge' ) ));

	// Post content
	?><div class="post_content entry-content"><?php
		if ($custom_made_full_content) {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'custom-made' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'custom-made' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$custom_made_show_learn_more = !in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($custom_made_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $custom_made_show_learn_more ) {
				?><p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'custom-made'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>