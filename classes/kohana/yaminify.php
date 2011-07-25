<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Yaminify - Yet Another (Kohana) Minifier
 *
 * @package	Modulename
 * @category   Base
 * @author	 tdroL
 * @license	http://kohanaphp.com/license.html
 */
abstract class Kohana_Yaminify {

	/**
	* @var array configuration settings
	*/
	protected $_config = array();

	public static function factory()
	{
		return new Yaminify();
	}

	public function __construct() {
		$this->_config = Kohana::$config->load('yaminify')->as_array();
	}

	public function css($path)
	{
		$content = $this->read($path);

		if ( ! Arr::path($this->_config, 'css.minify') OR $content['minify'] === FALSE)
		{
			return $content['source'];
		}

		require_once Kohana::find_file('classes/vendor/jsmin', 'jsmin');
		require_once Kohana::find_file('classes/vendor/cssmin', 'CssMin');

		return CssMin::minify(
			$content['source'],
			Arr::path($this->_config, 'css.config.filters', array()),
			Arr::path($this->_config, 'css.config.plugins', array())
		);
	}

	public function js($path)
	{
		$content = $this->read($path);

		if ( ! Arr::path($this->_config, 'js.minify') OR $content['minify'] === FALSE)
		{
			return $content['source'];
		}

		require_once Kohana::find_file('classes/vendor/jsmin', 'jsmin');

		return JSMin::minify($content['source']);
	}

	public function cache($path, $source)
	{
		$info = pathinfo($path);
		$dir = $info['dirname'];
		$ext = $info['extension'];
		$filename = preg_replace('/^(.+?)\.\d{8,}\.min$/i', '$1', $info['filename']);

		$gc = (float) Arr::get($this->_config, 'gc', 1.0);
		$gc = max(min($gc, 1.0), 0.0); // limit range to [0.0, 1.0]

		if ($gc !== 0.0 AND ($gc === 1.0 OR (mt_rand()/mt_getrandmax()) <= $gc))
		{
			$regex = '/^'.preg_quote($filename).'\.\d+\.min\.'.$ext.'$/i';

			// collect old cached files
			foreach (new DirectoryIterator($dir) as $file)
			{
				if ( ! $file->isFile())
				{
					continue;
				}

				if (preg_match($regex, $file->getFilename()))
				{
					try
					{
						unlink($file->getPathname());
					} catch (Exception $e) {}
				}
			}
		}

		try
		{
			file_put_contents($path, $source);
		}
		catch (Exception $e)
		{
			return FALSE;
		}

		return TRUE;
	}

	protected function read($path)
	{
		$info = pathinfo($path);

		$filename = preg_replace('/^(.+?)\.\d{8,}\.min$/i', '$1', $info['filename']);

		// look for file.min.ext
		$original_min = $info['dirname'].'/'.$filename.'.min.'.$info['extension'];
		if (file_exists($original_min))
		{
			return array(
				'minify' => FALSE,
				'source' => file_get_contents($original_min)
			);
		}

		// look for file.ext
		$original = $info['dirname'].'/'.$filename.'.'.$info['extension'];
		if (file_exists($original))
		{
			return array(
				'minify' => TRUE,
				'source' => file_get_contents($original)
			);
		}

		throw new HTTP_Exception_404('Neithier :file_min nor :file does not exists', array(
			':file_min' => trim(str_ireplace(DOCROOT, '', $original_min), '/'),
			':file' => trim(str_ireplace(DOCROOT, '', $original), '/')
		));
	}
}
