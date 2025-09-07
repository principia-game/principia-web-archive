<?php
require('data/public_levels.php');

query("USE `".DB_NAME_ARCHIVE."`");

if (isset($path[1]) && $path[1] != '') {
	// If page file exists, include that one
	if (file_exists('pages/'.$path[1].'.php'))
		require('pages/'.$path[1].'.php');

	// Test for internal pages
	else if ($path[1] == 'internal' && in_array($path[2], ['get_level', 'derive_level', 'edit_level'])) {
		require('../principia-web/internal/get_level.php');
	} else
		error('404', "The requested page wasn't found.");
} else
	require('pages/index.php');
