<?php

require_once 'database/database.php';

class Like
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLastInsert()
    {
        $this->db->query('SELECT * FROM likes WHERE id = :id');
        $this->db->bind('id', $this->db->lastInsertId());

        return $this->db->single();
    }

    public function add($data)
    {
        $created_at = date('Y-m-d H:i:s');

        $this->db->query('INSERT INTO likes (user_id, post_id, created_at) VALUES (:user_id, :post_id, :created_at)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':created_at', $created_at);
        $like = $this->db->execute();

        return $like;
    }

    public function remove($data)
    {
        $this->db->query('DELETE FROM likes WHERE post_id = :post_id and user_id = :user_id');
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $like = $this->db->single();

        return $like;
    }

    public function getLoggedUserLikes()
    {
        $this->db->query(
            'SELECT posts.id as post_id, posts.title as post_title,
            users.id as user_id, users.username,
            images.id as image_id, images.name as image_name FROM likes
            INNER JOIN posts ON posts.id = likes.post_id 
            INNER JOIN images ON images.id = posts.image_id 
            INNER JOIN users ON users.id = posts.user_id
            WHERE likes.user_id = :user_id
            ORDER BY likes.created_at DESC'
        );
        $this->db->bind(':user_id', $_SESSION['user']['id']);
        $results = $this->db->resultSet();

        if (count($results)) {
            $formattedResults = array_map(function ($row) {
                return [
                    'id' => $row['post_id'],
                    'title' => $row['post_title'],
                    'user' => [
                        'id' => $row['user_id'],
                        'name' => $row['username'],
                    ],
                    'image' => [
                        'id' => $row['image_id'],
                        'name' => $row['image_name'],
                    ]
                ];
            }, $results);

            return $formattedResults;
        }

        return $results;

    }

}
