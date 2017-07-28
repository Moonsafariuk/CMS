//Tinymce text editor script.
tinymce.init({ selector:'textarea' });
//end tinyMCE

$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBox').each(function(){
                this.checked = true;
            });
        }
        else {
            $('.checkBox').each(function(){
                this.checked = false;
            });
        }
    });
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove();
    });
}); //document.ready() end

function loadUsersOnline(){
  $.get("functions.php?usersonline=result",function(data){
    $(".usersonline").text(data);
  });
}
//call load users

setInterval(function(){
  loadUsersOnline();
},500);
