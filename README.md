# Yaminify
A small module which automatically minimize your html, css and js.
This module is using an awesome [minify](https://github.com/mrclay/minify).

Requires Kohana 3.1+

## Installation

	git submodule add git://github.com/TdroL/kohana-yaminify.git modules/yaminify
	git submodule update --init --recursive

## How to use it (css, js)

1. In config file (`config/yaminify.php`): set paths to directories where your css and js file are.
2. Create cache directory -- must be globally visible. Don't forget about mode (`chmod 0777`).
3. Use `Y::stamp()` (instead of `Url::site()`) to create links for all files you want to minimize.
4. *Do not* use `Y::stamp()` for already minified (e.g. jQuery) or external files (e.g. from CDN).
5. Don't worry about old cached files - they're removed when new minimized version of file is created.

### Examples:

	Y::stamp('assets/js/plugins.js') -> "/assets/cache/plugins.xxxxxxxxxx.js"
	Y::stamp('assets/css/style.css') -> "/assets/cache/style.xxxxxxxxxx.css"
	Y::stamp('assets/css/admin/style.css') -> "/assets/cache/admin/style.xxxxxxxxxx.css"

### Special cases:

	// file doesn't exists
	Y::stamp('assets/js/lib.js') -> "/assets/js/lib.js"
	// file with ".min" in name (not necessarily minified)
	Y::stamp('assets/js/jquery.min.js') -> "/assets/js/jquery.min.js"

## How to use it (html)

Use `Y::minify()`:

	$this->response->body(Y::minify('html', $this->view));

Note: html *isn't* cached.

## Enable browsers caching - using .htaccess from [h5bp](http://h5bp.com)
If you want to enable caching using `.htaccess` from h5bp and you want to use "filename-based cache busting", you must remove "js|css" from rewrite rule:
Find this line:

	RewriteRule ^(.+)\.(\d+)\.(js|css|png|jpg|gif)$ $1.$3 [L]

and change to:

	RewriteRule ^(.+)\.(\d+)\.(png|jpg|gif)$ $1.$3 [L]

The `.htaccess` delivered with this module is a concatenation of h5bp's and Kohana's `.htaccess`, including modification from above.
