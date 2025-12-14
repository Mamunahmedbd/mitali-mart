<?php
/**
 * The template for displaying Page title and Breadcrumbs
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// Page (category, tag, archive, author) title

if ( custom_made_need_page_title() ) {
	set_query_var('custom_made_title_showed', true);
	$custom_made_top_icon = custom_made_get_category_icon();
	?>
	<div class="top_panel_title_wrap">
		<div class="content_wrap">
			<div class="top_panel_title">
				<div class="page_title">
					<?php
					
					// Blog/Post title
					$custom_made_blog_title = custom_made_get_blog_title();
					$custom_made_blog_title_text = $custom_made_blog_title_class = $custom_made_blog_title_link = $custom_made_blog_title_link_text = '';
					if (is_array($custom_made_blog_title)) {
						$custom_made_blog_title_text = $custom_made_blog_title['text'];
						$custom_made_blog_title_class = !empty($custom_made_blog_title['class']) ? ' '.$custom_made_blog_title['class'] : '';
						$custom_made_blog_title_link = !empty($custom_made_blog_title['link']) ? $custom_made_blog_title['link'] : '';
						$custom_made_blog_title_link_text = !empty($custom_made_blog_title['link_text']) ? $custom_made_blog_title['link_text'] : '';
					} else
						$custom_made_blog_title_text = $custom_made_blog_title;
					?>
					<h1 class="page_caption<?php echo esc_attr($custom_made_blog_title_class); ?>"><?php
						if (!empty($custom_made_top_icon)) {
							?><img src="<?php echo esc_url($custom_made_top_icon); ?>" alt="<?php echo esc_attr(basename($custom_made_top_icon)); ?>"><?php
						}
						echo '<span class="first_letter">'.wp_kses_data(mb_substr($custom_made_blog_title_text, 0, 1)).'</span>';
						echo '<span class="other">'.wp_kses_post(mb_substr($custom_made_blog_title_text, 1)).'</span>';
					?></h1>
					<?php
					if (!empty($custom_made_blog_title_link) && !empty($custom_made_blog_title_link_text)) {
						?><a href="<?php echo esc_url($custom_made_blog_title_link); ?>" class="theme_button theme_button_small page_title_link"><?php echo esc_html($custom_made_blog_title_link_text); ?></a><?php
					}
					
					// Category/Tag description
					if ( is_category() || is_tag() || is_tax() ) 
						the_archive_description( '<div class="page_description">', '</div>' );
					?>
				</div>
				<?php
				// Breadcrumbs
				if (custom_made_is_on(custom_made_get_theme_option('show_breadcrumbs'))) {
					custom_made_show_layout(custom_made_get_breadcrumbs(), '<div class="breadcrumbs">', '</div>');
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
?>