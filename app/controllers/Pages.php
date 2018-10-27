<?php


class Pages extends Controller
{
    private $postModel;

    public function __construct()
    {

        if(! isLoggedin())
        {
            redirect('users/login');
        }

//        echo 'pages loaded';
    }

    public function index()
    {
        if(isLoggedin())
        {
            redirect('posts');
        }

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