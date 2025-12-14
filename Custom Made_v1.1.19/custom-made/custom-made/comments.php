<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;



// Callback for output single comment layout
if (!function_exists('custom_made_output_single_comment')) {
	function custom_made_output_single_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) {
			case 'pingback' :
				?>
				<li class="trackback"><?php esc_html_e( 'Trackback:', 'custom-made' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'custom-made' ), '<span class="edit-link">', '<span>' ); ?>
				<?php
				break;
			case 'trackback' :
				?>
				<li class="pingback"><?php esc_html_e( 'Pingback:', 'custom-made' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'custom-made' ), '<span class="edit-link">', '<span>' ); ?>
				<?php
				break;
			default :
				$author_id = $comment->user_id;
				$author_link = get_author_posts_url( $author_id );
				$mult = custom_made_get_retina_multiplier();
				?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment_item'); ?>>
					<div class="comment_author_avatar"><?php echo get_avatar( $comment, 90*$mult ); ?></div>
					<div class="comment_content">
						<div class="comment_info">
							<h6 class="comment_author"><?php echo (!empty($author_id) ? '<a href="'.esc_url($author_link).'">' : '') . comment_author() . (!empty($author_id) ? '</a>' : ''); ?></h6>
							<div class="comment_posted">
								<span class="comment_posted_label"><?php esc_html_e('Posted', 'custom-made'); ?></span>
								<span class="comment_date"><?php
									echo custom_made_get_date(get_comment_date('U'));
								?></span>
								<span class="comment_time"><?php
									echo get_comment_date(get_option('time_format'));
								?></span>
								<?php if ( $comment->comment_approved == 1 ) { ?>
								<span class="comment_counters"><?php custom_made_show_comment_counters(); ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="comment_text_wrap">
							<?php if ( $comment->comment_approved == 0 ) { ?>
							<div class="comment_not_approved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'custom-made' ); ?></div>
							<?php } ?>
							<div class="comment_text"><?php comment_text(); ?></div>
						</div>
						<?php if ($depth < $args['max_depth']) { ?>
							<div class="comment_reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
						<?php } ?>
					</div>
				<?php
				break;
		}
	}
}


// Output comments list
if ( have_comments() || comments_open() ) {
	?>
	<section class="comments_wrap">
	<?php
	if ( have_comments() ) {
	?>
		<div id="comments" class="comments_list_wrap">
			<h3 class="section_title comments_list_title"><?php $custom_made_post_comments = get_comments_number(); echo esc_html($custom_made_post_comments); ?> <?php echo (1==$custom_made_post_comments ? esc_html__('Comment', 'custom-made') : esc_html__('Comments', 'custom-made')); ?></h3>
			<ul class="comments_list">
				<?php
				wp_list_comments( array('callback'=>'custom_made_output_single_comment') );
				?>
			</ul><!-- .comments_list -->
			<?php if ( !comments_open() && get_comments_number()!=0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
				<p class="comments_closed"><?php esc_html_e( 'Comments are closed.', 'custom-made' ); ?></p>
			<?php }	?>
			<div class="comments_pagination"><?php paginate_comments_links(); ?></div>
		</div><!-- .comments_list_wrap -->
	<?php 
	}

	if ( comments_open() ) {
		?>
		<div class="comments_form_wrap">
			<h3 class="section_title comments_form_title"><?php esc_html_e('Leave a reply', 'custom-made'); ?></h3>
			<div class="comments_form">
				<?php
				$custom_made_form_style = esc_attr(custom_made_get_theme_option('input_hover'));
				if (empty($custom_made_form_style) || custom_made_is_inherit($custom_made_form_style)) $custom_made_form_style = 'default';
				$custom_made_commenter = wp_get_current_commenter();
				$custom_made_req = get_option( 'require_name_email' );
				$custom_made_comments_args = array(
						// class of the 'form' tag
						'class_form' => 'comment-form ' . ($custom_made_form_style != 'default' ? 'sc_input_hover_' . esc_attr($custom_made_form_style) : ''),
						// change the id of send button 
						'id_submit'=>'send_comment',
						// change the title of send button 
						'label_submit'=>esc_html__('Submit', 'custom-made'),
						// change the title of the reply section
						'title_reply'=>'',
						// remove "Logged in as"
						'logged_in_as' => '',
						// remove text before textarea
						'comment_notes_before' => '',
						// remove text after textarea
						'comment_notes_after' => '',
						// redefine your own textarea (the comment body)
						'comment_field' => custom_made_single_comments_field(array(
												'form_style' => $custom_made_form_style,
												'field_type' => 'textarea',
												'field_req' => true,
												'field_icon' => 'icon-feather',
												'field_value' => '',
												'field_name' => 'comment',
												'field_title' => esc_attr__('Comment', 'custom-made'),
												'field_placeholder' => esc_attr__( 'Your Comment', 'custom-made' )
											)),
						'fields' => apply_filters( 'custom_made_filter_comment_form_default_fields', array(
							'author' => custom_made_single_comments_field(array(
												'form_style' => $custom_made_form_style,
												'field_type' => 'text',
												'field_req' => $custom_made_req,
												'field_icon' => 'icon-user',
												'field_value' => isset($custom_made_commenter['comment_author']) ? $custom_made_commenter['comment_author'] : '',
												'field_name' => 'author',
												'field_title' => esc_attr__('Name', 'custom-made'),
												'field_placeholder' => esc_attr__( 'Your Name', 'custom-made' )
											)),
							'email' => custom_made_single_comments_field(array(
												'form_style' => $custom_made_form_style,
												'field_type' => 'text',
												'field_req' => $custom_made_req,
												'field_icon' => 'icon-mail',
												'field_value' => isset($custom_made_commenter['comment_author_email']) ? $custom_made_commenter['comment_author_email'] : '',
												'field_name' => 'email',
												'field_title' => esc_attr__('E-mail', 'custom-made'),
												'field_placeholder' => esc_attr__( 'Your E-mail', 'custom-made' )
											))
						) )
				);
			
				comment_form($custom_made_comments_args);
				?>
			</div>
		</div><!-- /.comments_form_wrap -->
		<?php 
	}
	?>
	</section><!-- /.comments_wrap -->
<?php 
}
?>