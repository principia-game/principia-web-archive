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
require('../principia-web/lib/cache.php');

$userfields = userfields();

date_default_timezone_set('Europe/Stockholm');
