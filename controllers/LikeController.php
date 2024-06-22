<?php

require_once 'models/like.php';
require_once 'helpers/SanitizationHelper.php';

class LikeController
{
    private $like;
    private $sanitizationHelper;

    public function __construct(){
        $this->like = new Like;
        $this->sanitizationHelper = new SanitizationHelper;
    }

    public function index(){
        $posts = $this->like->getLoggedUserLikes();
        $userLikes = $this->like->getLoggedUserLikes();

        require_once 'views/my-wishlist.php';
    }
    
    public function store()
    {
        $rawData = file_get_contents("php://input");

        $jsonData = json_decode($rawData, true);

        $sanitizeData = $this->sanitizationHelper->sanitize($jsonData);

        $this->like->add([
            "post_id" => $sanitizeData['post_id'],
            "user_id" => $_SESSION['user']['id']
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Like created successfully.'
        ]);
    }

    public function delete(){
        $rawData = file_get_contents("php://input");

        $jsonData = json_decode($rawData, true);

        $sanitizeData = $this->sanitizationHelper->sanitize($jsonData);

        $this->like->remove([
            'post_id' => $sanitizeData['post_id'],
            'user_id' => $_SESSION['user']['id']
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Like deleted successfully.'
        ]);
    }
}