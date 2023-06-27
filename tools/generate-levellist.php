<?php
require('lib/common.php');

$levels = query("SELECT id FROM levels WHERE visibility = 0");

$levelIds = [];

while ($level = $levels->fetch()) {
	$levelIds[] = $level['id'];
}

echo '<?php'.PHP_EOL.'$publicLevels = ['.PHP_EOL."\t".implode(',', $levelIds).PHP_EOL.'];'.PHP_EOL;
