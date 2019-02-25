<?php
// include header template
require_once '../header.html.php';
?>

<h3>Formularz logowania</h3>
<div id="alerts"></div>
<form id="login-form" action="">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" required class="form-control" id="email" placeholder="name@example.com" name="email">
    </div>
    <div class="form-group">
        <label for="password">Hasło</label>
        <input type="password" class="form-control" required id="password" name="password">
    </div>
    <button type="submit" class="btn btn-success" id="log">Zaloguj się</button>
</form>

<script>
//script responsible for login users
    $(document).ready(function () {

        var form = $('#login-form'),
            route = 'http://localhost/panda/',
            infos = $('#infos'),
            login = $('#login'),
            content = $("#content");

        $(form).on("submit", function (e) {

            e.preventDefault();

            // serialize data to json
            var data = JSON.stringify($(this).serializeArray());
            
            //send AJAX on server to login users
            $.post("http://localhost/panda/api.php/login", data,
                function (data, textStatus, jqXHR) {
                    if(data.error_empty || data.error_log){
                        
                        $('#alerts').replaceWith("<div class='alert alert-danger' id='alerts'>"+(!data.error_log ? data.error_empty : data.error_log)+"</div>");

                    } else if (data.success_login){ 
                        $('ul.navbar-nav').append(); 

                        content.replaceWith("<div class='alert alert-success'>"+data.success_login+" <a href='<?php echo APP_VIEW; ?>news/news.html.php' class='btn btn-info'>Przejdż do zakładki news</a></div>");
                        login.attr('href', '<?php echo APP_PATH; ?>api.php/logout');
                        login.text('Wyloguj się');
                        
                    }
                    
                }

            );
       
        });
        
    });

</script>

<?php
// include footer template
require_once('../footer.html.php');
?>