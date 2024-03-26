<?php

require_once 'models/article.php';

class ArticleController
{
    public function index()
    {
        $articles = (new Article())->getAllArticles();

        require_once 'views/index.php';
    }

    public function create()
    {
        if (isset($_POST['title']) && isset($_POST['content']) && strlen($_POST['title']) >= 3 && strlen($_POST['content']) >= 8 && is_string($_POST['title']) && is_string($_POST['content'])) {
            $newArticle = new Article;
            $newArticle->createArticle($_POST['title'], $_POST['title']);
            header('Location:' . BASE_URL . 'admin/index');
        } else {
            header('Location:' . BASE_URL . 'admin/index?error=invalid_input');
        }
    }

}
