<?php

class User
{
    //properties class
    private $salt = 'sdsads9aud0auda0du';

    public $user_id;
    private $first_name;
    private $last_name;
    public $email;
    private $gender;
    public $password;

    /**
     * register
     * save users in database
     * 
     * @param  mixed $first_name
     * @param  mixed $last_name
     * @param  mixed $email
     * @param  mixed $gender
     * @param  mixed $password
     *
     * @return string
     */
    public function register(string $first_name, string $last_name, string $email, string $gender, string $password): string
    {

        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->gender = $gender;
        $this->password = md5($password) . $this->salt;

        $sql = "INSERT INTO register(first_name, last_name, email, gender, pass) VALUES ('" . $this->first_name . "', '" . $this->last_name . "',
                    '" . $this->email . "', '" . $this->gender . "', '" . $this->password . "')";

        return $sql;
    }

 
   
    /**
     * login
     * login users in application
     * @param  mixed $email
     * @param  mixed $password
     *
     * @return string
     */
    public function login(string $email, string $password): string
    {

        $this->email = $email;
        $this->password = md5($password) . $this->salt;

        $sql = "SELECT email, pass FROM register WHERE email = '" . $this->email . "' AND pass = '" . $this->password . "'";

        return $sql;

    }

    /**
     * changeStatus
     * change status users to user has access to news
     * @param  mixed $email
     * @param  mixed $password
     *
     * @return string
     */
    public function changeStatus(string $email, string $password): string
    {

        $this->email = $email;
        $this->password = md5($password) . $this->salt;

        

        $_SESSION['email'] = $this->email;

        if ($_SESSION['email'] !== '') {

            $sql = "UPDATE register SET is_active = '1' WHERE email = '" . $this->email . "' AND pass = '" . $this->password . "'";
            return $sql;
        }

        

    }

    /**
     * logout
     * logout users with application
     * @param  mixed $email
     *
     * @return string
     */
    public function logout(string $email): string {

        $this->email = $email;

        if(isset($_SESSION['email'])){

            $sql = "UPDATE register SET is_active = '0' WHERE email = '" . $this->email . "'";
            session_destroy();
            return $sql;
        };

    }

    /**
     * getId
     * get id user with db 
     * @param  mixed $email
     * @param  mixed $pdo - the parameter to connection db
     *
     * @return void
     */
    public function getId(string $email, PDO $pdo): int {

        $this->email = $email;

        $sql = "SELECT user_id FROM register WHERE email = '".$this->email."'";
        
        $query_get_id = $pdo->prepare($sql);

        if($query_get_id->execute() === false){
            throw new PDOException("Wystapił problem z baza danych. 
            Skontaktuj sie z administratorem");
        }

        if($query_get_id->rowCount() > 0){

            $row_get_id = $query_get_id->fetch(PDO::FETCH_ASSOC);
            return $row_get_id['user_id'];

        } else {
            return false;
        }
        
    }

    /**
     * checkActive
     * check whether user is logged to user could handle news
     * 
     * @param  mixed $pdo - the parameter to connection db
     *
     * @return void
     */
    public function checkActive(PDO $pdo){

        $sql = "SELECT register.user_id, register.is_active, news.user_id 
                FROM register INNER JOIN news ON register.user_id = news.user_id WHERE
                register.is_active = news.is_active;";
        
        
        $query = $pdo->prepare($sql);

        if($query->execute() === false){
            throw new PDOException("Wystapił problem z baza danych. 
            Skontaktuj sie z administratorem");
        }

        if($query->rowCount() > 0){
            
            return true;
        } else {
            
            return false;
        }
 
    }
}
