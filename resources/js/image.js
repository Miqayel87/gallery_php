const previewImage = (file, tempName) => {
    const reader = new FileReader();

    reader.onload = function (e) {
        $($('.image_preview')).css('background-image', `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url(${e.target.result})`);
    };

    reader.readAsDataURL(file);
}

$('#image').on('change', function (e) {
    e.preventDefault();
    const file = e.target.files[0];
    previewImage(file, file.name)
});

function getImageType(url) {
    var extension = url.split('.').pop().toLowerCase();

    switch (extension) {
        case 'jpg':
        case 'jpeg':
            return 'JPEG';
        case 'png':
            return 'PNG';
        case 'gif':
            return 'GIF';
        case 'bmp':
            return 'BMP';
        case 'webp':
            return 'WEBP';
        case 'avif':
            return 'AVIF';
        default:
            return 'Unknown';
    }
}


$('.download_button').on('click', function (e) {
    const id = $(this).data('id');
    console.log(id);
    const url = $('#image' + id).prop('src');
    const name = url.split('/')[url.split('/').length - 1];
    const type = getImageType(url);

    $.ajax({
        url: '/gallery_php/image/download',
        type: 'POST',
        data: {imageUrl: url},
        xhrFields: {
            responseType: 'blob'
        },
        success: function (data) {
            const blob = new Blob([data], {type: 'image/' + type});
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = name;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        error: function (xhr, status, error) {
            alert('Failed to download image: ' + error);
        }
    });
});

