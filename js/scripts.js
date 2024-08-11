$(document).ready(function () {

    var APP_URL = 'http://localhost/app-2018-lap/core-books'

    $('.trash').click(function () {
        console.log("Hit");
        
        var modelEndPoint = $(this).data('model-end-point');
        var modelId = $(this).data('model-id');

        $(this).closest('tr').remove();

        $.ajax({
            url: APP_URL + '/' + modelEndPoint + '/delete.php',
            type: 'DELETE',
            data: { id: modelId },
            success: function (response) { },
            error: function (xhr, status, error) { }
        });

    });

    $('#cover').on('change', function(event) {
        const file = event.target.files[0];
        const preview = $('#coverPreview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.attr('src', e.target.result);
                preview.show();
            };
            
            reader.readAsDataURL(file);
        } else {
            preview.attr('src', '');
            preview.hide();
        }
    });
});