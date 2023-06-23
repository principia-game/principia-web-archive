<?php
require('lib/common.php');

$lid = $_GET['id'] ?? 0;

$level = fetch("SELECT $userfields l.* FROM levels l JOIN users u ON l.author = u.id WHERE l.id = ?", [$lid]);

if (!$level) error('404', "The requested level wasn't found.");

$leaderboard = query("SELECT $userfields l.* FROM leaderboard l JOIN users u ON l.user = u.id WHERE l.level = ? ORDER BY l.score DESC LIMIT 8", [$level['id']]);

$derivatives = query("SELECT $userfields l.id id,l.title title FROM levels l JOIN users u ON l.author = u.id WHERE l.parent = ? AND l.visibility = 0 ORDER BY l.id DESC", [$lid]);
if ($level['parent']) {
	$parentLevel = fetch("SELECT $userfields l.id id,l.title title FROM levels l JOIN users u ON l.author = u.id WHERE l.id = ? AND l.visibility = 0", [$level['parent']]);
}

echo twigloader()->render('level.twig', [
	'lid' => $lid,
	'level' => $level,
	'derivatives' => fetchArray($derivatives),
	'parentlevel' => $parentLevel ?? null,
	'leaderboard' => fetchArray($leaderboard)
]);
