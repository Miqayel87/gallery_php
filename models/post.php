<?php

require_once 'database/database.php';

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLastInsert()
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind('id', $this->db->lastInsertId());

        return $this->db->single();
    }

    public function getPostsCount(){
        $this->db->query('SELECT COUNT(*) as count FROM posts');

        return $this->db->single()['count'];
    }

    public function getAllPosts($currentPage = 1, $itemsPerPage = 10)
    {
        $offset = ($currentPage - 1) * $itemsPerPage;

        $query = 'SELECT posts.id as post_id, posts.title as post_title,
                     users.id as user_id, users.username,
                     images.id as image_id, images.name as image_name
              FROM posts
              INNER JOIN users ON users.id = posts.user_id
              INNER JOIN images ON images.id = posts.image_id
              ORDER BY posts.created_at DESC
              LIMIT :limit OFFSET :offset';

        $this->db->query($query);
        $this->db->bind(':limit', $itemsPerPage);
        $this->db->bind(':offset', $offset);
        $results = $this->db->resultSet();

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


    public function add($data)
    {
        $created_at = date('Y-m-d H:i:s');

        $this->db->query('INSERT INTO posts (title, user_id, image_id, created_at) VALUES (:title, :user_id, :image_id, :created_at)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':image_id', $data['image_id']);
        $this->db->bind(':created_at', $created_at);

        $post = $this->db->execute();

        return $post;
    }

    public function remove($data)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id and user_id = :user_id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->single();

        $post = $this->getLastInsert();

        return $post;
    }

    public function getLoggedUserPosts()
    {
        $query = 'SELECT posts.id as post_id, posts.title as post_title,
                     users.id as user_id, users.username,
                     images.id as image_id, images.name as image_name
              FROM posts
              INNER JOIN users ON users.id = posts.user_id
              INNER JOIN images ON images.id = posts.image_id
              WHERE users.id = :id
              ORDER BY posts.created_at DESC';

        $this->db->query($query);
        $this->db->bind(':id', $_SESSION['user']['id']);
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

    public function getById($id)
    {
        $this->db->query(
            'SELECT posts.*, 
                 images.id as image_id, images.name as image_name,
                 users.id as user_id, users.username
                 FROM posts 
                 INNER JOIN images ON images.id = posts.image_id
                 INNER JOIN users ON users.id = posts.user_id
                 WHERE posts.id = :id'
        );
        $this->db->bind(':id', $id);
        $post = $this->db->single();

        return $post;
    }
}
