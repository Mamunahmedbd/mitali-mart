<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0.1
 */
?>
<div class="update-nag" id="custom_made_admin_notice">
	<h3 class="custom_made_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'custom-made'), wp_get_theme()->name); ?></h3>
	<?php if (!custom_made_exists_trx_addons()) { ?>
	<p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "Custom Made Addons is required! Please, install and activate it!', 'custom-made')); ?></p>
	<?php } ?>
	<p>
		<?php if (custom_made_get_value_gp('page')!='tgmpa-install-plugins') { ?>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'custom-made'); ?></a>
		<?php } ?>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'custom-made'); ?></a>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'custom-made'); ?></a>
        <a href="#" class="button custom_made_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'custom-made'); ?></a>
	</p>
</div>