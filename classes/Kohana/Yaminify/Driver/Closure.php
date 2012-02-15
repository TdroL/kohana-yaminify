<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Yaminify_Driver_Closure extends Yaminify_Driver
{

	public static function minify_js($source)
	{
		if (empty($source))
		{
			return $source;
		}

		require_once 'Minify/JS/ClosureCompiler.php';

		$options = Arr::get(Yaminify::$config->js, 'options', array());

		return Minify_JS_ClosureCompiler::minify($source, $options);
	}

}
