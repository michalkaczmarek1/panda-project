//script responsible for adding news

$(document).ready(function () {
    

    var form = $("#create-form"),
        route = "http://localhost/panda/",
        title = $('input[name="title"]');
        description = $('textarea[name="description"]');

        

    form.on('submit', function (e) {
        
        e.preventDefault();
        // serialize data to json
        var data = JSON.stringify($(this).serializeArray());

        // send AJAX on server 
        $.post(route+"api-news.php/create", data,
            function (data) {
                if(data.create_message){
                    //display statement for users
                    $('#alerts').replaceWith("<div class='alert alert-success' id='alerts'>"+data.create_message+". <a href='"+route+"views/news/news.html.php'>Przejdz do wiadomości.</a></div>");
                    title.val('');
                    description.val('');
                } else {
                    //display statement for users
                    $('#alerts').replaceWith("<div class='alert alert-danger' id='alerts'>"+data.error_empty+"</div>");
                }
            },
            
        );
        
    });



});