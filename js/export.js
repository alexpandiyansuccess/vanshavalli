"use strict";
$(function () {
    let APP_URL = window.APP_URL;
    let host_url = $(location).attr('host');
    let htmltag = "<html lang='en'>\n";
    let headtag = "<head>\n<meta charset='utf-8'>\n<meta name='viewport' content='width=device-width, initial-scale=1'>\n<title>Laravel</title>\n<script src='" + APP_URL + "/js/app.js' defer=''></script>\n<link rel='dns-prefetch' href='//fonts.gstatic.com'>\n<link href='" + APP_URL + "/css/googleapi.font.css' rel='stylesheet'>\n<link href='" + APP_URL + "/css/app.css' rel='stylesheet'>\n<link href='" + APP_URL + "/css/export.css' rel='stylesheet'>\n<link href='" + APP_URL + "/css/cropper.css' rel='stylesheet'>\n<script src='" + APP_URL + "/js/jquery-3.4.1.min.js'> </script>\n<link href='" + APP_URL + "/css/index.css' rel='stylesheet'>\n<link type='text/css' rel='stylesheet' href='" + APP_URL + "/css/bcPicker.css'></head>\n";
    let bodytag = "<body cz-shortcut-listen='true'><div id='app'> <main> <div class='container'> <div class='row justify-content-center' id='panel1' style='display: none;'></div> <div class='row' id='panel2' style='display: block;'> <div class='col-md-12'> <div class='card manage-head-card'> <div class='card-header manage-header-card'>Tree Chart</div> <div class='tree_card_body card-body'> <link href='" + APP_URL + "/css/style.css' rel='stylesheet'> <link href='http//" + APP_URL + "/css/custom.css' rel='stylesheet'> <div class='tree mt-5' style=''> " + $("#treecode").val() + " </div> </div> </div> </div> </div> </div> </main> </div> </body>\n";
    let htmltagend = "</html>";
    var css;
    $("#treecode").val(htmltag + headtag + bodytag + htmltagend);

    var html;

    html = $("#htmlcode").val();
    var res;
    $("#htmlcode").val(htmltag + headtag + bodytag + htmltagend);

    $("#download").on("click", function (event) {
        event.preventDefault();
        download("chart.html", $("#htmlcode").val());
    });
});
function download(filename, text) {
    var element;
    element = document.createElement("a");
    element.setAttribute("href", "data:text/html;charset=utf-8," + encodeURIComponent(text));
    element.setAttribute("download", filename);

    element.style.display = "none";
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}
