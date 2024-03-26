<?php

require_once 'database/database.php';

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllArticles()
    {
        $this->db->query('SELECT * FROM articles ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function createArticle($title, $content)
    {
        $this->db->query('INSERT INTO articles (title, content) VALUES (:title, :content)');
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        return $this->db->execute();
    }
}
