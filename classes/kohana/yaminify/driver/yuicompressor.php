<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Yaminify_Driver_Yuicompressor extends Yaminify_Driver
{

	public static function minify_js($source)
	{
		if (empty($source))
		{
			return $source;
		}

		require_once 'Minify/YUICompressor.php';

		$options = Arr::get(Yaminify::$config->js, 'options', array());

		return Minify_YUICompressor::minifyJs($source, $options);
	}

	public static function minify_css($source)
	{
		if (empty($source))
		{
			return $source;
		}

		require_once 'Minify/YUICompressor.php';

		$options = Arr::get(Yaminify::$config->css, 'options', array());

		$minified = Minify_YUICompressor::minifyCss($source, $options)

		if (Arr::get($options, 'removeAllLineBreaks'))
		{
			// remove all new lines
			$minified = preg_replace('/(\w)\n(\w)/i', '$1 $2', $minified);
		}

		return $minified;
	}

}
