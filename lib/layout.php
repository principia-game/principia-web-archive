<?php

function twigloader() {
	global $footerlinks, $uri, $path;

	$loader = new \Twig\Loader\FilesystemLoader('templates/');

	$twig = new \Twig\Environment($loader, [
		'cache' => TPL_CACHE,
		'auto_reload' => true,
	]);

	// Add principia-web specific extension
	$twig->addExtension(new PrincipiaExtension());

	$twig->addGlobal('glob_lpp', LPP);
	$twig->addGlobal('footerlinks', $footerlinks);
	$twig->addGlobal('domain', DOMAIN);
	$twig->addGlobal('uri', $uri);
	$twig->addGlobal('pagename', '/'.($path[1] ?? ''));

	return $twig;
}

function pagination($levels, $pp, $url, $current) {
	return twigloader()->render('components/pagination.twig', [
		'levels' => $levels, 'lpp' => $pp, 'url' => $url, 'current' => $current
	]);
}

function error($title, $message = '') {
	if ($title >= 400 && $title < 500) http_response_code($title);

	if (!$message && $title == '404')
		$message = "The requested page was not found.";

	twigloader()->display('_error.twig', ['err_title' => $title, 'err_message' => $message]);
	die();
}

function level($level) {
	if (!isset($level['visibility']) || $level['visibility'] != 1)
		$img = "/thumbs/low/".$level['id']."-0-0.jpg";
	else
		$img = "/locked_thumb.svg";

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

class PrincipiaExtension extends \Twig\Extension\AbstractExtension {
	public function getFunctions() {
		global $profiler;

		return [
			new \Twig\TwigFunction('level', 'level', ['is_safe' => ['html']]),
			new \Twig\TwigFunction('userlink', 'userlink', ['is_safe' => ['html']]),
			new \Twig\TwigFunction('pagination', 'pagination', ['is_safe' => ['html']]),
			new \Twig\TwigFunction('profiler_stats', function () use ($profiler) {
				$profiler->getStats();
			}),
		];
	}
	public function getFilters() {
		return [
			new \Twig\TwigFilter('cat_to_type', 'cat_to_type'),
		];
	}
}
