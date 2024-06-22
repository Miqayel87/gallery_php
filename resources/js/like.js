$(document).ready(function () {
    $('body').on('click', '.likeButton', function (e) {
        const id = $(this).data('id');

        $.ajax({
            url: '/gallery_php/like/store',
            method: 'POST',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
                post_id: id
            }),
            success: function (response) {
                console.log(response);
                $('#likeButton' + id).empty().removeClass('likeButton').addClass('removeLikeButton').append('<i class="fa-solid fa-heart" style="color: #ff0000;"></i>\n');
                $($('.wishlist_count')).text(+$('.wishlist_count').html() + 1);

            },
            error: function (xhr, status, error) {
                console.log(error)
            }
        });
    });

    $('body').on('click', '.removeLikeButton', function (e) {
        const id = $(this).data('id');
        $.ajax({
            url: '/gallery_php/like/delete',
            method: 'DELETE',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
                post_id: id
            }),
            success: function (response) {
                console.log(response);
                $('#likeButton' + id).empty().removeClass('removeLikeButton').addClass('likeButton').append('<i class="fa-regular fa-heart"></i>\n');
                $('#likedPost' + id).hide();
                $($('.wishlist_count')).text(+$('.wishlist_count').html() - 1);
            },
            error: function (xhr, status, error) {
                console.log(error)
            }
        });
    });
});