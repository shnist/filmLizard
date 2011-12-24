<?php

class database {
    public $connection;
    // constructor
    function database () {
        // host, username, password, default database
        $this->connection = new mysqli('localhost','root','','films');
        if(mysqli_connect_errno()) {
            die(mysqli_connect_error());
        } else {
            echo "success";
        }
    }
    function searchByTitle() {
    
    }
}

// checks if the form has been submitted
if (isset($_POST['submit'])) {
    var_dump($_POST['film-search']);
    
    $databaseConnection = new database();
    
    // if someone has search by title
    if($_POST['film-search'] === ''){
        
        
    }

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
        <a href="index.php">Back to search </a>
    </div>
</body>
</html>
