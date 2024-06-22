<?php

require_once 'models/post.php';
require_once 'models/like.php';

class MyPostsController
{
    private $post;
    private $like;
    public function __construct(){
        $this->post = new Post;
        $this->like = new Like;
    }

    public function index(){
        $posts = $this->post->getLoggedUserPosts();
        $userLikes = $this->like->getLoggedUserLikes();

        require_once 'views/my-posts.php';
    }
}