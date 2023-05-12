setTimeout(function() {
    document.querySelector('.alert-danger').style.display = 'none';
}, 5000); // 5000

const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
ClassicEditor
    .create( document.querySelector( '#js-ckeditor5-classic' ),{
        ckfinder: {
            uploadUrl: 'http://bhakundo.com.np/api/uploadNewsImage',

        }
    })
    .catch( error => {
        console.error( error );
    } );

ClassicEditor.on('fileUploadResponse', function (evt) {
    // Get the uploaded file data from the event
    var file = evt.data.file;

    // Get the URL of the uploaded image
    var url = file.url;

    // Create an image element with the URL
    var img = document.createElement('img');
    img.src = url;

    // Add the image element to your page
    document.body.appendChild(img);
});

