<?php defined('SYSPATH') or die('No direct script access.');

if (Kohana::$environment !== Kohana::PRODUCTION)
{
	Kohana::modules(Kohana::modules() + array('userguide' => MODPATH.'userguide'));
}

$config = Kohana::config('yaminify')->as_array();

Route::set('yaminify-css', Arr::get($config, 'css.dir').'/<file>',
	array(
		'file'       => '.+' // strict: '.+?\.css'
	))
	->defaults(array(
		'controller' => 'yaminify',
		'action'     => 'css',
	));

Route::set('yaminify-js', Arr::path($config, 'js.dir').'/<file>',
	array(
		'file'       => '.+' // strict: '.+?\.js'
	))
	->defaults(array(
		'controller' => 'yaminify',
		'action'     => 'js',
	));