<?php
require('../principia-web/lib/sitemap.php');

$sitemap = new Sitemap('https://archive.principia-web.se/');

$sitemap->add('');

$levels = query("SELECT id FROM levels WHERE visibility = 0");
while ($level = $levels->fetch()) {
	$sitemap->add('level/'.$level['id']);
}

$users = query("SELECT id FROM users ORDER BY id");
while ($user = $users->fetch()) {
	$sitemap->add('user/'.$user['id']);
}

$sitemap->output();
