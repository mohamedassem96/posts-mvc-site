<?php

Class Users extends Controller
{
    private $usersModel;

    public function __construct()
    {
        $this->usersModel = $this->model('usersModel');
    }

    public function index()
    {
        if(! isLoggedin())
        {
            redirect('users/login');
        }
        else
        {
            die('page not found!');
        }
    }

    public function register()
    {
        // Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            // Init Data
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            // Validation

            if(empty($data['name']))
            {
                $data['name_err'] = 'Please Enter Name';
            }

            if(empty($data['email']))
            {
                $data['email_err'] = 'please enter email';
            }
            else
            {
                if (($this->usersModel->findUserByEmail($data['email'])) )   // check if email is duplicate
                {
                    $data['email_err'] = 'email already taken';
                }
            }

            if(empty($data['password']))
            {
                $data['password_err'] = 'please enter password';
            }

            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'please enter password';
            }else
            {
                if($data['password'] !== $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Passwords don\'t match';
                }
            }

            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) &&
                empty($data['confirm_password_err']))
            {
                // validated

                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user

                if($this->usersModel->register($data))
                {
                    $_SESSION['success_msg'] = 'Registered Successfully :)';
                    redirect('users/login');
                }else
                {
                    die('some thing went wrong');
                }
            }
            else
            {
                //load the view with errors

                $this->view('users/registerView', $data);
            }


        }
        else
        {
            //load form

            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            $this->view('users/registerView', $data);
        }
    }



    public function login()
    {
        // Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //process form


            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            // Init Data
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'email_err' => '',
                'password_err' => '',
            ];

            // Validation

            if(empty($data['email']))
            {
                $data['email_err'] = 'please enter email';
            }

            if(empty($data['password']))
            {
                $data['password_err'] = 'please enter password';
            }

            if(empty($data['email_err']) && empty($data['password_err']))
            {
                //die('success');

                if ($this->usersModel->findUserByEmail($data['email']))
                {
                    // user found
                    $loggedInUser = $this->usersModel->login($data['email'], $data['password']);

                    if ($loggedInUser)
                    {
                        // create session
                        //die('success');

                        $this->createUserSession($loggedInUser);

                    }else
                    {
                        $data['password_err'] = 'Incorrect password';
                        $this->view('users/loginView', $data);
                    }
                }
                else
                {
                    // user not found
                    $data['email_err'] = 'No user found with this email';
                    $this->view('users/loginView', $data);
                }
            }
            else
            {
                //load the view with errors

                $this->view('users/loginView', $data);
            }
        }
        else
        {
            //load form

            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            $this->view('users/loginView', $data);
        }
    }



    private function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_password'] = $user->password;

        redirect('posts');
    }


    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        redirect('users/login');
    }
}