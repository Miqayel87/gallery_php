<?php

require_once 'database/database.php';
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserByUsername($username)
    {
        $this->db->query('SELECT users.*,
                             posts.id as post_id, posts.title as post_title,
                             likes.id as like_id, likes.post_id as like_post_id,
                             images.id as image_id, images.name as image_name
                      FROM users 
                      LEFT JOIN posts ON posts.user_id = users.id
                      LEFT JOIN images ON posts.image_id = images.id
                      LEFT JOIN likes ON likes.user_id = users.id
                      WHERE users.username = :username');
        $this->db->bind(':username', $username);
        $result = $this->db->resultSet(); 

        if (empty($result)) {
            return null; 
        }

        $user = [
            'id' => $result[0]['id'],
            'username' => $result[0]['username'],
            'password' => $result[0]['password'],
            'posts' => []
        ];

        foreach ($result as $row) {
            if ($row['post_id']) {
                $user['posts'][] = [
                    'id' => $row['post_id'], 
                ];
            }

            if ($row['like_id']) {
                $user['likes'][] = $row['like_post_id'];
            }
        }

        return $user;
    }

    public function add($data)
    {
        $created_at = date('Y-m-d H:i:s');

        $this->db->query('INSERT INTO Users(username, date_of_birth, password, created_at) VALUES(:username, :date_of_birth, :password, :created_at)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':date_of_birth', $data['dateOfBirth']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':created_at', $created_at);
        $user = $this->db->single();

        return $user;
    }

    public function getLastInsert()
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind('id', $this->db->lastInsertId());

        return $this->db->single();
    }
}
