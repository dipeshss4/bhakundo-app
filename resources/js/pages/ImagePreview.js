
$(document).ready(function() {
    $("#coach_image").change(function() {
        readURL(this);
    });
});

$(document).ready(function() {
    $("#logo").change(function() {
        readURLForLogo(this);
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            $('#preview').show();
        }

        reader.readAsDataURL(input.files[0]);
    }

}

function readURLForLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview-logo').attr('src', e.target.result);
            $('#preview-logo').show();
        }

        reader.readAsDataURL(input.files[0]);
    }

}

