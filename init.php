<?php defined('SYSPATH') or die('No direct script access.');

/** routes **/

Yaminify::init();

$cache_dir = empty(Yaminify::$config->cache_dir) ? '' : (rtrim(Yaminify::$config->cache_dir, '/').'/');

Route::set('yaminify', $cache_dir.'<file>', array(
		'file' => '.+\.(?:js|css)$'
	))
	->defaults(array(
		'controller' => 'yaminify',
		'action'     => 'minify',
	));
