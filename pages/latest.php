<?php
$type = (isset($path[2]) && type_to_cat($path[2]) != 99 ? $path[2] : 'all');
$page = $_GET['page'] ?? 1;

$where = ($type != 'all' ? "WHERE l.cat = ".type_to_cat($type).' AND l.visibility = 0' : 'WHERE visibility = 0');
$levels = query("SELECT l.id,l.title,$userfields FROM levels l JOIN users u ON l.author = u.id $where ORDER BY l.id DESC ".paginate($page, LPP));
$count = result("SELECT COUNT(*) FROM levels l $where");

twigloader()->display('latest.twig', [
	'type' => $type,
	'levels' => $levels,
	'page' => $page,
	'level_count' => $count
]);
