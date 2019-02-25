//script responsible for read news

$(document).ready(function () {
    
    var read = $('#read'),
        route = 'http://localhost/panda';
        
    // handling click read button
    read.on('click', function (e) {
        
        
        e.preventDefault();
        
        //send AJAX on rever to read data
        $.get(route+"/api-news.php/news",
            function (data) {
                
                //create table for get news
                table = '<table class="table table-responsive" id="table"><thead><tr><th scope="col">Id</th><th scope="col">Tytuł</th><th scope="col">Opis</th><th scope="col">Dodano</th><th scope="col">Modifikowano</th><th>Akcje</th></thead>';
                table += "<tbody>";
                
                //insert data to table
                $.each(data, function (index, value) { 
                    table += '<tr><td>'+value.news_id+'</td>';
                    table += '<td>'+value.name+'</td>';
                    table += '<td>'+value.description+'</td>';
                    table += '<td>'+value.created_at+'</td>';
                    table += '<td>'+value.updated_at+'</td>';
                    table += '<td><a href="'+route+"/views/news/layouts/edit-form.html.php/edit/?id="+value.news_id+'" class="btn btn-warning">Edytuj</a>';
                    // the form handle delete news
                    table += '<form style="display: inline-block;" method="post" id="delete-form" action="'+route+'/api-news.php/delete"><input type="hidden" value="'+value.news_id+'" name="news_id"><input type="submit" value="Usuń" class="btn btn-danger"></form>';
                });

                table += "</tbody>";
                table += "</table>";

                $(table).appendTo('#content');

                
            },
        );

        $(this).attr('disabled', true);
    });
       
});