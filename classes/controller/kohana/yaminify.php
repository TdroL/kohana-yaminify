<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Kohana_Yaminify extends Controller
{

	public function action_minify()
	{
		$req_file = $this->request->param('file');

		$info = pathinfo($req_file);
		$ext = $info['extension'];

		// Get filename and timestamp
		$filename = preg_replace('/\.\d+\.(js|css)$/iD', '.$1', $req_file);
		$timestamp = preg_replace('/.+\.(\d+)\.(?:js|css)$/iD', '$1', $req_file);

		// Get source
		$config = Yaminify::$config->{$ext};
		$dir = Arr::get($config, 'dir');
		$dir = DOCROOT.(empty($dir) ? '' : (rtrim($dir, '/').'/'));

		$file = $dir.$filename;

		if ( ! file_exists($file) OR ! is_file($file))
		{
			throw HTTP_Exception::factory(404, 'File `:file` doesn\'t exists', array(
				':file' => Debug::path($file)
			));
		}

		// Confirm timestamp
		$file_timestamp = filemtime($file);
		if ($timestamp != $file_timestamp)
		{
			// Redirect to correct file
			$uri = str_ireplace('.'.$timestamp.'.'.$ext, '.'.$file_timestamp.'.'.$ext, $this->request->uri());

			HTTP::redirect(302, $uri);
		}

		$source = file_get_contents($file);

		// Minify
		$minified = Yaminify::minify($info['extension'], $source);

		$content_type = File::mime_by_ext($info['extension']);

		$this->response->headers('content-type', $content_type);
		$this->response->body($minified);

		if (Arr::get($config, 'cache'))
		{
			// Save minified source
			$cache_dir = Arr::get(Yaminify::$config, 'cache_dir');
			$cache_dir = DOCROOT.(empty($dir) ? '' : (rtrim($cache_dir, '/').'/'));

			$cache_file = $cache_dir.$req_file;
			$info = pathinfo($cache_file);

			if ( ! is_dir($info['dirname']))
			{
				mkdir($info['dirname'], 0777, TRUE);
				chmod($info['dirname'], 0777);
			}

			file_put_contents($cache_file, $minified);

			// Remove old cached files
			$cache_info = $cache_dir.$filename.'.current';

			if (file_exists($cache_info) AND is_file($cache_info))
			{
				$old_cache_file = file_get_contents($cache_info);

				try
				{
					// Remove old file
					unlink($old_cache_file);
				}
				catch(Exception $e) {}
			}

			file_put_contents($cache_info, $cache_file);
		}
	}
}
