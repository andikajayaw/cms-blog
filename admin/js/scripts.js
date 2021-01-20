$(document).ready(function() {

    // CKEDITOR
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });

    $('#selectAll').click(function(event) {
        if(this.checked){
            $('.select').each(function() {
                this.checked = true;
            });
        } else {
            $('.select').each(function() {
                this.checked = false;
            });
        }
    })
});