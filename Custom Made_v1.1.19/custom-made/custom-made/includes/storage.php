<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('custom_made_storage_get')) {
	function custom_made_storage_get($var_name, $default='') {
		global $CUSTOM_MADE_STORAGE;
		return isset($CUSTOM_MADE_STORAGE[$var_name]) ? $CUSTOM_MADE_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('custom_made_storage_set')) {
	function custom_made_storage_set($var_name, $value) {
		global $CUSTOM_MADE_STORAGE;
		$CUSTOM_MADE_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('custom_made_storage_empty')) {
	function custom_made_storage_empty($var_name, $key='', $key2='') {
		global $CUSTOM_MADE_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($CUSTOM_MADE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($CUSTOM_MADE_STORAGE[$var_name][$key]);
		else
			return empty($CUSTOM_MADE_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('custom_made_storage_isset')) {
	function custom_made_storage_isset($var_name, $key='', $key2='') {
		global $CUSTOM_MADE_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($CUSTOM_MADE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($CUSTOM_MADE_STORAGE[$var_name][$key]);
		else
			return isset($CUSTOM_MADE_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('custom_made_storage_inc')) {
	function custom_made_storage_inc($var_name, $value=1) {
		global $CUSTOM_MADE_STORAGE;
		if (empty($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = 0;
		$CUSTOM_MADE_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('custom_made_storage_concat')) {
	function custom_made_storage_concat($var_name, $value) {
		global $CUSTOM_MADE_STORAGE;
		if (empty($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = '';
		$CUSTOM_MADE_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('custom_made_storage_get_array')) {
	function custom_made_storage_get_array($var_name, $key, $key2='', $default='') {
		global $CUSTOM_MADE_STORAGE;
		
		if ( '' === $key2 ) {
			return ! empty( $var_name ) && '' !== $key && isset( $CUSTOM_MADE_STORAGE[ $var_name ][ $key ] ) ? $CUSTOM_MADE_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && '' !== $key && isset( $CUSTOM_MADE_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $CUSTOM_MADE_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if (!function_exists('custom_made_storage_set_array')) {
	function custom_made_storage_set_array($var_name, $key, $value) {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if ($key==='')
			$CUSTOM_MADE_STORAGE[$var_name][] = $value;
		else
			$CUSTOM_MADE_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('custom_made_storage_set_array2')) {
	function custom_made_storage_set_array2($var_name, $key, $key2, $value) {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if (!isset($CUSTOM_MADE_STORAGE[$var_name][$key])) $CUSTOM_MADE_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$CUSTOM_MADE_STORAGE[$var_name][$key][] = $value;
		else
			$CUSTOM_MADE_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('custom_made_storage_merge_array')) {
	function custom_made_storage_merge_array($var_name, $key, $value) {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if ($key==='')
			$CUSTOM_MADE_STORAGE[$var_name] = array_merge($CUSTOM_MADE_STORAGE[$var_name], $value);
		else
			$CUSTOM_MADE_STORAGE[$var_name][$key] = array_merge($CUSTOM_MADE_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('custom_made_storage_set_array_after')) {
	function custom_made_storage_set_array_after($var_name, $after, $key, $value='') {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if (is_array($key))
			custom_made_array_insert_after($CUSTOM_MADE_STORAGE[$var_name], $after, $key);
		else
			custom_made_array_insert_after($CUSTOM_MADE_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('custom_made_storage_set_array_before')) {
	function custom_made_storage_set_array_before($var_name, $before, $key, $value='') {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if (is_array($key))
			custom_made_array_insert_before($CUSTOM_MADE_STORAGE[$var_name], $before, $key);
		else
			custom_made_array_insert_before($CUSTOM_MADE_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('custom_made_storage_push_array')) {
	function custom_made_storage_push_array($var_name, $key, $value) {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($CUSTOM_MADE_STORAGE[$var_name], $value);
		else {
			if (!isset($CUSTOM_MADE_STORAGE[$var_name][$key])) $CUSTOM_MADE_STORAGE[$var_name][$key] = array();
			array_push($CUSTOM_MADE_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('custom_made_storage_pop_array')) {
	function custom_made_storage_pop_array($var_name, $key='', $defa='') {
		global $CUSTOM_MADE_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($CUSTOM_MADE_STORAGE[$var_name]) && is_array($CUSTOM_MADE_STORAGE[$var_name]) && count($CUSTOM_MADE_STORAGE[$var_name]) > 0) 
				$rez = array_pop($CUSTOM_MADE_STORAGE[$var_name]);
		} else {
			if (isset($CUSTOM_MADE_STORAGE[$var_name][$key]) && is_array($CUSTOM_MADE_STORAGE[$var_name][$key]) && count($CUSTOM_MADE_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($CUSTOM_MADE_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('custom_made_storage_inc_array')) {
	function custom_made_storage_inc_array($var_name, $key, $value=1) {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if (empty($CUSTOM_MADE_STORAGE[$var_name][$key])) $CUSTOM_MADE_STORAGE[$var_name][$key] = 0;
		$CUSTOM_MADE_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('custom_made_storage_concat_array')) {
	function custom_made_storage_concat_array($var_name, $key, $value) {
		global $CUSTOM_MADE_STORAGE;
		if (!isset($CUSTOM_MADE_STORAGE[$var_name])) $CUSTOM_MADE_STORAGE[$var_name] = array();
		if (empty($CUSTOM_MADE_STORAGE[$var_name][$key])) $CUSTOM_MADE_STORAGE[$var_name][$key] = '';
		$CUSTOM_MADE_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('custom_made_storage_call_obj_method')) {
	function custom_made_storage_call_obj_method($var_name, $method, $param=null) {
		global $CUSTOM_MADE_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($CUSTOM_MADE_STORAGE[$var_name]) ? $CUSTOM_MADE_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($CUSTOM_MADE_STORAGE[$var_name]) ? $CUSTOM_MADE_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('custom_made_storage_get_obj_property')) {
	function custom_made_storage_get_obj_property($var_name, $prop, $default='') {
		global $CUSTOM_MADE_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($CUSTOM_MADE_STORAGE[$var_name]->$prop) ? $CUSTOM_MADE_STORAGE[$var_name]->$prop : $default;
	}
}
?>