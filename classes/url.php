<?php defined('SYSPATH') or die('No direct script access.');

class Url extends Kohana_Url
{
	public static function stamp($path)
	{
		$file = DOCROOT.$path;

		if (file_exists($file))
		{
			$ctime = filectime($file);

			$info = pathinfo($path);

			$filename = $info['filename'];
			$min = '';

			if (substr($filename, -4, 4) == '.min')
			{
				$filename = substr($info['filename'], 0, -4);
				$min = '.min';
			}

			$file = $info['dirname'].'/'.
					$filename.'.'.
					$ctime.$min.'.'.
					$info['extension'];
		}
		else
		{
			$info = pathinfo($file);

			if (substr($info['filename'], -4, 4) != '.min')
			{
				$file = $path;
			}
			else
			{
				$filename = substr($info['filename'], 0, -4);

				$file = $info['dirname'].'/'.
						$filename.'.'.
						$info['extension'];

				if (file_exists($file))
				{
					$ctime = filectime($file);

					$min = '';
					$config = Kohana::config('yaminify.'.$info['extension']);

					if (Arr::get($config, 'minify'))
					{
						$min = '.min';
					}

					$info = pathinfo($path);

					$file = $info['dirname'].'/'.
							$filename.'.'.
							$ctime.$min.'.'.
							$info['extension'];
				}
				else
				{
					$file = $path;
				}
			}
		}

		return Url::site($file);
	}
}