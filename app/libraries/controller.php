<?php


/*
 * Base Controller
 * Loads Models and Views
 *
 */

class Controller
{
    // Load Model
    public function model($model)
    {
        if (file_exists('../app/models/' . $model . '.php'))
        {
            require_once '../app/models/' . $model . '.php';
            return new $model; // Instantiate Model Class
        }
        else
        {
                die('Model doesn\'t exists');
        }
    }


    public function view ($view, $data=[])
    {
        if (file_exists('../app/views/' . $view . '.php'))
        {
            require_once '../app/views/' . $view . '.php';
        }
        else
        {
            die('View doesn\'t exists');
        }
    }
}