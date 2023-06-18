<?php
require('lib/common.php');

$lockedlevels = query("SELECT $userfields l.id id,l.title title,l.visibility visibility FROM levels l JOIN users u ON l.author = u.id WHERE l.visibility = 1 ORDER BY l.id DESC");

echo twigloader()->render('viewlocked.twig', [
	'levels' => fetchArray($lockedlevels)
]);