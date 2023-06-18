<?php
chdir('../');
require('lib/common.php');

$level = isset($_GET['i']) ? (int)$_GET['i'] : null;
$levelpath = sprintf('levels/%d.plvl', $level);

if (!$level || !file_exists($levelpath)) {
	readfile('internal/null.plvl');
	die();
}

readfile($levelpath);
