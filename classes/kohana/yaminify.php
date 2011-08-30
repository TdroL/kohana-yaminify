<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Yaminify
{
	public static $config;

	public static function init()
	{
		static $inited = false;

		if ($inited) return;
		$inited = true;

		// load config
		Yaminify::$config = Kohana::$config->load('yaminify');

		$cache_dir = (empty(Yaminify::$config->cache_dir) ? '' : (rtrim(Yaminify::$config->cache_dir, '/').'/'));

		if ( ! is_dir(DOCROOT.$cache_dir) OR ! is_writable(DOCROOT.$cache_dir))
		{
			throw new HTTP_Exception_500('Cache directory `:dir` doesn\'t exists or is not writable', array(
				':dir' => $cache_dir
			));
		}

		// find Minify
		$path = Kohana::find_file('vendor', 'minify/min/lib/Minify');

		if (empty($path))
		{
			throw new HTTP_Exception_500('Run `git submodule update --init --recursive` or download minify (https://github.com/mrclay/minify) into `classes/vendor/minify/` directory.');
		}

		// set path to Minify
		$path = str_ireplace('/Minify.php', '', $path);
		set_include_path(get_include_path().PATH_SEPARATOR.$path);
	}

	public static function stamp($file)
	{
		$info = pathinfo($file);

		// skip minified or non-existing files
		if (substr($info['filename'], -4) == '.min' OR ! file_exists(DOCROOT.$file))
		{
			return Url::site($file);
		}

		// get last modification date
		$timestamp = filemtime(DOCROOT.$file);

		// get path to cache directory
		$cache_dir = empty(Yaminify::$config->cache_dir) ? '' : (rtrim(Yaminify::$config->cache_dir, '/').'/');

		$dir = Arr::get(Yaminify::$config->{$info['extension']}, 'dir');

		// remove file directory
		if (preg_match('/^'.preg_quote($dir, '/').'/i', $info['dirname']))
		{
			$append_dir = trim(str_ireplace($dir, '', $info['dirname']), '/');

			if ( ! empty($append_dir))
			{
				$cache_dir .= $append_dir.'/';
			}

		}

		return Url::site($cache_dir.$info['filename'].'.'.$timestamp.'.'.$info['extension']);
	}

	public static function minify($type, $source)
	{
		$config = Yaminify::$config->{$type};

		if ( ! Arr::get($config, 'minify'))
		{
			return $source;
		}

		$driver = 'Yaminify_Driver_'.ucfirst(strtolower(Arr::get($config, 'driver')));

		$call = array($driver, 'minify_'.$type);

		if ( ! is_callable($call))
		{
			throw new HTTP_Exception_500('Driver `:driver` must implement `:method` method', array(
				':driver' => $call[0],
				':method' => $call[1]
			));
		}

		return call_user_func(array($driver, 'minify_'.$type), $source);
	}
}
