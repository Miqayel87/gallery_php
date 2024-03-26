<?php

require_once 'models/article.php';

class AdminController
{
    public function index()
    {
        $articles = (new Article())->getAllArticles();

        require_once 'views/admin.php';
    }
}
