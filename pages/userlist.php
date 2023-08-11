<?php
$users = query("SELECT id, name, customcolor, rank, levels FROM users");

echo twigloader()->render('userlist.twig', [
	'users' => $users
]);
