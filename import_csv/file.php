<?php

class File {

    //properties class
    public $dir;
    public $path_file;
    public $file_ext;
    public $records;
    public $upload_success = 1;
    
    
    
    /**
     * upload
     * upload file csv on server
     * 
     * @param  mixed $dir
     * @param  mixed $path_file
     * @param  mixed $file_ext
     *
     * @return void
     */
    public function upload(string $dir, string $path_file, string $file_ext, array $file_upload, Utilities $Utilities){

        $this->dir = $dir;
        $this->path_file = $path_file;
        $this->file_ext = $file_ext;

        //check whether file has extension csv
        if($file_ext !== 'csv' ) {
            echo json_encode($Utilities->generateStatement('error_no_upload', 
            "Plik nie jest w formacie CSV. Plik nie moze zostać przesłany."));
            $this->upload_success = 0;
            return false;
        }
        
        //check whether file exist
        if (file_exists($path_file)) {
            echo json_encode($Utilities->generateStatement('error_no_upload', 
            "Plik już istnieje. Plik nie moze zostać przesłany."));
            $this->upload_success = 0;
            return false;
        }
        
        // upload file
        if (move_uploaded_file($file_upload["tmp_name"], $path_file)) {
            echo json_encode($Utilities->generateStatement('success_upload', 
            "Plik ". basename( $file_upload["name"]). " został przesłany na serwer. Dane zostały zapisane w bazie"));
            $this->upload_success = 1;
            
            return true;
        } else {
            echo json_encode($Utilities->generateStatement('error_no_upload', 
            "Plik nie moze zostać przesłany."));
            $this->upload_success = 0;
            return false;
        }

    }

    /**
     * loadDataCsv
     * tranformation data with file to array
     * @param  mixed $path_file
     *
     * @return array
     */
    public function loadDataCsv(string $path_file): array {

        $arr_file = file($path_file);
        $this->records = [];

        $this->records['headers'] = explode(",", $arr_file[0]);
        
        //check whether file has line with headers
        if(count($this->records['headers']) > 0){
            unset($arr_file[0]);
            foreach($arr_file as $row){
            
                $arr_row = explode(',', $row);
            
                $data_db['id'] = $arr_row[0];
                $data_db['first_name'] = $arr_row[1];
                $data_db['last_name'] = $arr_row[2];
                $data_db['email'] = $arr_row[3];
                $data_db['gender'] = $arr_row[4];
                $data_db['country'] = $arr_row[5];

                $this->records[] = $data_db;    

            }
        } else {
            foreach($arr_file as $row){
        
                $arr_row = explode(',', $row);
            
                $data_db['id'] = $arr_row[0];
                $data_db['first_name'] = $arr_row[1];
                $data_db['last_name'] = $arr_row[2];
                $data_db['email'] = $arr_row[3];
                $data_db['gender'] = $arr_row[4];
                $data_db['country'] = $arr_row[5];
    
                $this->records[] = $data_db;    
            }
        }   
        
        return $this->records;

    }

    /**
     * createTable
     * create table in database on base data with array($this->records['headers] - columns)
     * @param  mixed $table_name
     * @param  mixed $columns
     *
     * @return void
     */
    public function createTable(string $table_name, array $columns){

        $datatypes = ["INT", "VARCHAR", ["ENUM" => "ENUM('Female', 'Male')"]];
        $sql = "CREATE TABLE ".$table_name."(";
        $i = 0;

        if(count($columns) > 0){
            foreach($columns as $value){

                switch ($value) {
                    case 'id':
                        $sql.= $value." ".$datatypes[0];
                        $i++;
                        break;
                    case ('gender'):
                        $sql.= $value." ".$datatypes[2]["ENUM"];
                        $i++;
                        break;

                    default:
                        $sql.= $value." ".$datatypes[1]."(120)";
                        $i++;    
                        break;
                }

                if($i < count($columns)){
                    $sql .= ",";
                } else if($i === count($columns)){
                    $sql .= "";
                } else {
                    $sql .= "";
                }
              
            }

            $sql .= ")";

        } else {
            $sql .= "id INT,
            first_name VARCHAR(80),
            last_name VARCHAR(80),
            email VARCHAR(150),
            gender ENUM('Female','Male'),
            country VARCHAR(80))";
        }

        
        return $sql;

    }

    /**
     * insertData
     * save records with file in database
     * @param  mixed $table_name
     * @param  mixed $columns
     * @param  mixed $rows
     * @param  mixed $pdo - the parameter to connection db
     *
     * @return void
     */
    public function insertData($table_name, $columns, $rows, PDO $pdo) {
        
        // create table in database
        $query_table = $pdo->prepare($this->createTable($table_name, $columns));

        if($query_table->execute() === false){
            throw new PDOException("Wystapił problem z baza danych. Dane nie zostały zapisane. 
                                    Skontaktuj sie z administratorem"); 
        }
                 
        $this->records = $rows;

        // insert data to database
        foreach ($this->records as $value) {


            $sql = "INSERT INTO ".$table_name."(id, first_name, last_name, email, gender, country) 
                VALUES (:id, :first_name, :last_name, :email, :gender, :country)";
        
            $query = $pdo->prepare($sql);
    
            $query->bindParam(':id', $value['id']);
            $query->bindParam(':first_name', $value['first_name']);
            $query->bindParam(':last_name', $value['last_name']);
            $query->bindParam(':email', $value['email']);
            $query->bindParam(':gender', $value['gender']);
            $query->bindParam(':country', $value['country']);
            

           if($query->execute() === false){
                throw new PDOException("Wystapił problem z baza danych. Dane nie zostały zapisane. Skontaktuj sie z administratorem");
           }

        }
        
    }

    /**
     * dataChart
     * get data with database to chart
     * @param  mixed $table_name
     * @param  mixed $pdo - the parameter to connection db
     *
     * @return void
     */
    public function dataChart(string $table_name, PDO $pdo) {

        
        $sql = "SELECT country, COUNT(id) as 'amount_person' FROM ".$table_name." GROUP BY country ORDER BY amount_person DESC";

        $query = $pdo->prepare($sql);
        
        if(isset($_SESSION['table_name'])){
            $query->execute();
        } else {
            return;
        }
        

        $data_chart = [];

        if($query->rowCount() > 0){

           $data_chart = $query->fetchAll();
   
        }
        

        return $data_chart;
        

    }

}
          