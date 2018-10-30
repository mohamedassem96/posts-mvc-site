<?php

Class Posts extends Controller
{

    private $postsModel;

    public function __construct()
    {
        if(! isLoggedin())
        {
            redirect('users/login');
        }

        $this->postsModel = $this->model('postsModel');
    }


    public function index()
    {
        $data= [];
        // Get Posts
        $posts = $this->postsModel->getPosts();  // array of objects

        $data['posts'] = $posts;

        $this->view('posts/index', $data);
    }


    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data= [
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];



            // Validation
            if(empty($data['title']))
            {
                $data['title_err'] = 'title cannot be empty';
            }

            if(empty($data['body']))
            {
                $data['body_err'] = 'body cannot be empty';
            }

            if(empty($data['title_err']) && empty($data['body_err']))
            {
                //success
                //die('success');

                if ($this->postsModel->addPosts($data))
                {
                    flash('post_status', 'post added successfully :)');
                    redirect('posts');
                }
                else
                {
                    flash('post_status', 'post addition failed :(' , 'alert alert-danger');
                    redirect('posts/add');
                }

            }
            else
            {
                //load view with errors

                $this->view('posts/add', $data);
            }
        }
        else
        {
            $data= [
                'title' => '',
                'body' => '',
                'user_id' => '',
                'title_err' => '',
                'body_err' => ''
            ];
        }


        $this->view('posts/add', $data);
    }


    public function edit($id)
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data= [
                'id'    => $id, // from url
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];




            // Validation
            if(empty($data['title']))
            {
                $data['title_err'] = 'title cannot be empty';
            }

            if(empty($data['body']))
            {
                $data['body_err'] = 'body cannot be empty';
            }

            if(empty($data['title_err']) && empty($data['body_err']))
            {
                //success
                //die('success');

                if ($this->postsModel->editPosts($data))
                {
                    flash('post_status', 'post updated successfully :)');
                    redirect('posts');
                }
                else
                {
                    flash('post_status', 'post updating failed :(' , 'alert alert-danger');
                    redirect('posts/add');
                }

            }
            else
            {
                //load view with errors

                $this->view('posts/edit', $data);
            }
        }
        else
        {
            // Get existing post from Model
            $post = $this->postsModel->getPostById($id);

            // check if Owner or not
            if($post->user_id != $_SESSION['user_id'])
            {
                redirect('posts');
            }

            $data= [
                'id'    => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => ''
            ];
        }


        $this->view('posts/edit', $data);
    }



    public function delete($id)
    {
        $post = $this->postsModel->getPostById($id);

        // check if Owner or not
        if ($post->user_id != $_SESSION['user_id'])
        {
            redirect('posts');
        }

        $data = [
            'id' => $id
        ];

        if($this->postsModel->deletePosts($data))
        {
            flash('post_status', 'post deleted successfully');
            redirect('posts');
        }
        else
        {
            die('Deletion failed some thing went wrong :(');
        }
    }

    public function show($id)
    {
        $post = $this->postsModel->getPostById($id);

        $data = [
            'post' => $post
        ];

//        var_dump($data);

        $this->view('posts/show', $data);
    }
}