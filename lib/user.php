<?php

function powIdToName($id) {
	return match ($id) {
		1  => 'user',
		2  => 'moderator',
		3  => 'admin'
	};
}

function tcount($c) {
	return $c > 1 ? '<span class="num_trophees">'.$c.'</span>' : '';
}

function userlink($user, $pre = '') {
	if ($user[$pre.'customcolor'])
		$user[$pre.'name'] = sprintf('<span style="color:#%s">%s</span>', $user[$pre.'customcolor'], $user[$pre.'name']);

	$trophy = '';
	$black = $user[$pre.'t_black'] ?? 0;
	$gold = $user[$pre.'t_gold'] ?? 0;
	$silver = $user[$pre.'t_silver'] ?? 0;
	if ($black) $trophy .= '<span class="trophee bdiamond">'.tcount($black).'</span>';
	if ($gold) $trophy .= '<span class="trophee gold">'.tcount($gold).'</span>';
	if ($silver) $trophy .= '<span class="trophee silver">'.tcount($silver).'</span>';


	return sprintf(
		'<a class="user" href="/user/%d"><span class="t_%s">%s%s</span></a>',
	$user[$pre.'id'], powIdToName($user[$pre.'rank']), $user[$pre.'name'], $trophy);
}

function userfields() {
	$fields = ['id', 'name', 'rank', 'customcolor', 't_black', 't_gold', 't_silver'];

	$out = '';
	foreach ($fields as $field)
		$out .= sprintf('u.%s u_%s,', $field, $field);

	return $out;
}
