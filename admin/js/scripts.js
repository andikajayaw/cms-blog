$(document).ready(function() {

    // CKEDITOR
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
            // alert(error);
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
    });

    var divbox = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(divbox);
    $("#load-screen").delay(700).fadeOut(600, function() {
        $(this).remove();
    });
});

function loadUsersOnline() {
    $.get("functions.php?onlineusers=result", function(data) {
        $(".onlineusers").text(data);
    });
}

setInterval(function() {
    loadUsersOnline();
},500);
