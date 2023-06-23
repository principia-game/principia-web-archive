<?php
require('lib/common.php');

$randomlevels = randomLevels(20);

echo twigloader()->render('random.twig', [
	'levels' => $randomlevels
]);
