<?php

class PostsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query("SELECT posts.*, posts.created_at as 'posts_time', users.created_at as 'users_time', users.name as 'writer_name' FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
        $posts = $this->db->resultSet();
        //var_dump($posts);

        return $posts;
    }

    public function getPostById($id)
    {
        $this->db->query("SELECT posts.*, posts.created_at as 'posts_time', users.created_at as 'users_time', users.name as 'writer_name' 
                              FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = :id ORDER BY posts.created_at DESC");

        $this->db->bind(':id', $id);
        $post = $this->db->singleResultSet();
        //var_dump($posts);

        return $post;
    }

    public function addPosts($data)
    {
        $this->db->query("INSERT INTO posts SET title=:title, body=:body, user_id=:user_id");

        //Bind Values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);

        // Execute
        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function editPosts($data)
    {
        $this->db->query("UPDATE posts SET title=:title, body=:body WHERE id=:id");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }


    public function deletePosts($data)
    {
        // Query
        $this->db->query("DELETE FROM posts WHERE id=:id");

        // Bind values
        $this->db->bind(':id', $data['id']);

        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}