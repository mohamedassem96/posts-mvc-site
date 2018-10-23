<?php


/*
 * Creates URL & loads Core Controller
 * URL Format - /Controller/Action/Params
 *
 */

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

        if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php') )
        {
            // if exists .. set as controller
            $this->currentController = $url[0];

            unset($url[0]);
        }


        // require the Controller
        require_once '../app/controllers/' . $this->currentController . '.php';


        if ( isset($url[1]) )
        {
            if (method_exists($this->currentController, $url[1]))
            {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        if( isset($url[2]) && ! empty($url[2]))
        {
            $url = explode('/', $url[2]);

            $this->params = array_values($url);
        }


        // Instantiate The Controller

        $this->currentController = new $this->currentController;


        echo '<br>' . $this->currentMethod . '<br>';


        call_user_func_array([ $this->currentController, $this->currentMethod ], $this->params);

    }


    public function get_url()
    {
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);

            $url = explode('/', $url, 3);

            return $url;
        }


    }

}