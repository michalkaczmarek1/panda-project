<?php
// include header template
require_once('../header.html.php');
?>


<h3>Formularz rejestracji</h3>
<form action="" method="POST" id="register-form">
    <div class="form-group">
        <label for="first_name">Imię</label>
        <input type="text" required  name="first_name" class="form-control"><br>
    </div>
    <div class="form-group">
        <label for="last_name">Nazwisko</label>
        <input type="text" required name="last_name" class="form-control"><br>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" required name="email" class="form-control"><br>
    </div>
    <div class="form-group">
        <label for="password">Hasło</label>
        <input type="password" required  name="password" class="form-control"><br>
    </div>
    <div class="form-group">
        <label for="gender">
            <input type="radio" required name="gender" value="girls">Kobieta
            <input type="radio"  name="gender" value="boys">Mężczyzna
        </label><br>
    </div>
    <input type="submit" class="btn btn-success" value="Wyślij">
</form>

<script>
//script responsible for register users
$(document).ready(function () {
    
    var form = $('#register-form'),
        route = 'http://localhost/panda/',
        infos = $('#infos'),
        content = $("#content");
        
        

    $(form).on("submit", function (e) {
        
        e.preventDefault();

        //serialize data to json
        var data = JSON.stringify($(this).serializeArray());

        //send AJAX on server to save users to database
        $.post("http://localhost/panda/api.php/register", data,
            function (data, textStatus, jqXHR) {
                if(data.error_empty || data.error_length){
                         
                    infos.replaceWith("<div class='alert alert-danger' id='infos'>"+data.error_empty+"</div>");
                    
                } else {

                    content.replaceWith("<div class='alert alert-success'>"+data.success_register+"</div>");
                
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