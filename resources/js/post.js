$('#createButton').click(() => {
    const formData = new FormData(document.getElementById("imageForm"));

    $.ajax({
        url: '/gallery_php/image/store',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            data = JSON.parse(response);

            $.ajax({
                url: '/gallery_php/post/store',
                type: 'POST',
                data: JSON.stringify({
                    title: $("#title").val(),
                    image_id: data.id
                }),
                contentType: "application/json",
                processData: false,
                success: function (response) {
                    console.log(response);
                    data = JSON.parse(response);

                    window.location.href = 'get/' + data.id;
                },
                error: function (xhr, status, error) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response.message);

                    $('.error_container').text(response.message);
                }
            });

        },
        error: function (xhr, status, error) {
            const response = JSON.parse(xhr.responseText);
            console.log(response.message);

            $('.error_container').text(response.message);
        }
    })
});


$('.delete_button').on('click', function (e) {
    const id = $(this).data('id');

    $.ajax({
        url: '/gallery_php/post/delete',
        method: 'DELETE',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
            id: id
        }),
        success: function (response) {
            console.log('post deleted successfuly!');
            console.log(response);
            $('#' + id).hide();
        },
        error: function (xhr, status, error) {
            console.log('post not deleted: error` ' + error)
        }
    });
})