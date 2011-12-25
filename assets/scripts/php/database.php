<?php
    // include the database class
    include '/classes/database.php';
    
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
    
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Populate Database</title>
        
    </head>
    
    <body>
        <h1>Database</h1>
        <p> This page is used for populating the database </p>
    </body>
</html>