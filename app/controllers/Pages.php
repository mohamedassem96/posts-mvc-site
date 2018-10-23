<?php
/**
 * Created by PhpStorm.
 * User: tofsh
 * Date: 10/22/2018
 * Time: 8:19 PM
 */

class Pages
{
    public function __construct()
    {
        echo 'pages loaded';
    }

    public function index()
    {

    }

    public function defaultFun($id, $ids)
    {
        echo $id . ' ' . $ids;
    }
}