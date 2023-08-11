<?php
if (!file_exists('conf/config.php'))
	die('Please install.');

// load profiler first
class Profiler {
	private $starttime;

	function __construct() {
		$this->starttime = microtime(true);
	}

	function getStats() {
		printf("Rendered in %1.3fs with %dKB memory used", microtime(true) - $this->starttime, memory_get_usage(false) / 1024);
	}
}
$profiler = new Profiler();

require_once('conf/config.php');
require('../principia-web/vendor/autoload.php');
foreach (glob("lib/*.php") as $file)
	require_once($file);

$userfields = userfields();

if (php_sapi_name() != "cli") {
	// Shorter variables for common $_SERVER values.
	$ipaddr = $_SERVER['REMOTE_ADDR'];
	$uri = $_SERVER['REQUEST_URI'] ?? null;

	// Redirect all non-internal pages to https if https is enabled.
	if (!isset($_SERVER['HTTPS'])) {
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
