<?php

class News {

    // properties class
    public $news_id;
    public $name;
    public $description;
    public $user_id;
    

 
    /**
     * getNews
     * get all news user with database
     * 
     * @param  mixed $user_id
     *
     * @return string
     */
    public function getNews(int $user_id): string {

        $this->user_id = $user_id;

        $sql = "SELECT news_id, name, description, created_at, updated_at FROM news WHERE user_id = ".$this->user_id;
        
        return $sql;

    }

    /**
     * createNews
     * save news in database
     * 
     * @param  mixed $name
     * @param  mixed $description
     * @param  mixed $user_id
     *
     * @return string
     */
    public function createNews(string $name, string $description, int $user_id): string{

        $this->name = $name;
        $this->description = $description;
        $this->user_id = $user_id;

        $sql = "INSERT INTO news(name, description, user_id) 
        VALUES('".$this->name."','".$this->description."','".$this->user_id."')";

        return $sql;
        
    }


    /**
     * getOneNews
     * get one news with database
     * 
     * @param  mixed $news_id
     * @param  mixed $pdo - the parameter to connection db
     *
     * @return string or boolean
     */
    public function getOneNews(int $news_id, PDO $pdo){

        $sql = "SELECT * FROM news WHERE news_id = ".$news_id;

        $sql_one_news = $pdo->prepare($sql);

        if($sql_one_news->execute() === false){
            throw new PDOException("Wystapił problem z baza danych. Dane nie zostały zapisane. 
            Skontaktuj sie z administratorem");
            
        }

        if($sql_one_news->rowCount() > 0){

            $sql_one_news = $sql_one_news->fetch(PDO::FETCH_ASSOC);
            return $sql_one_news;

        } else {
            return false;
        }

    }

    /**
     * updateNews
     * update news in database
     * 
     * @param  mixed $name
     * @param  mixed $description
     * @param  mixed $news_id
     *
     * @return string
     */
    public function updateNews(string $name, string $description, int $news_id): string {

        $this->name = $name;
        $this->description = $description;
        $this->news_id = $news_id;
        

        $sql = "UPDATE news SET name = '".$this->name."', description = '".$this->description."', 
                updated_at = NOW() WHERE news_id = ".$this->news_id;

        return $sql;
    }

    /**
     * deleteNews
     * delete news in database
     * 
     * @param  mixed $news_id
     *
     * @return string
     */
    public function deleteNews(int $news_id): string {

        $this->news_id = $news_id;

        $sql = "DELETE FROM news WHERE news_id = ".$this->news_id;

        return $sql;

    }

}