<?php
// include header template
require_once ('../../header.html.php');
?>


<h3>Formularz dodawania wiadomości</h3>
<form id="create-form" action="">
<div id="alerts"></div>
    <div class="form-group">
        <label for="title">Tytuł</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="description">Opis</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-success" id="create">Dodaj</button>
    <a href="<?php echo APP_VIEW; ?>news/news.html.php" type="submit" class="btn btn-info">Wróć</a>
</form>


<?php
// include footer template
require_once ('../../footer.html.php');
?>
