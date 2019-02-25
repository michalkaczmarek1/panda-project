<?php
// The API for users

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/panda/constants.php");

//loading required the classes
require_once('user.php');
require_once('utilities.php');


//object class User and Utilities
$User = new User();
$Utilities = new Utilities();

// create connection with database
$pdo = $Utilities->dbConnection();

//shelling out with adress requests
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

// get data from body query
$input = json_decode(file_get_contents('php://input'), true);


// get data to array and its return
$newData = $Utilities->loadData($input);

// the handling request register in database
if($request[0] === 'register'){

    // check whether fields aren't empty
    if($Utilities->checkEmptyFields($newData)){
        return;
    }

    // register user - generate sql;
    $sql = $User->register($newData['first_name'], $newData['last_name'], $newData['email'],
    $newData['gender'], $newData['password']);
    // prepare query register
    $query = $pdo->prepare($sql);
    //execute query register
    $query->execute();

    // generate statement
    echo json_encode($Utilities->generateStatement('success_register', 
    'Zostałeś poprawnie zarejestrowany. Przejdź do logowania.'));

  // the handling request login to application
} else if ($request[0] === 'login'){

    // check whether fields aren't empty
    if($Utilities->checkEmptyFields($newData)){
        return;
    }

        
        // generate sql
        $sql = $User->login($newData['email'], $newData['password']);
        
        //prepare sql
        $query = $pdo->prepare($sql);

        //execute sql
        $query->execute();

        // check whether rows > 0, if true it login user and no rows it generate statement
        if($query->rowCount() > 0){
            $sql2 = $User->changeStatus($newData['email'], $newData['password']);
            $query2 = $pdo->prepare($sql2);
            $query2->execute();
            echo json_encode($Utilities->generateStatement('success_login', 
            'Zostałeś poprawnie zalogowany.'));
        
        } else {
            //generate statement
            echo json_encode($Utilities->generateStatement('error_log', 
            'Wpisz poprawne dane.'));
            return;
        }

 // the handling request logout application
} else if ($request[0] === 'logout') {

    //generate sql
    $sql = $User->logout($_SESSION['email']);
    
    //prepare sql
    $query = $pdo->prepare($sql);
    
    //execute sql
    $query->execute();
    
    //generate statement
    echo json_encode($Utilities->generateStatement('success_logout', 
            'Zostałeś poprawnie wylogowany.'));

    header('Location: http://localhost/panda/logout.php');

}
