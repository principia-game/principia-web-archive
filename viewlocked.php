<?php
require('lib/common.php');

$lockedlevels = query("SELECT $userfields,l.id,l.title,l.visibility FROM levels l JOIN users u ON l.author = u.id WHERE l.visibility = 1 ORDER BY l.id DESC");

echo twigloader()->render('viewlocked.twig', [
	'levels' => fetchArray($lockedlevels)
]);