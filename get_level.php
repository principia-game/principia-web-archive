<?php
$level = isset($_GET['i']) ? (int)$_GET['i'] : null;
$levelpath = sprintf('data/levels/%d.plvl', $level);

if (!$level || !file_exists($levelpath))
	die();

readfile($levelpath);
