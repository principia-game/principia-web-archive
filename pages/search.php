<?php
$query = (isset($_GET['query']) ? trim($_GET['query']) : '');
$page = $_GET['page'] ?? 1;

if ($query) {
	$levels = query("SELECT $userfields,l.id,l.title FROM levels l JOIN users u ON l.author = u.id WHERE (MATCH (l.title) AGAINST (?)) AND l.visibility = 0 "
			.paginate($page, $lpp),
		[$query]);
	$count = result("SELECT COUNT(*) FROM levels l WHERE (MATCH (l.title) AGAINST (?)) AND l.visibility = 0",
		[$query]);
}

echo twigloader()->render('search.twig', [
	'query' => $query,
	'page' => $page,
	'levels' => $levels ?? null,
	'level_count' => $count ?? null
]);
