$(document).ready(function() {
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            // console.error(error);
        });


    $('#selectAllBoxes').click(function(event) {
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });


$("body").prepend(div_box);

$('#load-screen').delay(200).fadeOut(600, function(){
   $(this).remove();
});




});

function loadUsersOnline () {
    $.get("functions.php?onlineusers=result", function(data) {
        $(".usersonline").text(data);
    });
}

setInterval(function(){
loadUsersOnline();
},500);

loadUsersOnline();