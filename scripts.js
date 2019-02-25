// main script JS in application
$(document).ready(function () {
    
    
    var route = "http://localhost/panda/",
        clean = $("#clean_data");

    // the handling button which clean data with chart
    clean.on('click', function () {
       window.location.href = route + "/import_csv/csv.html.php";
    });    

    

});