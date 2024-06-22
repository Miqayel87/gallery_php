<?php

require_once 'models/post.php';
require_once 'models/like.php';

class HomeController
{
    private $post;
    private $like;

    public function __construct()
    {
        $this->post = new Post;
        $this->like = new Like;
    }

    public function index()
    {
        $limit = PAGINATION_LIMIT;
        $totalPages = ceil($this->post->getPostsCount()/$limit);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $posts = $this->post->getAllPosts($page, $limit);

        if (isset($_SESSION['user'])) {
            $userLikes = $this->like->getLoggedUserLikes();
        }
        require_once "views/index.php";
    }
}