<?php

// Load Libraries

//require_once 'libraries/controller.php';
//require_once 'libraries/core.php';
//require_once 'libraries/database.php';



// Load Config File
require_once 'config/config.php';

//Load Helper File
require_once 'helper/url_helper.php';

require_once 'helper/session_helper.php';



// Autoload core Libraries Classes
spl_autoload_register(

    function ($className)
    {
        require_once 'libraries/' . $className . '.php';

    });