<?php

class Utilities {

    //properties class
    private $dbuser = 'root';
    private $dbpass = '';


    /**
     * dbConnection
     * create connection with database
     * @return PDO - the object reprenting connection with database
     */
    public function dbConnection(): PDO {
        try {
            $pdo = new PDO('mysql:dbname=panda_db;host=127.0.0.1;charset=utf8', $this->dbuser, $this->dbpass);
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
            return $pdo;
        } catch (PDOException $e){
            echo "Połączenie nie udane: " . $e->getMessage();
        }
    }
    
    
    /**
     * loadData
     * transformation data to array
     * @param  mixed $data
     *
     * @return array
     */
    public function loadData($data): array{
        
        $newData = [];

        for($i = 0; $i < count($data); $i++){
            $newData[$data[$i]['name']] = $data[$i]['value'];
        }

        return $newData;

    }

    
    
   
    /**
     * generateStatement
     * generate statement to json and $_SESSION for users
     * @param  mixed $key
     * @param  mixed $stmt
     *
     * @return array
     */
    public function generateStatement(string $key, string $stmt): array {
        

        $json[$key] = $stmt;

        $_SESSION[$key] = $stmt;

        return $json;
    }

   
    /**
     * checkFields
     * check whether fields are empty
     * @param  mixed $input
     *
     * @return void
     */
    public function checkEmptyFields(array $input){
        
        $empty = false;

        foreach($input as $key => $row){
            
            if($input[$key] === ''){
               $empty = true;
            }

        }

        if($empty){
            echo json_encode($this->generateStatement('error_empty', 'Uzupełnij wszystkie pola'));
            return true;
        }
        
        
    }

    /**
     * redirect
     * redirect to other page
     * @param  mixed $path
     *
     * @return void
     */
    public function redirect($path){
        
        header('Location: http://localhost/panda/'.$path);

    }

}