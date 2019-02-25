<?php
//include header template
require_once('../header.html.php');

//display the statements
if(isset($_SESSION['error_db'])){
    echo "<div class='alert alert-danger'>".$_SESSION['error_db']."</div>";
    unset($_SESSION['error_db']);
}


if(isset($_SESSION['delete_message'])){
    echo "<div class='alert alert-success'>".$_SESSION['delete_message']."</div>";
    unset($_SESSION['delete_message']);
}

?>

<button class="btn btn-info" id='read'>Pobierz swoje wiadomości</button>
<a href="<?php echo APP_PATH;?>views/news/layouts/create-form.html.php" class="btn btn-success" id='add'>Dodaj nową wiadomość</a>
<a href="<?php echo APP_PATH;?>views/news/news.html.php" class="btn btn-primary">Odśwież</a>


<?php
//include footer template
require_once('../footer.html.php');
?>