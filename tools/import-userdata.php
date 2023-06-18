<?php
require('lib/common.php');

$data = json_decode(file_get_contents('tools/userdata.json'));

foreach ($data as $user) {
	query("INSERT INTO users (id, name) VALUES (?,?)",
		[$user->id, $user->name]); // WTF??? Python generates straight JSON
}
