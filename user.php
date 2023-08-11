<?php
require('lib/common.php');

if (isset($_GET['id']))
	$userpagedata = fetch("SELECT * FROM users WHERE id = ?", [$_GET['id']]);
else if (isset($_GET['name']))
	$userpagedata = fetch("SELECT * FROM users WHERE name = ?", [$_GET['name']]);

if (isset($_GET['id']) && $_GET['id'] < 13797 && !$userpagedata) error('404', "Users that hadn't uploaded a level has been excluded from the archive.");

if (!isset($userpagedata) || !$userpagedata) error('404', "No user specified.");

$id = $userpagedata['id'];

$page = $_GET['page'] ?? 1;

$levels = query("SELECT $userfields l.id id,l.title title
		FROM levels l JOIN users u ON l.author = u.id
		WHERE l.author = ? AND l.visibility = 0 ORDER BY l.id DESC ".paginate($page, $lpp),
	[$id]);

$levelcount = result("SELECT COUNT(*) FROM levels WHERE author = ? AND visibility = 0", [$id]);

echo twigloader()->render('user.twig', [
	'id' => $id,
	'name' => $userpagedata['name'],
	'userpagedata' => $userpagedata,
	'levels' => fetchArray($levels),
	'level_count' => $levelcount,
	'page' => $page
]);
