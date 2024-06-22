<?php include 'views/components/header.php' ?>

<div class="add_photo_container">

    <div class="title_container">
        <h2> ADD PHOTO</h2>
    </div>

    <div class="image_container">

        <form id="imageForm">
            <input type="file" name="image" id="image" class="image">
        </form>

        <div>
            <label class="image_preview" id="imagePreview" for="image">
                <i class="fa-solid fa-image"></i>
            </label>
        </div>
    </div>

    <div class="add_post_title_container">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>

    <div class="error_container">

    </div>

    <div>
        <button id="createButton">Save</button>
    </div>


</div>
<?php include 'views/components/footer.php' ?>
