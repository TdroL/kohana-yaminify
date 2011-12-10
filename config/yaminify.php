<?php defined('SYSPATH') or die('No direct script access.');

return array(
	// Cache directory - must be writable and visible to world
	'cache_dir' => 'assets/cache',
	'html' => array(
		'minify' => TRUE,
		'driver' => 'default',
		'options' => array(
			/**
			 * HTML:
			 *
			 * 'xhtml' => false,
			 * 'cssMinifier' => false,
			 * 'jsMinifier' => false,
			 */

			// 'cssMinifier' => array('Yaminify_Driver_Default', 'minify_css'),
			// 'jsMinifier'  => array('Yaminify_Driver_Default', 'minify_js')
		)
	),
	'css' => array(
		'minify' => TRUE,
		'dir' => 'assets/css',
		'cache' => TRUE,
		'driver' => 'default',
		'options' => array(
			'removeAllLineBreaks' => TRUE,
			/**
			 * CSS:
			 *
			 * 'removeCharsets' => true,
			 * 'preserveComments' => true,
			 * 'currentDir' => null,
			 * 'docRoot' => $_SERVER['DOCUMENT_ROOT'],
			 * 'prependRelativePath' => null,
			 * 'symlinks' => array(),
			 */
			'preserveComments' => FALSE

			/**
			 * YUICompressor:
			 *
			 * 'charset' => '',
			 * 'line-break' => 5000
			 * 'type' => 'css'
			 * 'nomunge' => false
			 * 'preserve-semi' => false
			 * 'disable-optimizations' => false
			 */
		)
	),
	'js' => array(
		'minify' => TRUE,
		'dir' => 'assets/js',
		'cache' => TRUE,
		'driver' => 'closure',
		'options' => array(
			/**
			 * ClosureCompiler:
			 *
			 * 'fallbackMinifier' => array('Minify_JS_ClosureCompiler', '_fallback')
			 */

			/**
			 * YUICompressor:
			 *
			 * 'charset' => '',
			 * 'line-break' => 5000
			 * 'type' => 'js'
			 * 'nomunge' => false
			 * 'preserve-semi' => false
			 * 'disable-optimizations' => false
			 */
		)
	)
);
