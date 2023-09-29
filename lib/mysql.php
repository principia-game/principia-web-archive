<?php

$options = [
	PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES		=> false,
];
try {
	$sql = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
	die("Error - Can't connect to database. Please try again later.");
}

function query($query,$params = []) {
	global $sql;

	$res = $sql->prepare($query);
	$res->execute($params);
	return $res;
}

function fetch($query,$params = []) {
	$res = query($query,$params);
	return $res->fetch();
}

function result($query,$params = []) {
	$res = query($query,$params);
	return $res->fetchColumn();
}

function fetchArray($query) {
	$out = [];
	while ($record = $query->fetch())
		$out[] = $record;

	return $out;
}

function paginate($page, $pp) {
	$page = (is_numeric($page) && $page > 0 ? $page : 1);

	return sprintf(" LIMIT %s, %s", (($page - 1) * $pp), $pp);
}
