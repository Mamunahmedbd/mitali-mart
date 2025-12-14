<?php
/**
 * The template for displaying Header widgets area
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// Header sidebar
$custom_made_header_name = custom_made_get_theme_option('header_widgets');
$custom_made_header_present = !custom_made_is_off($custom_made_header_name) && is_active_sidebar($custom_made_header_name);
if ($custom_made_header_present) { 
	custom_made_storage_set('current_sidebar', 'header');
	$custom_made_header_wide = custom_made_get_theme_option('header_wide');
	ob_start();
	do_action( 'custom_made_action_before_sidebar' );
    if ( is_active_sidebar( $custom_made_header_name ) ) {
        dynamic_sidebar( $custom_made_header_name );
    }
	do_action( 'custom_made_action_after_sidebar' );
	$custom_made_widgets_output = ob_get_contents();
	ob_end_clean();
	$custom_made_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $custom_made_widgets_output);
	$custom_made_need_columns = strpos($custom_made_widgets_output, 'columns_wrap')===false;
	if ($custom_made_need_columns) {
		$custom_made_columns = max(0, (int) custom_made_get_theme_option('header_columns'));
		if ($custom_made_columns == 0) $custom_made_columns = min(6, max(1, substr_count($custom_made_widgets_output, '<aside ')));
		if ($custom_made_columns > 1)
			$custom_made_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($custom_made_columns).' widget ', $custom_made_widgets_output);
		else
			$custom_made_need_columns = false;
	}
	?>
	<div class="header_widgets_wrap widget_area<?php echo !empty($custom_made_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
		<div class="header_widgets_wrap_inner widget_area_inner">
			<?php 
			if (!$custom_made_header_wide) { 
				?><div class="content_wrap"><?php
			}
			if ($custom_made_need_columns) {
				?><div class="columns_wrap"><?php
			}
			custom_made_show_layout($custom_made_widgets_output);
			if ($custom_made_need_columns) {
				?></div>	<!-- /.columns_wrap --><?php
			}
			if (!$custom_made_header_wide) {
				?></div>	<!-- /.content_wrap --><?php
			}
			?>
		</div>	<!-- /.header_widgets_wrap_inner -->
	</div>	<!-- /.header_widgets_wrap -->
<?php
}
?>