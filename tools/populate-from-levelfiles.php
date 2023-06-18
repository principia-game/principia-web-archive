<?php
require('lib/common.php');

for ($i=0; $i < 30000; $i++) {
	if (!file_exists("/run/media/rollerozxa/apZodIaL1/Principia/site-archive-dump/levels/".$i.".plvl")) continue;

	try {
		$lvl = Plvl::fromFile("/run/media/rollerozxa/apZodIaL1/Principia/site-archive-dump/levels/".$i.".plvl");
	} catch (Kaitai\Struct\Error\KaitaiError $e) {
		print($i." is garbl garbl");
	}

	if ($lvl->version() == 0) {
		print($i." has version 0??????????? WHAT IN THE ABSOLUTE FUCK????????????");
		continue;
	}

	print($i.PHP_EOL);

	query("UPDATE levels SET title = ?, description = ?, parent = ?, revision = ?, visibility = ? WHERE id = ?",
		[$lvl->name(), $lvl->descr(), $lvl->parentId(), $lvl->revision(), $lvl->visibility(), $i]);
}
