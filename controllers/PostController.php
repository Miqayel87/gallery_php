<?php

require_once 'models/post.php';
require_once 'models/image.php';
require_once 'helpers/FileUploadHelper.php';
require_once 'helpers/SanitizationHelper.php';
require_once 'validation/validator.php';
class PostController
{
    private $post;
    private $image;
    private $fileUploadHelper;
    private $sanitizationHelper;

    public function __construct()
    {
        $this->post = new Post;
        $this->image = new Image;
        $this->fileUploadHelper = new FileUploadHelper;
        $this->sanitizationHelper = new SanitizationHelper;
    }

    public function create()
    {
        require_once 'views/post/create.php';
    }

    public function get($id){
        $post = $this->post->getById($id);

        require_once 'views/post/single-post.php';
    }

    public function store()
    {
        $rawData = file_get_contents("php://input");
        $jsonData = json_decode($rawData, true);

        if (is_null($jsonData)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input.']);
            http_response_code(400);
            return;
        }

        $sanitizeData = $this->sanitizationHelper->sanitize($jsonData);

        if (!Validator::validateRequired($sanitizeData['title']) || !Validator::validateRequired($sanitizeData['image_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Title and Image are required.']);
            http_response_code(400);
            return;
        }

        $this->post->add([
            "title" => $sanitizeData['title'],
            "image_id" => (int)$sanitizeData['image_id'],
            "user_id" => $_SESSION['user']['id']
        ]);

        $post = $this->post->getLastInsert();

        echo json_encode([
            'id' => $post['id'],
            'status' => 'success',
            'message' => 'Post created successfully.'
        ]);
    }

    public function delete()
    {
        $rawData = file_get_contents("php://input");
        $jsonData = json_decode($rawData, true);

        if (is_null($jsonData)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input.']);
            http_response_code(400);
            return;
        }

        $sanitizeData = $this->sanitizationHelper->sanitize($jsonData);

        if (!Validator::validateRequired($sanitizeData['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'ID is required.']);
            http_response_code(400);
            return;
        }

        $post = $this->post->getById((int)$sanitizeData['id']);

        if (!$post) {
            echo json_encode(['status' => 'error', 'message' => 'Post not found.']);
            return;
        }

        if ($this->image->remove($post['image_id'])) {
            $this->fileUploadHelper->remove($post['image_name']);
        }

        $this->post->remove([
            'id' => (int)$sanitizeData['id'],
            'user_id' => $_SESSION['user']['id']
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Post deleted successfully.'
        ]);
    }
}
