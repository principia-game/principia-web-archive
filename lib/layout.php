<?php

function twigloader($subfolder = '') {
	global $tplCache, $tplNoCache, $lpp, $footerlinks, $domain, $uri;

	$doCache = ($tplNoCache ? false : $tplCache);

	$loader = new \Twig\Loader\FilesystemLoader('templates/' . $subfolder);

	$twig = new \Twig\Environment($loader, [
		'cache' => $doCache,
	]);

	// Add principia-web specific extension
	$twig->addExtension(new PrincipiaExtension());

	$twig->addGlobal('glob_lpp', $lpp);
	$twig->addGlobal('footerlinks', $footerlinks);
	$twig->addGlobal('domain', $domain);
	$twig->addGlobal('uri', $uri);
	$twig->addGlobal('pagename', substr($_SERVER['PHP_SELF'], 0, -4));

	return $twig;
}

function pagination($levels, $lpp, $url, $current) {
	$twig = twigloader('components');

	return $twig->render('pagination.twig', [
		'levels' => $levels, 'lpp' => $lpp, 'url' => $url, 'current' => $current
	]);
}

function error($title, $message) {
	if ($title >= 400 && $title < 500) http_response_code($title);

	$twig = twigloader();

	echo $twig->render('_error.twig', ['err_title' => $title, 'err_message' => $message]);
	die();
}

function level($level) {
	if (!isset($level['visibility']) || $level['visibility'] != 1)
		$img = "/thumbs/low/".$level['id']."-0-0.jpg";
	else
		$img = "/assets/locked_thumb.svg";

	$author = userlink($level, 'u_');

	$title = strlen($level['title']) > 57 ? substr($level['title'], 0, 57).'...' : $level['title'];

	return <<<HTML
<div class="level" id="l-{$level['id']}">
	<a class="lvlbox_top" href="/level/{$level['id']}">
		<img src="{$img}" alt="" loading="lazy">
		<div class="lvltitle">{$title}</div>
	</a>
	{$author}
</div>
HTML;
}

function redirect($url) {
	header(sprintf('Location: %s', $url));
	die();
}
