<?php

function powIdToName($id) {
	return match ($id) {
		1  => 'user',
		2  => 'moderator',
		3  => 'admin'
	};
}

function userlink($user, $pre = '') {
	if ($user[$pre.'customcolor'])
		$user[$pre.'name'] = sprintf('<span style="color:#%s">%s</span>', $user[$pre.'customcolor'], $user[$pre.'name']);

	return sprintf(
		'<a class="user" href="/user/%d"><span class="t_%s">%s</span></a>',
	$user[$pre.'id'], powIdToName($user[$pre.'rank']), $user[$pre.'name']);
}

function userfields() {
	$fields = ['id', 'name', 'rank', 'customcolor'];

	$out = '';
	foreach ($fields as $field)
		$out .= sprintf('u.%s u_%s,', $field, $field);

	return $out;
}
