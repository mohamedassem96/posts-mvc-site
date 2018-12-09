<?php


/*
 * Base Controller
 * Loads Models and Views
 *
 */
namespace PHPPOSTSMVC\Controllers;

class Controller
{
    // Load Model
    public function model($model)
    {
        $model = 'PHPPOSTSMVC\\Models\\' . $model;
        return new $model; // Instantiate Model Class
    }


    public function view ($view, $data=[])
    {
        if (file_exists(APPROOT . 'views/' . $view . '.php'))
        {
            require_once APPROOT . 'views/' . $view . '.php';
        }
        else
        {
            die('View doesn\'t exists');
        }
    }
}