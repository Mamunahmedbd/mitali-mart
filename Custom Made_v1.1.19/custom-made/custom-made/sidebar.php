<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_sidebar_position = custom_made_get_theme_option('sidebar_position');
if (custom_made_sidebar_present()) {
	$custom_made_sidebar_name = custom_made_get_theme_option('sidebar_widgets');
	custom_made_storage_set('current_sidebar', 'sidebar');
	?>
	<div class="sidebar <?php echo esc_attr($custom_made_sidebar_position); ?> widget_area<?php if (!custom_made_is_inherit(custom_made_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(custom_made_get_theme_option('sidebar_scheme')); ?>" role="complementary">
		<div class="sidebar_inner">
			<?php
			ob_start();
			do_action( 'custom_made_action_before_sidebar' );
            if ( is_active_sidebar( $custom_made_sidebar_name ) ) {
                dynamic_sidebar( $custom_made_sidebar_name );
            }
			do_action( 'custom_made_action_after_sidebar' );
			$custom_made_out = ob_get_contents();
			ob_end_clean();
			custom_made_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $custom_made_out));
			?>
		</div><!-- /.sidebar_inner -->
	</div><!-- /.sidebar -->
	<?php
}
?>