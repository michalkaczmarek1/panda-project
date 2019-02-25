<?php
// include header
require_once('../../header.html.php');

// include class
require_once($_SERVER['DOCUMENT_ROOT'] . '/panda/utilities.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/panda/news.php');


//init objects
$News = new News();
$Utilities = new Utilities();

//create database
$pdo = $Utilities->dbConnection();

// get one news data
if(isset($_GET['id'])){
    $one_news = $News->getOneNews($_GET['id'], $pdo);
}

?>

<h3>Formularz edycji wiadomości</h3>
<form id="edit-form" action="">
<div id="alerts"></div>
    <div class="form-group">
        <input type="hidden" value="<?php echo $one_news['news_id'] ?>" name="news_id">
    </div>
    <div class="form-group">
        <label for="title">Tytuł</label>
        <input type="text" class="form-control" id="title" value="<?php echo $one_news['name'] ?>" name="title">
    </div>
    <div class="form-group">
        <label for="description">Opis</label>
        <textarea class="form-control" id="description" name="description"><?php echo $one_news['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-success" id="edit">Edytuj</button>
    <a href="<?php echo APP_VIEW; ?>news/news.html.php" type="submit" class="btn btn-info">Wróć</a>
</form>


<?php
// include footer
require_once('../../footer.html.php');
?>