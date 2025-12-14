<?php
$custom_made_search_style = 'fullscreen';
$custom_made_search_in_header = get_query_var('custom_made_search_in_header');
$custom_made_args = array_merge(
	array(
		'role'       => 'search',
	),
	(array) get_query_var( 'custom_made_search_args' )
);
set_query_var('custom_made_search_in_header', false);
?>
<div class="search_wrap<?php
	if ($custom_made_search_in_header) {
		echo ' search_style_'.esc_attr($custom_made_search_style);
		if ($custom_made_search_style != 'fullscreen') echo ' search_ajax';
	}
	?>">
	<div class="search_form_wrap">
		<form role="<?php echo esc_attr( $custom_made_args['role'] ); ?>" method="get" class="search_form" action="<?php echo esc_url(home_url('/')); ?>">
			<input type="text" class="search_field" placeholder="<?php esc_attr_e('Search', 'custom-made'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
			<button type="submit" class="search_submit icon-search-1"></button>
			<?php if ($custom_made_search_in_header && $custom_made_search_style == 'fullscreen') { ?>
				<a class="search_close icon-cancel"></a>
			<?php } ?>
		</form>
	</div>
	<div class="search_results widget_area"><a href="#" class="search_results_close icon-cancel"></a><div class="search_results_content"></div></div>
</div>
