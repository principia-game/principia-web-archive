<?php
if (!file_exists('conf/config.php'))
	die('Please read the installing instructions in the README file.');

// load profiler first
require_once('lib/profiler.php');
$profiler = new Profiler();

require_once('conf/config.php');
require('../principia-web/vendor/autoload.php');
foreach (glob("lib/*.php") as $file)
	require_once($file);

if (!str_contains($_SERVER['SCRIPT_NAME'], 'internal') && php_sapi_name() != "cli") {
	// Security headers.
	header("Content-Security-Policy:"
		."default-src 'self';"
		."script-src 'self' 'unsafe-inline';"
		."img-src 'self' data: *.voxelmanip.se voxelmanip.se *.imgur.com imgur.com *.github.com github.com *.githubusercontent.com;"
		."media-src 'self' *.voxelmanip.se voxelmanip.se;"
		."frame-src *.youtube-nocookie.com;"
		."style-src 'self' 'unsafe-inline';");

	header("Referrer-Policy: strict-origin-when-cross-origin");
	header("X-Content-Type-Options: nosniff");
	header("X-Frame-Options: SAMEORIGIN");
	header("X-Xss-Protection: 1; mode=block");
}

$userfields = userfields();

if (php_sapi_name() != "cli") {
	// Shorter variables for common $_SERVER values.
	$ipaddr = $_SERVER['REMOTE_ADDR'];
	$uri = $_SERVER['REQUEST_URI'] ?? null;

	// Redirect all non-internal pages to https if https is enabled.
	if (!isset($_SERVER['HTTPS']) && !isset($_COOKIE['force-http'])) {
		header("Location: https://".$_SERVER["HTTP_HOST"].$uri, true, 301);
		die();
	}
} else {
	// Dummy values for CLI usage
	$ipaddr = '127.0.0.1';
	$uri = '/';
}

$userdata = [
	'rank' => 0,
	'darkmode' => 1,
	'timezone' => 'Europe/Stockholm' // I'm a self-centered egomaniac! Time itself centers around me!
];

date_default_timezone_set($userdata['timezone']);
