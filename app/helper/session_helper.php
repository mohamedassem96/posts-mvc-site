<?php

session_start();

function flash()
{
    $output = '';

    if (isset($_SESSION['success_msg']))
    {
        $output = "<div class='alert alert-success'>";
        $output .= htmlentities($_SESSION['success_msg']);
        $output .= "</div>";
    }
    else if (isset($_SESSION['error_msg']))
    {
        $output = "<div class='alert alert-danger'>";
        $output .= htmlentities($_SESSION['error_msg']);
        $output .= "</div>";
    }

    return $output;
}


function isLoggedin()
{
    if(isset($_SESSION['user_id']))
    {
        return true;
    }
    else
    {
        flash('authenticate_fun', 'Sorry you must login', 'alert alert-danger');
        return false;
    }
}