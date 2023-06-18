<?php
require('lib/common.php');

$users = query("SELECT id, name, customcolor, rank FROM users");

echo twigloader()->render('userlist.twig', [
	'users' => $users
]);
