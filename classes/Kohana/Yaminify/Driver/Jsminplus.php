<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Yaminify_Driver_Jsminplus extends Yaminify_Driver
{

	public static function minify_js($source)
	{
		if (empty($source))
		{
			return $source;
		}

		require_once 'JSMinPlus.php';
		return JSMinPlus::minify($source);
	}

}
