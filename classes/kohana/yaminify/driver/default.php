<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Yaminify_Driver_Default extends Yaminify_Driver
{

	public static function minify_html($source)
	{
		if (empty($source))
		{
			return $source;
		}

		require_once 'Minify/HTML.php';

		$options = Arr::get(Yaminify::$config->html, 'options', array());

		return Minify_HTML::minify($source, $options);
	}

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

	public static function minify_css($source)
	{
		if (empty($source))
		{
			return $source;
		}

		require_once 'Minify/CSS.php';

		$options = Arr::get(Yaminify::$config->css, 'options', array());

		return Minify_CSS::minify($source, $options);
	}

}
