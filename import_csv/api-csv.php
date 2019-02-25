<?php
// include required files
require_once($_SERVER['DOCUMENT_ROOT'].'/panda/utilities.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/panda/constants.php');
require_once('file.php');

//init objects
$Utilities = new Utilities();
$file = new File();

//create connection with db
$pdo = $Utilities->dbConnection();

// check whether fields aren't empty
if($Utilities->checkEmptyFields($_FILES['file_csv'])){
    header('Location: '.APP_PATH."/import_csv/csv.html.php");
    return;
}

// variable require upload file
$dir = "uploads/";
$file_upload = $_FILES['file_csv'];
$path_file = $dir . basename($file_upload["name"]);
$file_ext = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));

//the handling error upload file
if($file->upload($dir, $path_file, $file_ext, $file_upload, $Utilities) === false){
    $Utilities->redirect("import_csv/csv.html.php");
}



//check whether haven't no errors
if(!isset($_SESSION['error_no_upload'])){

    //set variable session
    $_SESSION['table_name'] = explode(".", $file_upload['name'])[0];

    // load data with file csv
    $rows = $file->loadDataCsv($path_file);

    // the handling errors insert data to database
    try {
        
        // save data to database
        $file->insertData($_SESSION['table_name'], $rows['headers'], $rows, $pdo);
     
    } catch (PDOException $e) {
        //set variable session
        $_SESSION['error_db'] = "<div class='alert alert-danger'>".$e->getMessage()."</div>";
    }
    
    // redirect to csv page
    $Utilities->redirect("import_csv/csv.html.php");
    

}

 




