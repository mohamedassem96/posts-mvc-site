<?php

// page redirection

function redirect($location)
{
    header('location: ' . URLROOT . $location);
}