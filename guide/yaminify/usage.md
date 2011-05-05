# Usage

[todo]
Instead of `Url::site('style.css')` use `Url::stamp('style.css')` to add timestamp or `Url::stamp('style.min.css')` to add timestamp, minify and cache file.
Supported types (minify): css, js.

Example:

	<script src="<?php echo Url::stamp('jquery.min.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo Url::stamp('style.css') ?>" />

Results:

	<script src="/jquery.123456789.min.js"></script>
	<link rel="stylesheet" href="/style.123456789.css" />

If minification is disabled then `.min` will be stripped automaticly from filename:

	<script src="<?php echo Url::stamp('jquery.min.js') ?>"></script>

Result:

	<script src="/jquery.123456789.js"></script>

