<?php
/**
 * Theme lists
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return numbers range
if ( !function_exists( 'custom_made_get_list_range' ) ) {
	function custom_made_get_list_range($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = $i;
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}



// Return styles list
if ( !function_exists( 'custom_made_get_list_styles' ) ) {
	function custom_made_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'custom-made'), $i);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'custom_made_get_list_yesno' ) ) {
	function custom_made_get_list_yesno($prepend_inherit=false) {
		$list = array(
			"yes"	=> esc_html__("Yes", 'custom-made'),
			"no"	=> esc_html__("No", 'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'custom_made_get_list_onoff' ) ) {
	function custom_made_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on"	=> esc_html__("On", 'custom-made'),
			"off"	=> esc_html__("Off", 'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'custom_made_get_list_showhide' ) ) {
	function custom_made_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'custom-made'),
			"hide" => esc_html__("Hide", 'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'custom_made_get_list_directions' ) ) {
	function custom_made_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'custom-made'),
			"vertical"   => esc_html__("Vertical", 'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return list of the animations
if ( !function_exists( 'custom_made_get_list_animations' ) ) {
	function custom_made_get_list_animations($prepend_inherit=false) {
		$list = array(
			'none'			=> esc_html__('- None -',	'custom-made'),
			'bounced'		=> esc_html__('Bounced',	'custom-made'),
			'elastic'		=> esc_html__('Elastic',	'custom-made'),
			'flash'			=> esc_html__('Flash',		'custom-made'),
			'flip'			=> esc_html__('Flip',		'custom-made'),
			'pulse'			=> esc_html__('Pulse',		'custom-made'),
			'rubberBand'	=> esc_html__('Rubber Band','custom-made'),
			'shake'			=> esc_html__('Shake',		'custom-made'),
			'swing'			=> esc_html__('Swing',		'custom-made'),
			'tada'			=> esc_html__('Tada',		'custom-made'),
			'wobble'		=> esc_html__('Wobble',		'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'custom_made_get_list_animations_in' ) ) {
	function custom_made_get_list_animations_in($prepend_inherit=false) {
		$list = array(
			'none'				=> esc_html__('- None -',			'custom-made'),
			'bounceIn'			=> esc_html__('Bounce In',			'custom-made'),
			'bounceInUp'		=> esc_html__('Bounce In Up',		'custom-made'),
			'bounceInDown'		=> esc_html__('Bounce In Down',		'custom-made'),
			'bounceInLeft'		=> esc_html__('Bounce In Left',		'custom-made'),
			'bounceInRight'		=> esc_html__('Bounce In Right',	'custom-made'),
			'elastic'			=> esc_html__('Elastic In',			'custom-made'),
			'fadeIn'			=> esc_html__('Fade In',			'custom-made'),
			'fadeInUp'			=> esc_html__('Fade In Up',			'custom-made'),
			'fadeInUpSmall'		=> esc_html__('Fade In Up Small',	'custom-made'),
			'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'custom-made'),
			'fadeInDown'		=> esc_html__('Fade In Down',		'custom-made'),
			'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'custom-made'),
			'fadeInLeft'		=> esc_html__('Fade In Left',		'custom-made'),
			'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'custom-made'),
			'fadeInRight'		=> esc_html__('Fade In Right',		'custom-made'),
			'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'custom-made'),
			'flipInX'			=> esc_html__('Flip In X',			'custom-made'),
			'flipInY'			=> esc_html__('Flip In Y',			'custom-made'),
			'lightSpeedIn'		=> esc_html__('Light Speed In',		'custom-made'),
			'rotateIn'			=> esc_html__('Rotate In',			'custom-made'),
			'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','custom-made'),
			'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'custom-made'),
			'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'custom-made'),
			'rotateInDownRight'	=> esc_html__('Rotate In Down Right','custom-made'),
			'rollIn'			=> esc_html__('Roll In',			'custom-made'),
			'slideInUp'			=> esc_html__('Slide In Up',		'custom-made'),
			'slideInDown'		=> esc_html__('Slide In Down',		'custom-made'),
			'slideInLeft'		=> esc_html__('Slide In Left',		'custom-made'),
			'slideInRight'		=> esc_html__('Slide In Right',		'custom-made'),
			'wipeInLeftTop'		=> esc_html__('Wipe In Left Top',	'custom-made'),
			'zoomIn'			=> esc_html__('Zoom In',			'custom-made'),
			'zoomInUp'			=> esc_html__('Zoom In Up',			'custom-made'),
			'zoomInDown'		=> esc_html__('Zoom In Down',		'custom-made'),
			'zoomInLeft'		=> esc_html__('Zoom In Left',		'custom-made'),
			'zoomInRight'		=> esc_html__('Zoom In Right',		'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'custom_made_get_list_animations_out' ) ) {
	function custom_made_get_list_animations_out($prepend_inherit=false) {
		$list = array(
			'none'			=> esc_html__('- None -',			'custom-made'),
			'bounceOut'		=> esc_html__('Bounce Out',			'custom-made'),
			'bounceOutUp'	=> esc_html__('Bounce Out Up',		'custom-made'),
			'bounceOutDown'	=> esc_html__('Bounce Out Down',	'custom-made'),
			'bounceOutLeft'	=> esc_html__('Bounce Out Left',	'custom-made'),
			'bounceOutRight'=> esc_html__('Bounce Out Right',	'custom-made'),
			'fadeOut'		=> esc_html__('Fade Out',			'custom-made'),
			'fadeOutUp'		=> esc_html__('Fade Out Up',		'custom-made'),
			'fadeOutUpBig'	=> esc_html__('Fade Out Up Big',	'custom-made'),
			'fadeOutDownSmall'	=> esc_html__('Fade Out Down Small','custom-made'),
			'fadeOutDownBig'=> esc_html__('Fade Out Down Big',	'custom-made'),
			'fadeOutDown'	=> esc_html__('Fade Out Down',		'custom-made'),
			'fadeOutLeft'	=> esc_html__('Fade Out Left',		'custom-made'),
			'fadeOutLeftBig'=> esc_html__('Fade Out Left Big',	'custom-made'),
			'fadeOutRight'	=> esc_html__('Fade Out Right',		'custom-made'),
			'fadeOutRightBig'=> esc_html__('Fade Out Right Big','custom-made'),
			'flipOutX'		=> esc_html__('Flip Out X',			'custom-made'),
			'flipOutY'		=> esc_html__('Flip Out Y',			'custom-made'),
			'hinge'			=> esc_html__('Hinge Out',			'custom-made'),
			'lightSpeedOut'	=> esc_html__('Light Speed Out',	'custom-made'),
			'rotateOut'		=> esc_html__('Rotate Out',			'custom-made'),
			'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left',	'custom-made'),
			'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right',	'custom-made'),
			'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',		'custom-made'),
			'rotateOutDownRight'=> esc_html__('Rotate Out Down Right',	'custom-made'),
			'rollOut'			=> esc_html__('Roll Out',		'custom-made'),
			'slideOutUp'		=> esc_html__('Slide Out Up',	'custom-made'),
			'slideOutDown'		=> esc_html__('Slide Out Down',	'custom-made'),
			'slideOutLeft'		=> esc_html__('Slide Out Left',	'custom-made'),
			'slideOutRight'		=> esc_html__('Slide Out Right','custom-made'),
			'zoomOut'			=> esc_html__('Zoom Out',		'custom-made'),
			'zoomOutUp'			=> esc_html__('Zoom Out Up',	'custom-made'),
			'zoomOutDown'		=> esc_html__('Zoom Out Down',	'custom-made'),
			'zoomOutLeft'		=> esc_html__('Zoom Out Left',	'custom-made'),
			'zoomOutRight'		=> esc_html__('Zoom Out Right',	'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('custom_made_get_animation_classes')) {
	function custom_made_get_animation_classes($animation, $speed='normal', $loop='none') {
		return custom_made_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!custom_made_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'custom_made_get_list_sidebars' ) ) {
	function custom_made_get_list_sidebars($prepend_inherit=false) {
		if (($list = custom_made_storage_get('list_sidebars'))=='') {
			$list = apply_filters('custom_made_filter_list_sidebars', array(
				'sidebar_widgets'		=> esc_html__('Sidebar Widgets', 'custom-made'),
				'header_widgets'		=> esc_html__('Header Widgets', 'custom-made'),
				'above_page_widgets'	=> esc_html__('Above Page Widgets', 'custom-made'),
				'above_content_widgets' => esc_html__('Above Content Widgets', 'custom-made'),
				'below_content_widgets' => esc_html__('Below Content Widgets', 'custom-made'),
				'below_page_widgets' 	=> esc_html__('Below Page Widgets', 'custom-made'),
				'footer_widgets'		=> esc_html__('Footer Widgets', 'custom-made')
				)
			);
			$custom_sidebars_number = max(0, min(2, custom_made_get_theme_setting('custom_sidebars')));
			if ($custom_sidebars_number > 0) {
				for ($i=1; $i <= $custom_sidebars_number; $i++) {
					$list['custom_widgets_'.intval($i)] = sprintf(esc_html__('Custom Widgets %d', 'custom-made'), $i);
				}
			}
			custom_made_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'custom_made_get_list_sidebars_positions' ) ) {
	function custom_made_get_list_sidebars_positions($prepend_inherit=false) {
		$list = array(
			'left'  => esc_html__('Left',  'custom-made'),
			'right' => esc_html__('Right', 'custom-made')
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'custom_made_get_list_blog_styles' ) ) {
	function custom_made_get_list_blog_styles($prepend_inherit=false) {
		$list = apply_filters('custom_made_filter_list_blog_styles', array(
			'excerpt'	=> esc_html__('Excerpt','custom-made'),
			'classic_2'	=> esc_html__('Classic /2 columns/',	'custom-made'),
			'classic_3'	=> esc_html__('Classic /3 columns/',	'custom-made'),
			'portfolio_2' => esc_html__('Portfolio /2 columns/','custom-made'),
			'portfolio_3' => esc_html__('Portfolio /3 columns/','custom-made'),
			'portfolio_4' => esc_html__('Portfolio /4 columns/','custom-made'),
			'gallery_2' => esc_html__('Gallery /2 columns/',	'custom-made'),
			'gallery_3' => esc_html__('Gallery /3 columns/',	'custom-made'),
			'gallery_4' => esc_html__('Gallery /4 columns/',	'custom-made'),
			'chess_1'	=> esc_html__('Chess /2 column/',		'custom-made'),
			'chess_2'	=> esc_html__('Chess /4 columns/',		'custom-made'),
			'chess_3'	=> esc_html__('Chess /6 columns/',		'custom-made')
			)
		);
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'custom_made_get_list_categories' ) ) {
	function custom_made_get_list_categories($prepend_inherit=false) {
		if (($list = custom_made_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			custom_made_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'custom_made_get_list_terms' ) ) {
	function custom_made_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = custom_made_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			$args = array(
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => $taxonomy,
				'pad_counts'               => false );
			$taxonomies = get_terms( $taxonomy, $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;	
				}
			}
			custom_made_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'custom_made_get_list_posts_types' ) ) {
	function custom_made_get_list_posts_types($prepend_inherit=false) {
		if (($list = custom_made_storage_get('list_posts_types'))=='') {
			$list = apply_filters('custom_made_filter_list_posts_types', array(
				'post' => esc_html__('Post', 'custom-made')
			));
			custom_made_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'custom_made_get_list_posts' ) ) {
	function custom_made_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = custom_made_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'custom-made');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			custom_made_storage_set($hash, $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}


// Return list of registered users
if ( !function_exists( 'custom_made_get_list_users' ) ) {
	function custom_made_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = custom_made_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'custom-made');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			custom_made_storage_set('list_users', $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'custom_made_get_list_menus' ) ) {
	function custom_made_get_list_menus($prepend_inherit=false) {
		if (($list = custom_made_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'custom-made');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			custom_made_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'custom_made_get_list_icons' ) ) {
	function custom_made_get_list_icons($prepend_inherit=false) {
		static $list = false;
		if (!is_array($list)) 
			$list = !is_admin() ? array() : custom_made_parse_icons_classes(custom_made_get_file_dir("css/fontello/css/fontello-codes.css"));
		return $prepend_inherit ? custom_made_array_merge(array('inherit' => esc_html__("Inherit", 'custom-made')), $list) : $list;
	}
}
?>