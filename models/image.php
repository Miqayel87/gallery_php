<?php

require_once 'database/database.php';

class image
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add($data)
    {
        $created_at = date('Y-m-d H:i:s');

        $this->db->query('INSERT INTO images (name, created_at) VALUES (:name, :created_at)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':created_at', $created_at);
        $image = $this->db->single();

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function remove($id)
    {
        $this->db->query('DELETE FROM images WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->single();

        return 200;
    }
}
