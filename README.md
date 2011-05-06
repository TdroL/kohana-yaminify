Yaminify
======================

This is a Yet Anther (Kohana) Minifier.

# Installation

Unpack module into `modules/yaminify` and enable it in `application/bootstrap.php`:

	Kohana::modules(array(
		...
		'yaminify' => MODPATH.'yaminify',
		...
	));

# Usage

1. Use `.htaccess` delivered with this module to enable proper file serving (using stamp, see lines 212-215 in `.htaccess`), gzip and headers.
2. Use Url::stamp() to create links to your styles and scripts.

Example:

	<script src="<?php echo Url::stamp('script.min.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo Url::stamp('style.css') ?>" />

Results:

	<script src="/script.123456789.min.js"></script> <!-- minified and cached -->
	<link rel="stylesheet" href="/style.123456789.css" /> <!-- nethier minified nor cached -->

If minification is disabled (in config file) then `.min` will be stripped automaticly from filename:

	// yaminify.js.minify == FALSE
	<script src="<?php echo Url::stamp('script.min.js') ?>"></script>

Result:

	<script src="/script.123456789.js"></script>