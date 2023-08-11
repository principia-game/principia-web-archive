<?php
require('lib/common.php');

$levelIds = [];

$levels = query("SELECT id FROM levels");

while ($level = $levels->fetch())
	$levelIds[$level['id']] = true;

$missing = [];

for ($i = 140; $i < 30000; $i++) {
	$fileExists = file_exists('data/levels/'.$i.'.plvl');
	$levelExists = isset($levelIds[$i]);

	if ($fileExists !== $levelExists) {
		print("Level ".$i." is disrepancy!! ");

		if (!$fileExists) print("(file doesn't exist)");
		if (!$levelExists) print("(level doesn't exists)");

		print(PHP_EOL);

		$missing[] = $i;
	}
}

foreach ($missing as $miss)
	print(" $miss.plvl");
