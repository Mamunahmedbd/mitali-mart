<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

						// Widgets area inside page content
						custom_made_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					custom_made_create_widgets_area('widgets_below_page');

					$custom_made_body_style = custom_made_get_theme_option('body_style');
					if ($custom_made_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			$custom_made_footer_scheme =  custom_made_is_inherit(custom_made_get_theme_option('footer_scheme')) ? custom_made_get_theme_option('color_scheme') : custom_made_get_theme_option('footer_scheme');
			?>
			
			<footer class="site_footer_wrap scheme_<?php echo esc_attr($custom_made_footer_scheme); ?>">
				<?php
				// Footer sidebar
				$custom_made_footer_name = custom_made_get_theme_option('footer_widgets');
				$custom_made_footer_present = !custom_made_is_off($custom_made_footer_name) && is_active_sidebar($custom_made_footer_name);
				if ($custom_made_footer_present) { 
					custom_made_storage_set('current_sidebar', 'footer');
					$custom_made_footer_wide = custom_made_get_theme_option('footer_wide');
					ob_start();
					do_action( 'custom_made_action_before_sidebar' );
                    if ( is_active_sidebar( $custom_made_footer_name ) ) {
                        dynamic_sidebar( $custom_made_footer_name );
                    }
					do_action( 'custom_made_action_after_sidebar' );
					$custom_made_out = ob_get_contents();
					ob_end_clean();
					$custom_made_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $custom_made_out);
					$custom_made_need_columns = true;
					if ($custom_made_need_columns) {
						$custom_made_columns = max(0, (int) custom_made_get_theme_option('footer_columns'));
						if ($custom_made_columns == 0) $custom_made_columns = min(6, max(1, substr_count($custom_made_out, '<aside ')));
						if ($custom_made_columns > 1)
							$custom_made_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($custom_made_columns).' widget ', $custom_made_out);
						else
							$custom_made_need_columns = false;
					}
					?>
					<div class="footer_wrap widget_area<?php echo !empty($custom_made_footer_wide) ? ' footer_fullwidth' : ''; ?>">
						<div class="footer_wrap_inner widget_area_inner">
							<?php 
							if (!$custom_made_footer_wide) { 
								?><div class="content_wrap"><?php
							}
							if ($custom_made_need_columns) {
								?><div class="columns_wrap"><?php
							}
							custom_made_show_layout($custom_made_out);
							if ($custom_made_need_columns) {
								?></div><!-- /.columns_wrap --><?php
							}
							if (!$custom_made_footer_wide) {
								?></div><!-- /.content_wrap --><?php
							}
							?>
						</div><!-- /.footer_wrap_inner -->
					</div><!-- /.footer_wrap -->
				<?php
				}
	
				// Logo
				if (custom_made_is_on(custom_made_get_theme_option('logo_in_footer'))) {
					$custom_made_logo_image = '';
					if (custom_made_get_retina_multiplier(2) > 1)
						$custom_made_logo_image = custom_made_get_theme_option( 'logo_footer_retina' );
					if (empty($custom_made_logo_image)) 
						$custom_made_logo_image = custom_made_get_theme_option( 'logo_footer' );
					$custom_made_logo_text   = get_bloginfo( 'name' );
					if (!empty($custom_made_logo_image) || !empty($custom_made_logo_text)) {
						?>
						<div class="logo_footer_wrap">
							<div class="logo_footer_wrap_inner">
								<?php
								if (!empty($custom_made_logo_image)) {
									$custom_made_attr = custom_made_getimagesize($custom_made_logo_image);
									echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($custom_made_logo_image).'" class="logo_footer_image" alt="'. esc_attr(basename($custom_made_logo_image)).'"'.(!empty($custom_made_attr[3]) ? sprintf(' %s', $custom_made_attr[3]) : '').'></a>' ;
								} else if (!empty($custom_made_logo_text)) {
									echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($custom_made_logo_text) . '</a></h1>';
								}
								?>
							</div>
						</div>
						<?php
					}
				}

				// Socials
				if ( custom_made_is_on(custom_made_get_theme_option('socials_in_footer')) && ($custom_made_output = custom_made_get_socials_links()) != '') {
					?>
					<div class="socials_footer_wrap socials_wrap">
						<div class="socials_footer_wrap_inner">
							<?php custom_made_show_layout($custom_made_output); ?>
						</div>
					</div>
					<?php
				}
				
				// Footer menu
				$custom_made_menu_footer = custom_made_get_nav_menu('menu_footer');
				if (!empty($custom_made_menu_footer)) {
					?>
					<div class="menu_footer_wrap">
						<div class="menu_footer_wrap_inner">
							<?php custom_made_show_layout($custom_made_menu_footer); ?>
						</div>
					</div>
					<?php
				}
				
				// Copyright area
				$custom_made_copyright_scheme = custom_made_is_inherit(custom_made_get_theme_option('copyright_scheme')) ? $custom_made_footer_scheme : custom_made_get_theme_option('copyright_scheme');
				?> 
				<div class="copyright_wrap scheme_<?php echo esc_attr($custom_made_copyright_scheme); ?>">
					<div class="copyright_wrap_inner">
						<div class="content_wrap">
							<div class="copyright_text"><?php
								$custom_made_copyright = custom_made_prepare_macros(custom_made_get_theme_option('copyright'));
								if (!empty($custom_made_copyright)) {
									if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $custom_made_copyright, $custom_made_matches)) {
										$custom_made_copyright = str_replace($custom_made_matches[1], date(str_replace(array('{', '}'), '', $custom_made_matches[1])), $custom_made_copyright);
									}
									custom_made_show_layout(nl2br($custom_made_copyright));
								}
							?></div>
						</div>
					</div>
				</div>

			</footer><!-- /.site_footer_wrap -->
			
		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>