<?php
/**
 * The template to displaying popup with Theme Icons
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

$custom_made_icons = custom_made_get_list_icons();
if (is_array($custom_made_icons)) {
	?>
	<div class="custom_made_list_icons">
		<?php
		foreach($custom_made_icons as $icon) {
			?><span class="<?php echo esc_attr($icon); ?>" title="<?php echo esc_attr($icon); ?>"></span><?php
		}
		?>
	</div>
	<?php
}
?>