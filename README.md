PHP, JS and CSS Minifier
====================

## Description
With this plugin, you can minify you js's and css's via PHP providing input and output path's.
This plugin uses an online service provided by Andy Chilton, http://chilts.org/

## Download
* [Master branch](https://github.com/promatik/php-js-css-minifier/archive/master.zip)

## Setup
* How to setup the plugin:

```php
include_once("minifier.php");

$js = array(
	"js/application.js" 	=> "js/application.min.js",
	"js/main.js" 			=> "js/main.min.js"
);
$css = array(
	"css/application.css"	=> "css/application.min.css",
	"css/main.css"			=> "css/main.min.css"
);

minifyJS($js);
minifyCSS($css);
```

## Features
* **Instantly compress all your JS's and CSS's**  
  This allows you to add js and css files to a list, that you can minify at any time.

## Requirements
* PHP Webserver

## License
Released under the [MIT license](http://www.opensource.org/licenses/MIT).
