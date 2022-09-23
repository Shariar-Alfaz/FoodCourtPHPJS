const infile = document.getElementById('file');
const previewContainer = document.getElementById('preview');
const previewImage = previewContainer.querySelector('.image');
const defaultText = previewContainer.querySelector('.image-text');
infile.addEventListener('change', function() {
    const file = this.files[0];
    var t = file.type.split('/').pop().toLowerCase()
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
        $("#m2message").text("Please select an image.");
        $("#modalnotifi").css("display", "block");
        previewImage.value = '';
        return;
    }
    if (file) {
        const reader = new FileReader();
        defaultText.style.display = 'none';
        previewImage.style.display = 'block';

        reader.addEventListener('load', function() {
            previewImage.setAttribute('src', this.result)
        });
        reader.readAsDataURL(file);
    } else {
        defaultText.style.display = 'block';
        previewImage.style.display = 'none';
    }
});