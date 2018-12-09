<?php
/**
 * Created by PhpStorm.
 * User: moh.asem
 * Date: 12/9/2018
 * Time: 8:02 PM
 */

namespace PHPPOSTSMVC\LIB;

class Autoload
{

    public static function autoload($className)
    {

        $className = str_replace('PHPPOSTSMVC\\', '', $className);
        $className = strtolower($className);

        if( file_exists(APPROOT . $className . '.php' ))
        {
            require_once  APPROOT . $className . '.php';
        }
    }
}

spl_autoload_register(__NAMESPACE__ . '\Autoload::autoload');