<?php

function type_to_cat($type) {
	return match ($type) {
		'custom'	=> 1,
		'adventure'	=> 2,
		'puzzle'	=> 3,
		default 	=> 99, // Fallback option: none
	};
}

function cat_to_type($cat) {
	return match ($cat) {
		1 => 'custom',
		2 => 'adventure',
		3 => 'puzzle'
	};
}
