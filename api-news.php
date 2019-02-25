<?php

//The API for news

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/panda/constants.php");

//loading required the classes
require_once('news.php');
require_once('user.php');
require_once('utilities.php');

// initiating the objects
$News = new News();
$User = new User();
$Utilities = new Utilities();

// create connection with database
$pdo = $Utilities->dbConnection();

//shelling out with adress requests
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

// decode data json with request
$input = json_decode(file_get_contents('php://input'), true);

// reload data input
$newData = $Utilities->loadData($input);

try {

    switch ($request[0]) {
        // the handling request get with database
        case 'news':

           // generate sql
            $sql = $News->getNews($User->getId($_SESSION['email'], $pdo));

            //prepare query
            $query = $pdo->prepare($sql);

            //execute query
            $query->execute();

            // check whether rows > 0 it get rows and push to array and encode json
            if($query->rowCount() > 0){
                
                $rows = $query->fetchAll();
                $dbData = [];
                foreach($rows as $key => $row){
                $dbData[] = $row;

                }

                echo json_encode($dbData);
                

            }    
            break;
        
        // the handling request create in database
        case 'create':

        //get user id
        $user_id = $User->getId($_SESSION['email'], $pdo);

        // check whether fields aren't empty
        if($Utilities->checkEmptyFields($newData)){
                return;
            }
            // check whether user is logged
            if($User->checkActive($pdo)){
                
                // generate sql
                $sql_create_news = $News->createNews($newData['title'], $newData['description'], $user_id);

                //prepare sql
                $query_create_news = $pdo->prepare($sql_create_news);

                // check whether execute sql and generate statement
                if($query_create_news->execute()){
                    echo json_encode($Utilities->generateStatement('create_message', 
                    'Wiadomość została zapisana w bazie.'));
                }

            } else {
                // generate statement
                echo json_encode($Utilities->generateStatement('create_message', 
                'Zaloguj sie aby móc dodać wiadomość.'));
            }
            

            break;
        
        // the handling request update in database
        case 'update':
            
            // check whether fields aren't empty
            if($Utilities->checkEmptyFields($newData)){
                return;
            }
            
             // check whether user is logged
            if($User->checkActive($pdo)){

                 // generate sql
                $sql_update_news = $News->updateNews($newData['title'], $newData['description'], $newData['news_id']);

                //prepare sql
                $query_update_news = $pdo->prepare($sql_update_news);

                // check whether execute sql and generate statement
                if($query_update_news->execute()){
                    echo json_encode($Utilities->generateStatement('update_message', 
                    'Wiadomość została zaaktualizowana.'));
                }

            } else {
                // generate statement
                echo json_encode($Utilities->generateStatement('update_message', 
                'Zaloguj sie aby móc zaaktualizować wiadomość.'));
            }

            
            
            break;

        // the handling request delete in database
        case 'delete':
            
            // check whether user is logged
            if($User->checkActive($pdo)){

                // generate sql
                $sql_delete_news = $News->deleteNews($_POST['news_id']);

                //prepare sql
                $query_delete_news = $pdo->prepare($sql_delete_news);

                // check whether execute sql and generate statement
                if($query_delete_news->execute()){
                    echo json_encode($Utilities->generateStatement('delete_message', 
                    'Wiadomość została usunięta z bazy.'));
                    
                    $Utilities->redirect("/views/news/news.html.php");
                    
                } else {
                    //throw exception
                    throw new PDOException("Wystapił problem z baza danych. Dane nie zostały usunięte. 
                    Skontaktuj sie z administratorem");
                }

            } else {
                 // generate statement
                echo json_encode($Utilities->generateStatement('delete_message', 
                'Zaloguj sie aby móc usuwać wiadomości.'));
            }

            break;

        default:

            break;
    }

} catch (PDOException $e) {
    $_SESSION['error_db'] = "<div class='alert alert-danger'>".$e->getMessage()."</div>";
}


