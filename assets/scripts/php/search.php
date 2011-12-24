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
}

// checks if the form has been submitted
if (isset($_POST['submit'])) {
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Aaron's Film Collection</title>
    <link href="/assets/styles/common.css" rel="stylesheet">
</head>

<body>
    <div id="page">
        <h1> Results </h1>
<?php
    // if someone has search by title
    if($_POST['film-search'] !== ''){
        $filmTitle = $_POST['film-search'];
        $titleResult = $databaseConnection->searchByTitle($filmTitle);
        
        echo "<ul>";
        echo "<li>Title: ".$titleResult->title."</li>";
        echo "<li>Rating: ".$titleResult->rating."</li>";
        echo "</ul>";
        
        // close the connection
        unset($databaseConnection);
    }
    
    // if someone searches by genre
    if($_POST['genre'] !== 'select'){
        $genre = $_POST['genre'];
        $genreResult = $databaseConnection->searchByGenre($genre);

        echo "<h2> Results for ".$genre."</h2>";
        echo "<ol>";
        foreach ($genreResult as $row){
            echo "<li>";
            echo "<ul>";
            echo "<li>".$row['title']."</li>";
            echo "<li>".$row['rating']."</li>";
            echo "</ul>";
            echo "</li>";
        }
        echo "</ol>";
    
    } else {
        echo "nothing has been selected";
    }
    
    // close the connection
    unset($databaseConnection);    
?>
        <a href="/index.php">Back to search </a>
    </div>
</body>
</html>
