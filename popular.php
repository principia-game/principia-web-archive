<?php
require('lib/common.php');

$page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1);

$limit = sprintf("LIMIT %s,%s", (($page - 1) * $lpp), $lpp);
$levels = query("SELECT $userfields l.id id,l.title title FROM levels l
		JOIN users u ON l.author = u.id WHERE l.visibility = 0 ORDER BY l.downloads DESC, l.id DESC $limit");
$count = result("SELECT COUNT(*) FROM levels WHERE visibility = 0");

echo twigloader()->render('popular.twig', [
	'levels' => $levels,
	'page' => $page,
	'level_count' => $count
]);
