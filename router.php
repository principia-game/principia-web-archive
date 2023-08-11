<?php
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = explode('/', $uri);

require('lib/common.php');

if ($path[1]) {
	// If page file exists, include that one
	if (file_exists('pages/'.$path[1].'.php')) {
		require('pages/'.$path[1].'.php');
	}
	// Test for internal pages
	else if ($path[1] == 'apZodIaL1') {

		if ($path[2] == 'x.php' || $path[2] == 'xxx.php' || $path[2] == 'xxxxxx.php')
			require('get_level.php');
	}
	else
		error('404', "The requested page wasn't found.");
} else
	require('pages/index.php');
