<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

custom_made_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', custom_made_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', custom_made_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', custom_made_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'custom-made-gallery-script', custom_made_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$custom_made_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$custom_made_sticky_out = is_array($custom_made_stickies) && count($custom_made_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$custom_made_show_filters = custom_made_get_theme_option('show_filters');
	$custom_made_tabs = array();
	
	$custom_made_id = $custom_made_cat = $custom_made_taxonomy = $custom_made_post_type  = '';
	
	if (!custom_made_is_off($custom_made_show_filters)) {
		$custom_made_cat = custom_made_get_theme_option('parent_cat');
		$custom_made_post_type = custom_made_get_theme_option('post_type');
		$custom_made_taxonomy = custom_made_get_post_type_taxonomy($custom_made_post_type);
		$custom_made_args = array(
			'type'			=> $custom_made_post_type,
			'child_of'		=> $custom_made_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $custom_made_taxonomy,
			'pad_counts'	=> false
		);
		$custom_made_portfolio_list = get_terms($custom_made_args);
		if (is_array($custom_made_portfolio_list) && count($custom_made_portfolio_list) > 0) {
			$custom_made_tabs[$custom_made_cat] = esc_html__('All', 'custom-made');
			foreach ($custom_made_portfolio_list as $custom_made_term) {
				if (isset($custom_made_term->term_id)) $custom_made_tabs[$custom_made_term->term_id] = $custom_made_term->name;
			}
		}
	}
	
	if (count($custom_made_tabs) > 0) {
		$custom_made_portfolio_filters_ajax = true;
		$custom_made_portfolio_filters_active = $custom_made_cat;
		$custom_made_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters custom_made_tabs custom_made_tabs_ajax">
			<ul class="portfolio_titles custom_made_tabs_titles">
				<?php
				foreach ($custom_made_tabs as $custom_made_id=>$custom_made_title) {
					?><li><a href="<?php echo esc_url(custom_made_get_hash_link(sprintf('#%s_%s_content', $custom_made_portfolio_filters_id, $custom_made_id))); ?>" data-tab="<?php echo esc_attr($custom_made_id); ?>"><?php echo esc_html($custom_made_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$custom_made_ppp = custom_made_get_theme_option('posts_per_page');
			if (custom_made_is_inherit($custom_made_ppp)) $custom_made_ppp = '';
			foreach ($custom_made_tabs as $custom_made_id=>$custom_made_title) {
				$custom_made_portfolio_need_content = $custom_made_id==$custom_made_portfolio_filters_active || !$custom_made_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $custom_made_portfolio_filters_id, $custom_made_id)); ?>"
					class="portfolio_content custom_made_tabs_content"
					data-blog-template="<?php echo esc_attr(custom_made_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(custom_made_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($custom_made_ppp); ?>"
					data-post-type="<?php echo esc_attr($custom_made_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($custom_made_taxonomy); ?>"
					data-cat="<?php echo esc_attr($custom_made_id); ?>"
					data-parent-cat="<?php echo esc_attr($custom_made_cat); ?>"
					data-need-content="<?php echo (false===$custom_made_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($custom_made_portfolio_need_content) 
						custom_made_show_portfolio_posts(array(
							'cat' => $custom_made_id,
							'parent_cat' => $custom_made_cat,
							'taxonomy' => $custom_made_taxonomy,
							'post_type' => $custom_made_post_type,
							'page' => 1,
							'sticky' => $custom_made_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		custom_made_show_portfolio_posts(array(
			'cat' => $custom_made_id,
			'parent_cat' => $custom_made_cat,
			'taxonomy' => $custom_made_taxonomy,
			'post_type' => $custom_made_post_type,
			'page' => 1,
			'sticky' => $custom_made_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>