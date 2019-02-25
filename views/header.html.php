<?php  
//include file with constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/panda/constants.php");
// header template
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panda project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/panda/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo APP_PATH; ?>">AppProject</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav" >
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_PATH; ?>index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if(isset($_SESSION['email'])) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_VIEW; ?>news/news.html.php">News <span class="sr-only">(current)</span></a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_VIEW; ?>users/register-form.html.php" id="register">Zarejestruj się</a>
      </li>
      <?php if(!isset($_SESSION['email'])) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_VIEW; ?>users/login-form.html.php" id="login">Zaloguj się</a>
      </li>
      <?php } else if(isset($_SESSION['success_login'])) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_PATH; ?>api.php/logout" tabindex="-1" aria-disabled="true">Wyloguj się</a>
      </li>
      <span id="info-log" ><?php echo $_SESSION['email']; ?></span>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_PATH; ?>import_csv/csv.html.php" tabindex="-1" aria-disabled="true">Zaimportuj plik CSV</a>
      </li>
    </ul>
    <div class="social-media">
      <span>Śledź nas&gt;&gt; </span>
      <a href="https://www.facebook.com/" class="btn btn-info">Facebook</a>
      <a href="https://twitter.com/?lang=pl" class="btn btn-info">Twitter</a>
      <a href="https://plus.google.com/discover" class="btn btn-info">Google+</a>
      <a href="https://www.linkedin.com/" class="btn btn-info">Linkedin</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col" id="content">

<div id="infos"></div>


