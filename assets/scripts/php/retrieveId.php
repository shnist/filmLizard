<?php
    // include the database class
    include '/classes/database.php';
    
    if ($_POST['t'] !== ''){
        $title = urldecode($_POST['t']);
        // start a new connection to the database
        $databaseConnection = new database("localhost", "aaronfa1_faberaa", "23!Arsakia1089",   "aaronfa1_films");
        $id = $databaseConnection->searchForIdByTitle($title);
        
        echo $id[0]['id'];
        
    } else {
        echo "foo";
    }
?>