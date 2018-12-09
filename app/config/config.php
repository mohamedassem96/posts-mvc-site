<?php

define('APPROOT', dirname( dirname(__FILE__) ) . DIRECTORY_SEPARATOR);

$path = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));

array_pop($path);
array_pop($path);

array_push($path, 'public');
array_push($path, 'css');

$filePath = implode(DIRECTORY_SEPARATOR, $path);

define('SITENAME', 'phppostsmvc');

define('URLROOT', 'http://phppostsmvc.com/');

define('DB_HOST', 'phppostsmvc.com');

define('DB_NAME', 'posts_mvc');

define('DB_USERNAME', 'root');

define('DB_PASSWORD', '');

// URL Root