<?php

define('APPROOT', dirname( dirname(__FILE__) ) . DIRECTORY_SEPARATOR);

$path = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));

array_pop($path);
array_pop($path);

array_push($path, 'public');
array_push($path, 'css');

$filePath = implode(DIRECTORY_SEPARATOR, $path);

define('CSSROOT', '/css/');


define('JSROOT', '/js/');


define('SITENAME', 'phptraversymvc');

define('DB_HOST', 'phptraversymvc.com');

define('DB_NAME', 'tmvc');

define('DB_USERNAME', 'root');

define('DB_PASSWORD', '');

// URL Root