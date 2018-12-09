<?php


/*
 * Creates URL & loads core Controller
 * URL Format - /Controller/Action/Params
 *
 */

namespace PHPPOSTSMVC\LIB;
Class Core
{
    // Default Controller
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];


    public function __construct()
    {
        $url = $this->get_url();

        //print_r($url);

        if (file_exists(APPROOT . 'controllers' . DIRECTORY_SEPARATOR . ucfirst($url[0]) . '.php') )
        {
            // if exists .. set as controller
            $this->currentController = $url[0];

            unset($url[0]);
        }


        // require the Controller
        $controllerName = 'PHPPOSTSMVC\\Controllers\\' . $this->currentController;


        if ( isset($url[1]) )
        {
            if (method_exists($controllerName, $url[1]))
            {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        if( isset($url[2]) && ! empty($url[2]))
        {
            $url = explode('/', $url[2]);

            $this->params = array_values($url);
//            unset($url[0]);
        }


        // Instantiate The Controller

        $controllerName = new $controllerName;


//        echo '<br>' . $this->currentMethod . '<br>';

        call_user_func_array([ $controllerName, $this->currentMethod ], $this->params);

    }


    public function get_url()
    {
        if (isset($_SERVER['REQUEST_URI']))
        {
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);

            $url = explode('/', $url, 3);

            return $url;
        }


    }

}