<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	// adds message to response if target directory (css/js) is not writable
	'verbose' => TRUE,
	// Garbage collector -- removes old minified files
	// allowed values: [0.0, 1.0]; 1.0 - always, 0.0 - never
	'gc' => 1.0,
	// css settings
	'css' => array(

		'minify' => TRUE,
		// target directory
		'dir' => 'assets/css',
		// CssMin settings
		// http://code.google.com/p/cssmin/wiki/MinifierConfiguration
		'config' => array(
			'filters' => array(
				'ImportImports'                 => array(
					'BasePath' => DOCROOT.'assets/css'
				),
				'RemoveComments'                => TRUE, 
				'RemoveEmptyRulesets'           => TRUE,
				'RemoveEmptyAtBlocks'           => TRUE,
				'ConvertLevel3AtKeyframes'      => array(
						'RemoveSource' => FALSE
				),
				'ConvertLevel3Properties'       => TRUE,
				'Variables'                     => TRUE,
				'RemoveLastDelarationSemiColon' => TRUE
			),
			'plugins' => array(
				'Variables'                     => TRUE,
				'ConvertFontWeight'             => TRUE,
				'ConvertHslColors'              => TRUE,
				'ConvertRgbColors'              => TRUE,
				'ConvertNamedColors'            => TRUE,
				'CompressColorValues'           => TRUE,
				'CompressUnitValues'            => TRUE,
				'CompressExpressionValues'      => TRUE
			)
		)
	),
	'js' => array(
		'minify' => TRUE,
		'dir' => 'assets/scripts'
	),
);
