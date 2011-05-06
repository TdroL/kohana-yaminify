# Installation

Unpack module into `modules/yaminify` and enable it in `application/bootstrap.php`:

	Kohana::modules(array(
		...
		'yaminify' => MODPATH.'yaminify',
		...
	));

# Configuration

Setting  | Description                                    | Default
---------|------------------------------------------------|--------
verbose | Adds warning message to source if target directory is not writable | `TRUE`
gc      | Chance that garbage collection will be run. Value range: 0.0 - 1.0 | `1.0`
css.minify | Enables styles minifying | `TRUE`
css.dir | Styles directory | `'assets/css'`
css.config | CssMin settings, see [CssMin wiki](http://code.google.com/p/cssmin/wiki/MinifierConfiguration) | `array(...)`
js.minify | Enables scripts minifying | `TRUE`
js.dir | Scripts directory | `'assets/scripts'`