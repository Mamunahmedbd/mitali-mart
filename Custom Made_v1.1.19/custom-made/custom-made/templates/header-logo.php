<?php
/**
 * The template for displaying Logo or Site name and slogan in the Header
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// Site logo
$custom_made_logo_image = '';
if (custom_made_get_retina_multiplier(2) > 1)
	$custom_made_logo_image = custom_made_get_theme_option( 'logo_retina' );
if (empty($custom_made_logo_image)) 
	$custom_made_logo_image = custom_made_get_theme_option( 'logo' );
$custom_made_logo_text   = get_bloginfo( 'name' );
$custom_made_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($custom_made_logo_image) || !empty($custom_made_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if (!empty($custom_made_logo_image)) {
			$custom_made_attr = custom_made_getimagesize($custom_made_logo_image);
			echo '<img src="'.esc_url($custom_made_logo_image).'" class="logo_main" alt="'. esc_attr(basename($custom_made_logo_image)).'"'.(!empty($custom_made_attr[3]) ? sprintf(' %s', $custom_made_attr[3]) : '').'>' ;
		} else {
			custom_made_show_layout(custom_made_prepare_macros($custom_made_logo_text), '<span class="logo_text">', '</span>');
			custom_made_show_layout(custom_made_prepare_macros($custom_made_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>