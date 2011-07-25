Yaminify
======================

This is a Yet Another (Kohana) Minifier.

# Installation

Unpack module into `modules/yaminify` and enable it in `application/bootstrap.php`:

	Kohana::modules(array(
		...
		'yaminify' => MODPATH.'yaminify',
		...
	));

# Usage

1. Use `.htaccess` delivered with this module to enable proper file serving (using stamp, see lines 219-222 in `.htaccess`), gzip and headers.
2. Use Url::stamp() to create links to your styles and scripts.

Example:

	<!-- minify and cache -->
	<script src="<?php echo Url::stamp('script.min.js') ?>"></script>
	<!-- nethier minify nor cache -->
	<link rel="stylesheet" href="<?php echo Url::stamp('style.css') ?>" />

Results:

	<script src="/script.123456789.min.js"></script>
	<link rel="stylesheet" href="/style.123456789.css" />

If minification is disabled (in config file) then `.min` will be stripped automaticly from filename if that file does not exists:

	<!-- yaminify.js.minify == FALSE, file script1.js does exists -->
	<script src="<?php echo Url::stamp('script1.min.js') ?>"></script>
	<!-- yaminify.js.minify == FALSE, file script2.min.js does exists -->
	<script src="<?php echo Url::stamp('script2.min.js') ?>"></script>

Result:

	<script src="/script1.123456789.js"></script>
	<script src="/script2.123456789.min.js"></script>

Modified `.htaccess` additionally supports aliases:

- `file.123456789.ext` (pattern: `\d{8,}`)
- `file.r001.ext` (pattern: `r\d+`)
- `file.v1.ext` (pattern: `v\d+`)
- `file.v1.1.ext` (pattern: `v\d+.\d+`)

Supported aliase's file extensions (ext): js, css, png, jpg, gif, svg;

These are useful when there is need to version image files, ex. logo.v1.png

# Credits

- [HTML5 Boilerplate](http://html5boilerplate.com/) for awesome .htaccess and filename-based caching,
- [CssMin](http://code.google.com/p/cssmin/) - a css parser and minfier,
- [JSMin](https://github.com/rgrove/jsmin-php/) - PHP port of Douglas Crockford's JSMin.
