<?php
/**
 * This script is used to fix the URLs in the old themes.
 */
if ( ! function_exists( 'custom_made_fix_urls' ) ) {
	add_action( 'init', 'custom_made_fix_urls' );
	add_action( 'trx_addons_action_importer_import_end', 'custom_made_fix_urls', 10, 1 );
	/**
	 * Replace the URLs with a theme demo URL to the current site URL.
	 *
	 * @hooked init
	 * @hooked trx_addons_action_importer_import_end
	 */
	function custom_made_fix_urls( $importer = false ) {
		if ( ! is_admin() || ( (int)get_option( 'custom_made_fix_urls' ) > 0 && current_action() != 'trx_addons_action_importer_import_end' ) ) {
			return;
		}
		custom_made_fix_urls_in_attachments();
		custom_made_fix_urls_in_elementor();
		custom_made_fix_urls_in_vc();
		custom_made_fix_urls_in_revslider();
		update_option( 'custom_made_fix_urls', 1 );
	}
}

if ( ! function_exists( 'custom_made_fix_urls_in_attachments' ) ) {
	/**
	 * Replace the URLs with a theme demo URL to the current site URL in the Elementor data.
	 */
	function custom_made_fix_urls_in_attachments() {
		global $wpdb;
		$rows = $wpdb->get_results( "SELECT ID, guid
										FROM {$wpdb->posts}
										WHERE post_type='attachment'"
									);
		if ( is_array( $rows ) && count( $rows ) > 0 ) {
			foreach ( $rows as $row ) {
				$data = $row->guid;
				if ( custom_made_fix_url( $data ) ) {
					$wpdb->query( "UPDATE {$wpdb->posts} SET guid = '" . esc_sql( $data ) . "' WHERE ID = {$row->ID} LIMIT 1" );
				}
			}
		}
	}
}

if ( ! function_exists( 'custom_made_fix_urls_in_elementor' ) ) {
	/**
	 * Replace the URLs with a theme demo URL to the current site URL in the Elementor data.
	 */
	function custom_made_fix_urls_in_elementor() {
		global $wpdb;
		$rows = $wpdb->get_results( "SELECT post_id, meta_id, meta_value
										FROM {$wpdb->postmeta}
										WHERE meta_key='_elementor_data' && meta_value!=''"
									);
		if ( is_array( $rows ) && count( $rows ) > 0 ) {
			foreach ( $rows as $row ) {
				$data = json_decode( $row->meta_value, true );
				if ( custom_made_fix_url( $data ) ) {
					$wpdb->query( "UPDATE {$wpdb->postmeta} SET meta_value = '" . esc_sql( wp_json_encode( $data ) ) . "' WHERE meta_id = {$row->meta_id} LIMIT 1" );
				}
			}
		}
	}
}

if ( ! function_exists( 'custom_made_fix_urls_in_vc' ) ) {
	/**
	 * Replace the URLs with a theme demo URL to the current site URL in the VC data (post content and post meta).
	 */
	function custom_made_fix_urls_in_vc() {
		global $wpdb;
		// Post content
		$rows = $wpdb->get_results( "SELECT ID, post_content
										FROM {$wpdb->posts}
										WHERE post_content LIKE '[vc_%'"
									);
		if ( is_array( $rows ) && count( $rows ) > 0 ) {
			foreach ( $rows as $row ) {
				$data = $row->post_content;
				if ( custom_made_fix_url( $data ) ) {
					$wpdb->query( "UPDATE {$wpdb->posts} SET post_content = '" . esc_sql( $data ) . "' WHERE ID = {$row->ID} LIMIT 1" );
				}
			}
		}
		// Post meta
		$rows = $wpdb->get_results( "SELECT post_id, meta_id, meta_value
										FROM {$wpdb->postmeta}
										WHERE meta_key='_wpb_shortcodes_custom_css' && meta_value!=''"
									);
		if ( is_array( $rows ) && count( $rows ) > 0 ) {
			foreach ( $rows as $row ) {
				$data = $row->meta_value;
				if ( custom_made_fix_url( $data ) ) {
					$wpdb->query( "UPDATE {$wpdb->postmeta} SET meta_value = '" . esc_sql( $data ) . "' WHERE meta_id = {$row->meta_id} LIMIT 1" );
				}
			}
		}
	}
}

if ( ! function_exists( 'custom_made_fix_urls_in_revslider' ) ) {
	/**
	 * Replace the URLs with a theme demo URL to the current site URL in the revslider tables
	 */
	function custom_made_fix_urls_in_revslider() {
		global $wpdb;
		$tables = array( "revslider_sliders", "revslider_sliders7", "revslider_slides", "revslider_slides7" );
		$fields = array( "params", "layers" );
		foreach ( $tables as $table ) {
			$table = "{$wpdb->prefix}{$table}";
			if ( count( $wpdb->get_results( $wpdb->prepare( "SHOW TABLES LIKE %s", $table ), ARRAY_A ) ) > 0 ) {
				$rows = $wpdb->get_results( "SELECT * FROM {$table}", ARRAY_A );
				if ( is_array( $rows ) ) {
					foreach ( $rows as $k => $row ) {
						foreach ( $fields as $field ) {
							if ( ! empty( $row[ $field ] ) ) {
								$row[ $field ] = json_decode( $row[ $field ], true );
								if ( is_array( $row[ $field ] ) && custom_made_fix_url( $row[ $field ] ) ) {
									$wpdb->query( "UPDATE {$table} SET {$field} = '" . esc_sql( json_encode( $row[ $field ] ) ) . "' WHERE id = '" . esc_sql( $row['id'] ) . "'" );
								}
							}
						}
					}
				}
			}
		}
	}
}

if ( ! function_exists( 'custom_made_fix_url' ) ) {
	/**
	 * Correct url in all entries of the array. Recursive function.
	 *
	 * @param mixed $data     Data to fix
	 * 
	 * @return bool           true if the data was changed
	 */
	function custom_made_fix_url( &$data ) {
		static $site_url = false, $demo_url = false;

		if ( $site_url === false ) {
			// Current site domain
			$site_url = home_url();
			// Demo-site domain
			$demo_url = custom_made_storage_get( 'theme_demo_url' );
			if ( substr( $demo_url, 0, 2 ) === '//' ) {
				$demo_url = custom_made_fix_get_protocol() . ':' . $demo_url;
			}
			if ( empty( $demo_url ) ) {
				$importer_options = apply_filters( 'trx_addons_filter_importer_options', array(
					// Need for filter handlers
					'files' => array(
						'default' => array(
							'file_with_' => 'name.ext'
						)
					)
				) );
				if ( ! empty( $importer_options['files']['default']['domain_demo'] ) ) {
					$demo_url = $importer_options['files']['default']['domain_demo'];
				}
			}
		}

		$changed = false;

		if ( ! empty( $demo_url ) ) {
			if ( is_array( $data ) ) {
				foreach ( $data as $k => $v ) {
					if ( is_array( $v ) ) {
						$rez = custom_made_fix_url( $data[ $k ] );
						$changed = $changed || $rez;
					} else if ( ! empty( $v ) && is_string( $v ) ) {
						$data[ $k ] = custom_made_fix_url_replace( $demo_url, $site_url, $v );
						$changed = $changed || $data[ $k ] != $v;
					}
				}
			} else if ( ! empty( $data ) && is_string( $data ) ) {
				$data_new = custom_made_fix_url_replace( $demo_url, $site_url, $data );
				$changed = $changed || $data_new != $data;
				$data = $data_new;
			}
		}

		return $changed;
	}
}

if ( ! function_exists('custom_made_fix_url_replace') ) {
	/**
	 * Replace URL in the string with new URL
	 * Process all variants of the URL: with and without 'http://' and with and without 'www.',
	 * with and without protocol, with and without slash at the end of the string.
	 * 
	 * @param string $from      URL to replace
	 * @param string $to        URL to replace to
	 * @param string $str       string to process
	 * 
	 * @return string           processed string
	 */
	function custom_made_fix_url_replace($from, $to, $str) {
		if ( substr($from, -1) == '/' ) {
			$from = substr($from, 0, strlen($from)-1);
		}
		if ( substr($to, -1) == '/' ) {
			$to = substr($to, 0, strlen($to)-1);
		}
		$from_clear = custom_made_fix_remove_protocol_from_url($from, true);
		$to_clear = custom_made_fix_remove_protocol_from_url($to, true);
		return custom_made_fix_str_replace(
					array(
/* 1 */					urlencode("http://{$from_clear}"),						// http%3A%2F%2Fdemo.domain%2Furl
/* 2 */					urlencode("https://{$from_clear}"),						// https%3A%2F%2Fdemo.domain%2Furl
/* 3 */					urlencode($from),										// protocol%3A%2F%2Fdemo.domain%2Furl
/* 4 */					urlencode("//{$from_clear}"),							// %2F%2Fdemo.domain%2Furl
/* 5 */					"http://{$from_clear}",									// http://demo.domain/url
/* 6 */					str_replace('/', '\\/', "http://{$from_clear}"),		// http:\/\/demo.domain\/url
/* 7 */					"https://{$from_clear}",								// https://demo.domain/url
/* 8 */					str_replace('/', '\\/', "https://{$from_clear}"),		// https:\/\/demo.domain\/url
/* 9 */					$from,													// protocol://demo.domain/url
/* 10 */				str_replace('/', '\\/', $from),							// protocol:\/\/demo.domain\/url
/* 11 */				"//{$from_clear}",										// //demo.domain/url
/* 12 */				str_replace('/', '\\/', "//{$from_clear}"),				// \/\/demo.domain\/url
/* 13 */				$from_clear,											// demo.domain/url
/* 14 */				str_replace('/', '\\/', $from_clear)					// demo.domain\/url
						),
					array(
/* 1 */					urlencode(custom_made_fix_get_protocol() . "://{$to_clear}"),
/* 2 */					urlencode(custom_made_fix_get_protocol() . "://{$to_clear}"),
/* 3 */					urlencode($to),
/* 4 */					urlencode("//{$to_clear}"),
/* 5 */					custom_made_fix_get_protocol() . "://{$to_clear}",
/* 6 */					str_replace('/', '\\/', custom_made_fix_get_protocol() . "://{$to_clear}"),
/* 7 */					custom_made_fix_get_protocol() . "://{$to_clear}",
/* 8 */					str_replace('/', '\\/', custom_made_fix_get_protocol() . "://{$to_clear}"),
/* 9 */					$to,
/* 10 */				str_replace('/', '\\/', $to),
/* 11 */				"//{$to_clear}",
/* 12 */				str_replace('/', '\\/', "//{$to_clear}"),
/* 13 */				$to_clear,
/* 14 */				str_replace('/', '\\/', $to_clear)
						),
					$str
				);
	}
}

if ( ! function_exists( 'custom_made_fix_remove_protocol_from_url' ) ) {
	/**
	 * Remove a protocol from the URL.
	 *
	 * @param string $url     An URL to remove a protocol.
	 * @param bool $complete  Optional. If true - remove 'protocol:' and '//', else remove a 'protocol:' only.
	 *
	 * @return string         A processed string.
	 */
	function custom_made_fix_remove_protocol_from_url( $url, $complete = true ) {
		return preg_replace( '/(http[s]?:)?' . ( $complete ? '\\/\\/' : '' ) . '/', '', $url );
	}
}

if ( ! function_exists( 'custom_made_fix_get_protocol' ) ) {
	/**
	 * Return a current protocol ( http or https ) of the site.
	 * 
	 * @return string A string with a protocol.
	 */
	function custom_made_fix_get_protocol( $suffix = false ) {
		return ( is_ssl() ? 'https' : 'http' ) . ( ! empty( $suffix ) ? ':' : '' );
	}
}

if ( ! function_exists( 'custom_made_fix_str_replace' ) ) {
	/**
	 * Make a deep replacement with a support for arrays, objects and serialized strings.
	 *
	 * @param string|array $from  A string or array with strings to be replaced.
	 * @param string|array $to    A string or array with strings to replace on.
	 * @param mixed        $str   A string|array|object to search in.
	 *
	 * @return mixed              A processed string|array|object.
	 */
	function custom_made_fix_str_replace( $from, $to, $str ) {
		if ( is_array( $str ) ) {
			foreach ( $str as $k => $v ) {
				$str[ $k ] = custom_made_fix_str_replace( $from, $to, $v );
			}
		} elseif ( is_object( $str ) ) {
			if ( '__PHP_Incomplete_Class' !== get_class( $str ) ) {
				foreach ( $str as $k => $v ) {
					$str->{$k} = custom_made_fix_str_replace( $from, $to, $v );
				}
			}
		} elseif ( is_string( $str ) ) {
			if ( is_serialized( $str ) ) {
				$str = serialize( custom_made_fix_str_replace( $from, $to, custom_made_fix_unserialize( $str ) ) );
			} else {
				$str = str_replace( $from, $to, $str );
			}
		}
		return $str;
	}
}

if ( ! function_exists( 'custom_made_fix_unserialize_recover' ) ) {
	/**
	 * Recalculate string length counters in the serialized string.
	 * 
	 * @param string $str  A serialized string.
	 * 
	 * @return string      A processed string.
	 */
	function custom_made_fix_unserialize_recover( $str ) {
		return preg_replace_callback(
			'!s:(\d+):"(.*?)";!s',
			function( $match ) {
				return ( strlen( $match[2] ) == $match[1] )
					? $match[0]
					: 's:' . strlen( $match[2] ) . ':"' . $match[2] . '";';
			},
			$str
		);
	}
}

if ( ! function_exists( 'custom_made_fix_unserialize' ) ) {
	/**
	 * Try unserialize a string and process cases with CR and wrong string length counters.
	 *
	 * @param string $str  A serialized string.
	 *
	 * @return false|mixed Return an unserialized string or false if an unrecoverable error occurs.
	 */
	function custom_made_fix_unserialize( $str ) {
		if ( ! empty( $str ) && is_serialized( $str ) ) {
			// If serialized data contain an unrecoverable object (a base class for this object is not exists) - skip this string
			if ( true || ! preg_match( '/O:[0-9]+:"([^"]*)":[0-9]+:{/', $str, $matches ) || empty( $matches[1] ) || class_exists( $matches[1] ) ) {
				try {
					// Attempt 1: try unserialize original string
					$data = @unserialize( $str );
					// Attempt 2: try unserialize original string without CR symbol '\r'
					if ( false === $data ) {
						$str2 = str_replace( "\r", "", $str );
						$data = @unserialize( $str2 );
					}
					// Attempt 3: try unserialize original string with modified character counters
					if ( false === $data ) {
						$data = @unserialize( custom_made_fix_unserialize_recover( $str ) );
					}
					// Attempt 4: try unserialize original string without CR symbol '\r' with modified character counters
					if ( false === $data ) {
						$data = @unserialize( custom_made_fix_unserialize_recover( $str2 ) );
					}
				} catch ( Exception $e ) {
					if ( custom_made_is_on( custom_made_get_theme_option( 'debug_mode', false ) ) ) {
						dcl( $e->getMessage() );
					}
					$data = false;
				}
				return $data;
			} else {
				return $str;
			}
		} else {
			return $str;
		}
	}
}
