<?php
class database {
    public $connection, $host, $userName, $password, $database;
    // constructor
    function database ($host, $userName, $password, $database) {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
        // host, username, password, default database
        $this->connection = new mysqli($this->host,$this->userName,$this->password,$this->database);
        if(mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }
    }
    // destructor
    function __destruct (){
        $this->connection->close();
    }
    function searchByTitle($title) {
        $query = "SELECT * FROM film WHERE title='".$title."'";
        // search the database by title
        if ($result = $this->connection->query($query)) {
            // if results were returned          
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_object()) { 
                    return $row;
                }
            } else {
                echo "no results returned!";
            }
            // close the query 
            $result->close();
        } else {
            echo "there has been a query error";
        }
    }
    function searchByGenre($genre) {
        $query = "select * from film where genre='".$genre."'";
        // search database by genre
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    }
    function retrieveAll (){
        $query = "select * from film";
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    } 
}
?>