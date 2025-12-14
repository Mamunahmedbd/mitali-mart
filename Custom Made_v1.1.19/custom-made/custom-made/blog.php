<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$custom_made_content = '';
$custom_made_blog_archive_mask = '%%CONTENT%%';
$custom_made_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $custom_made_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (trim( get_the_content() ) != '' && ($custom_made_content = apply_filters('the_content', get_the_content())) != '') {
		if (($custom_made_pos = strpos($custom_made_content, $custom_made_blog_archive_mask)) !== false) {
			$custom_made_content = preg_replace('/(\<p\>\s*)?'.$custom_made_blog_archive_mask.'(\s*\<\/p\>)/i', $custom_made_blog_archive_subst, $custom_made_content);
		} else
			$custom_made_content .= $custom_made_blog_archive_subst;
		$custom_made_content = explode($custom_made_blog_archive_mask, $custom_made_content);
	}
}

// Make new query
$custom_made_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$custom_made_args = custom_made_query_add_posts_and_cats($custom_made_args, '', custom_made_get_theme_option('post_type'), custom_made_get_theme_option('parent_cat'));
$custom_made_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($custom_made_page_number > 1) {
	$custom_made_args['paged'] = $custom_made_page_number;
	$custom_made_args['ignore_sticky_posts'] = true;
}
$custom_made_ppp = custom_made_get_theme_option('posts_per_page');
if ((int) $custom_made_ppp != 0)
	$custom_made_args['posts_per_page'] = (int) $custom_made_ppp;

query_posts( $custom_made_args );

// Set query vars in the new query!
if (is_array($custom_made_content) && count($custom_made_content) == 2) {
	set_query_var('blog_archive_start', $custom_made_content[0]);
	set_query_var('blog_archive_end', $custom_made_content[1]);
}

get_template_part('index');
?>