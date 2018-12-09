<?php

Class Posts extends Controller
{

    private $postsModel;

    public function __construct()
    {
        if(! isLoggedin())
        {
            $_SESSION['error_msg'] = 'sorry you must login';
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

        $this->view('posts/indexView', $data);
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
                    $_SESSION['success_msg'] = 'post added successfully :)';
                    redirect('posts');
                }
                else
                {
                    $_SESSION['error_msg'] = 'post addition failed :(';
                    redirect('posts/add');
                }

            }
            else
            {
                //load view with errors

                $this->view('posts/addView', $data);
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


        $this->view('posts/addView', $data);
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
                    $_SESSION['success_msg'] = 'post updated successfully :)';
                    redirect('posts');
                }
                else
                {
                    $_SESSION['success_msg'] = 'post updating failed :(';
                    redirect('posts/add');
                }

            }
            else
            {
                //load view with errors

                $this->view('posts/editView', $data);
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


        $this->view('posts/editView', $data);
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
            $_SESSION['success_msg'] = 'post deleted successfully';
            redirect('posts');
        }
        else
        {
            $_SESSION['error_msg'] = 'post deletion failed :(';
            redirect('posts/delete');
        }
    }

    public function show($id)
    {
        $post = $this->postsModel->getPostById($id);

        $data = [
            'post' => $post
        ];

//        var_dump($data);

        $this->view('posts/showView', $data);
    }
}