<?php
/**
 * Created by PhpStorm.
 * User: tofsh
 * Date: 10/26/2018
 * Time: 11:38 PM
 */

class UsersModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email=:email ");
        $this->db->bind(':email', $email);
        $this->db->singleResultSet();

        if($this->db->rowCount() > 0)
        {
            return true;

        }else
        {
            return false;
        }

    }


    // Register User
    public function register($data)
    {
        $this->db->query("INSERT INTO users SET name = :name, email = :email, password = :password");

        // Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute())
        {
            return true;
        }else
        {
            return false;
        }

    }

    public function login($email, $password)
    {
        $this->db->query("SELECT * FROM users WHERE email=:email");

        $this->db->bind(':email', $email);

        $row = $this->db->singleResultSet();

        $hashed_password = $row->password;

        if(password_verify($password, $hashed_password))  // default function in php used to match entered password with password_hash() hashed password
        {
            return $row;
        }else
        {
            return false;
        }
    }
}