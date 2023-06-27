<?php
$host = 'localhost';
$db   = 'principia';
$user = '';
$pass = '';

$tplCache = 'templates/cache';
$tplNoCache = false; // **DO NOT SET AS TRUE IN PROD - DEV ONLY**

$lpp = 20;

// Website domain.
$domain = 'example.org';

// Stub function to put special information in the footer.
function customInfo() { }

// Stub function to put special information in the header.
function customHeader() { }

$footerlinks = [
	'https://principia-web.se/' => 'Go back'
];
