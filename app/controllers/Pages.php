<?php


class Pages extends Controller
{
    private $postModel;

    public function __construct()
    {

//        echo 'pages loaded';
    }

    public function index()
    {

        $data =
            [
            'title' => 'Hello every buddy',
            ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => 'Hello every buddy'];

        $this->view('pages/about', $data);
    }
}