//Tinymce text editor script.
tinymce.init({ selector:'textarea' });

var txt ="<p>" + screen.width + "*" + screen.height + "</p>";
document.getElementById("resolution").innerHTML = txt;
