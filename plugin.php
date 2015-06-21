<?php
/*
Plugin Name: API Action - List Keywords
Plugin URI: http://www.claytondaley.com/
Description: Adds a "list" action to the API. This action accepts a long URL through the "url" parameter and returns two values (1) an array of keywords and (2) the base URL required to construct shorturls for these keywords.
Version: 1.0
Author: Clayton Daley (derived from API-Action by Ozh)
Author URI: http://www.claytondaley.com/
*/

// Define custom action "delete"
yourls_add_filter( 'api_action_list', 'clayton_api_action_list' );

/**
 * API function wrapper: List all shorturls that redirect to a URL
 *
 * @since prototype
 * @return array Result of API call
 */

function clayton_api_action_list() {
	// Need 'url' parameter
	if( !isset( $_REQUEST['url'] ) ) {
		return array(
			'statusCode' => 400,
			'simple'     => "Need a 'url' parameter",
			'message'    => 'error: missing param',
		);	
	}
	
	$url = $_REQUEST['url'];

	// Check if valid url
	if( filter_var($url, FILTER_VALIDATE_URL) === FALSE ) {
		return array(
			'statusCode' => 404,
			'simple '    => 'Error: URL not found or not valid',
			'message'    => 'error: not found or not valid',
		);	
	}
	
	// Prevent DB flood
	$ip = yourls_get_IP();
	yourls_check_IP_flood( $ip );
	
	// Get and return keyword list
	$keywords = yourls_get_keywords($url);
	$return = array(
		'statusCode' => 200,
		'simple'     => 'Need either XML or JSON format for list',
		'message'    => 'success',
		'list'       => array( 
			'baseurl'    => YOURLS_SITE . '/',
		    'keywords'   => $keywords,
            )
		);
	return yourls_apply_filter( 'api_result_list', $return );
	
}
