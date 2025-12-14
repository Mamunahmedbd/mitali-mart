<?php
/**
 * The default template for displaying content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type()) 
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												. ' itemscope'
												); ?>
		itemscope itemtype="//schema.org/<?php echo esc_attr(is_single() ? 'BlogPosting' : 'Article'); ?>">
	<?php
	// Structured data snippets
	if (custom_made_is_on(custom_made_get_theme_option('seo_snippets'))) {
		?>
		<div class="structured_data_snippets">
			<meta itemprop="headline" content="<?php the_title_attribute(); ?>">
			<meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
			<meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
			<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>" content="<?php the_title_attribute(); ?>"/>	
			<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<?php 
					$custom_made_logo_image = custom_made_get_retina_multiplier(2) > 1 
										? custom_made_get_theme_option( 'logo_retina' )
										: custom_made_get_theme_option( 'logo' );
					if (!empty($custom_made_logo_image)) {
						$custom_made_attr = custom_made_getimagesize($custom_made_logo_image);
						?>
						<img itemprop="url" src="<?php echo esc_url($custom_made_logo_image); ?>">
						<meta itemprop="width" content="<?php echo esc_attr($custom_made_attr[0]); ?>">
						<meta itemprop="height" content="<?php echo esc_attr($custom_made_attr[1]); ?>">
						<?php
					}
					?>
				</div>
				<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
				<meta itemprop="telephone" content="">
				<meta itemprop="address" content="">
			</div>
		</div>
		<?php
	}
	

	// Title and post meta
	if ( get_query_var('custom_made_title_showed', false) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( !custom_made_need_page_title() ) {
				the_title( '<h3 class="post_title entry-title"'.(custom_made_is_on(custom_made_get_theme_option('seo_snippets')) ? ' itemprop="headline"' : '').'>', '</h3>' );
			}
			// Post meta
			custom_made_show_post_meta(array(
				'seo' => custom_made_is_on(custom_made_get_theme_option('seo_snippets')),
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
		</div><!-- .post_header -->
		<?php
	}
	
	// Featured image
	if ( !get_query_var('custom_made_featured_showed', false) )
		custom_made_show_post_featured();

	// Post content
	?>
	<div class="post_content entry-content" itemprop="articleBody">
		<?php
			the_content( );

			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'custom-made' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'custom-made' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			// Taxonomies and share
			if ( is_single() && !is_attachment() ) {
				?>
				<div class="post_meta post_meta_single"><?php
					
					// Post taxonomies
					?><span class="post_meta_item post_tags"><?php the_tags( '', '', '' ); ?></span><?php

					// Share
					custom_made_show_share_links(array(
							'type' => 'block',
							'caption' => '',
							'before' => '<span class="post_meta_item post_share">',
							'after' => '</span>'
						));
					?>
				</div>
				<?php
			}
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {
			get_template_part( 'templates/author-bio' );
		}
	?>
</article>
