YOURLS Plugin:  API Action - List Keywords for URL
==================================================

Plugin for YOURLS adding a "list" action to the API that returns all keywords that forward to a specific URL

# What for

This plug-in adds the "list" action to the YOURLS API.
`http://my.url/yourls-api.php?username=x&password=xx&action=list&url=http://my.domain.com/my/long/url&format=json` 

A successful API call returns an array(
	'statusCode' => 200,
	'simple'     => 'Need either XML or JSON format for list',
	'message'    => 'success',
	'list'       => array
		( 
		'baseurl'    => [yourls base url with trailing slash],
		'keywords'   => array
			(
			0 => [keyword1],
			1 => [keyword2],
			),
		)
	)

# How to

* In `/user/plugins`, create a new folder named `yourls-api-list`
* Drop these files in that directory
* Go to the Plugins administration page and activate the plugin 
* Have fun
