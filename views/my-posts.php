<?php include 'components/header.php' ?>


<div class="title_container">
    <h2> MY PHOTOS</h2>
</div>

<div class="add_post_button">
    <a href="post/create">
        <button>
            <i class="fa-solid fa-plus"></i> Add Post
        </button>
    </a>
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
                    <!--                            --><?php //} else { ?>
                    <!--                                <button id="likeButton--><?php //= $post['id'] ?><!--" class="likeButton"-->
                    <!--                                        data-id="--><?php //= $post['id'] ?><!--">-->
                    <!--                                    <i class="fa-regular fa-heart"></i>-->
                    <!--                                </button>-->
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
                <button data-id='<?= $post['id'] ?>' class="delete_button"><i class="fa-solid fa-trash"></i> Delete
                </button>

            </div>
            </a>

            <!--                <button class="downloadButton" data-id="-->
            <?php //= $post['image']['id'] ?><!--">download</button>-->


        </div>
        <?php
    }
    ?>

</div>

<?php include 'components/footer.php' ?>
