<?php include 'views/components/header.php' ?>

<div class="single_post_container">
    <div>
        <img id="image<?= $post['id'] ?>" width="500px" src="<?= BASE_URL ?>/storage/images/<?= $post['image_name'] ?>" >
    </div>

    <div class=single_post_title_container>
        <h2><?= $post['title'] ?></h2>
        <button data-id="<?= $post['id'] ?>" class="download_button">
            <i class="fa-solid fa-download"></i>
            Download
        </button>
    </div>

    <div>
        By: <?= $post['username'] ?>
    </div>

</div>

<?php include 'views/components/footer.php' ?>