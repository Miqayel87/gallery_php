<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/resources/css/style.css">
</head>

<body>
<div class="root">
    <?php
    require_once 'models/like.php';

    $userLikes = (new Like)->getLoggedUserLikes();
    ?>
    <header>
        <div>
            <h1>
                <a href="<?= BASE_URL ?>">
                    Gallery
                </a>
            </h1>
        </div>

        <div>
            <ul>
                <li>
                    <a href="<?= BASE_URL ?>myPosts">My Photos</a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>like">
                        <div>
                            My Wishlist
                            <div class="wishlist_count"><?=count($userLikes)?></div>
                        </div>
                    </a>

                </li>
                <li>
                    <?php if ($_SESSION['user']) { ?>
                        <form action="<?= BASE_URL ?>login/logout" method="POST">
                            <button class="header_button" type="submit">logout</button>
                        </form>
                    <?php } else { ?>
                        <a href="<?= BASE_URL ?>login">
                            <button class="header_button">login</button>
                        </a>
                    <?php } ?>
                </li>
            </ul>
            <div id="burgerMenu" class="burgerMenuToggleButton burger_menu" >
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>

    <div class="drop_menu_wrapper closed">
        <div>
            <button class="burgerMenuToggleButton">
                <i class="fa-solid fa-arrow-up"></i>
            </button>
        </div>
        <div class="drop_menu_container">
            <ul>
                <li>
                    <a href="<?= BASE_URL ?>myPosts">My Photos</a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>like">
                        <div>
                            My Wishlist
                            <div class="wishlist_count"><?=count($userLikes)?></div>
                        </div>
                    </a>

                </li>
                <li>
                    <?php if ($_SESSION['user']) { ?>
                        <form action="<?= BASE_URL ?>login/logout" method="POST">
                            <button class="header_button" type="submit">logout</button>
                        </form>
                    <?php } else { ?>
                        <a href="<?= BASE_URL ?>login">
                            <button class="header_button">login</button>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
