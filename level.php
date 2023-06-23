<?php
require('lib/common.php');

$lid = $_GET['id'] ?? 0;

$level = fetch("SELECT $userfields l.* FROM levels l JOIN users u ON l.author = u.id WHERE l.id = ?", [$lid]);

if (!$level) error('404', "The requested level wasn't found.");


$derivatives = query("SELECT $userfields l.id id,l.title title FROM levels l JOIN users u ON l.author = u.id WHERE l.parent = ? AND l.visibility = 0 ORDER BY l.id DESC", [$lid]);
if ($level['parent']) {
	$parentLevel = fetch("SELECT $userfields l.id id,l.title title FROM levels l JOIN users u ON l.author = u.id WHERE l.id = ? AND l.visibility = 0", [$level['parent']]);
}

echo twigloader()->render('level.twig', [
	'lid' => $lid,
	'level' => $level,
	'derivatives' => fetchArray($derivatives),
	'parentlevel' => $parentLevel ?? null
]);
