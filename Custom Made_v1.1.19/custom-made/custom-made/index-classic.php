<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

custom_made_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$custom_made_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$custom_made_sticky_out = is_array($custom_made_stickies) && count($custom_made_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($custom_made_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$custom_made_sticky_out) {
		if (custom_made_get_theme_option('first_post_large') && !is_paged() && !in_array(custom_made_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="columns_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($custom_made_sticky_out && !is_sticky()) {
			$custom_made_sticky_out = false;
			?></div><div class="columns_wrap posts_container"><?php
		}
		get_template_part( 'content', $custom_made_sticky_out && is_sticky() ? 'sticky' :'classic' );
	}
	
	?></div><?php

	custom_made_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>