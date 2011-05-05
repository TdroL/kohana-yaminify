<?php defined('SYSPATH') or die('No direct script access.');

if (Kohana::$environment !== Kohana::PRODUCTION)
{
	Kohana::modules(Kohana::modules() + array('userguide' => MODPATH.'userguide'));
}

$config = Kohana::config('yaminify')->as_array();

$css = Arr::get($config, 'css');

if (Arr::get($css, 'minify'))
{
	Route::set('yaminify-css', Arr::get($css, 'dir').'/<file>',
		array(
			'file'       => '.+' // strict: '.+?\.css'
		))
		->defaults(array(
			'controller' => 'yaminify',
			'action'     => 'css',
		));
}

$js = Arr::get($config, 'js');

if (Arr::get($js, 'minify'))
{
	Route::set('yaminify-js', Arr::get($js, 'dir').'/<file>',
		array(
			'file'       => '.+' // strict: '.+?\.js'
		))
		->defaults(array(
			'controller' => 'yaminify',
			'action'     => 'js',
		));
}
