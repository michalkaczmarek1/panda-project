//script responsible for update news

$(document).ready(function () {
    
        var route = 'http://localhost/panda/',
            editForm = $('#edit-form'),
            title = $('input[name="title"]'),
            description = $('textarea[name="description"]');

        editForm.on('submit', function (e) {
        
        e.preventDefault();
        
        //serialize data to json
        var data = JSON.stringify($(this).serializeArray());

        //send AJAX to server to update news
        $.post(route+"api-news.php/update", data,
            function (data) {
                if(data.update_message){
                    //display statement for users
                    $('#alerts').replaceWith("<div class='alert alert-success' id='alerts'>"+data.update_message+". <a href='"+route+"views/news/news.html.php'>Przejdz do wiadomości.</a></div>");
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