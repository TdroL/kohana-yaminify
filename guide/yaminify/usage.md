# Usage

1. Use `.htaccess` delivered with this module to enable proper file serving (using stamp, see lines 212-215 in `.htaccess`), gzip and headers.
2. Use Url::stamp() to create links to your styles and scripts.

Example:

	<script src="<?php echo Url::stamp('script.min.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo Url::stamp('style.css') ?>" />

Results:

	<script src="/script.123456789.min.js"></script> <!-- minified and cached -->
	<link rel="stylesheet" href="/style.123456789.css" /> <!-- nethier minified nor cached -->

If minification is disabled (in config file) then `.min` will be stripped automaticly from filename if that file does not exists:

	// yaminify.js.minify == FALSE, file script1.js does exists
	<script src="<?php echo Url::stamp('script1.min.js') ?>"></script>
	// yaminify.js.minify == FALSE, file script2.min.js does exists
	<script src="<?php echo Url::stamp('script2.min.js') ?>"></script>

Result:

	<script src="/script1.123456789.js"></script>
	<script src="/script2.123456789.min.js"></script>

Modified `.htaccess` additionally supports aliases:

- file.123456789.ext
- file.r001.ext
- file.v1.ext
- file.v1.1.ext

These are useful when there is need to version image files, ex. logo.v1.png