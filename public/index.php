<?php

namespace PHPPOSTSMVC;

// Load Config File
use PHPPOSTSMVC\LIB\Core;

require_once '../app/config/config.php';
require_once APPROOT . 'helper/url_helper.php';

require_once APPROOT . 'helper/session_helper.php';

require_once APPROOT . 'lib/autoload.php';

//Load Helper File


// Init core library

$init = new Core();