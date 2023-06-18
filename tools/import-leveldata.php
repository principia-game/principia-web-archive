<?php
require('lib/common.php');

$data = json_decode(file_get_contents('tools/leveldata.json'));

foreach ($data as $l) {
	query("INSERT INTO levels (id, cat, title, author, time, visibility, likes, downloads, platform) VALUES (?,?,?,?,?,?,?,?,?)",
		[$l->id, $l->cat, $l->title, $l->author, $l->uploaded, $l->locked, $l->likes, $l->downloads, $l->platform]);
}
