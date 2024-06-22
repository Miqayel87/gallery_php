<?php include 'components/header.php' ?>


    <div class="title_container">
        <h2> My Wishlist</h2>
    </div>

    <div class="posts_container">
        <?php

        foreach ($posts as $post) {
            ?>
            <div class="post" id="<?= $post['id'] ?>">

                <div class="image_container">
                    <?php
                    if (isset($_SESSION['user'])) { ?>
                        <?php
                        if (array_search($post['id'], array_column($userLikes, 'id')) !== false) { ?>
                            <button id="likeButton<?= $post['id'] ?>" class="removeLikeButton"
                                    data-id="<?= $post['id'] ?>">
                                <i class="fa-solid fa-heart" style="color: #ff0000;"></i>
                            </button>
                        <?php } else { ?>
                            <button id="likeButton<?= $post['id'] ?>" class="likeButton"
                                    data-id="<?= $post['id'] ?>">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        <?php } ?>
                    <?php } ?>
                    <a href="post/get/<?= $post['id'] ?>">

                        <img class="image" id="<?= $post['image']['id'] ?>" width="100px"
                             src="storage/images/<?= $post['image']['name'] ?>"
                             alt="">
                    </a>
                </div>
                <div class="title">
                    <a href="post/get/<?= $post['id'] ?>">
                        <h2><?= $post['title'] ?></h2>
                    </a>
                </div>
                <div class="username">
                    By: <span><?= $post['user']['name'] ?></span>
                </div>
            </div>
            <?php
        }
        ?>

    </div>

<?php include 'components/footer.php' ?>