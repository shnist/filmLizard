<?php
    // include the database class
    include 'database.php';

    // checks if the form has been submitted
    if (isset($_POST['submit'])) {
        // start a new connection to the database
        $databaseConnection = new database("localhost", "root", "", "films");
    } 

    // if someone has search by title
    if($_POST['film-search'] !== ''){
        $filmTitle = $_POST['film-search'];
        $titleResult = $databaseConnection->searchByTitle($filmTitle);

        if ($titleResult !== null) {
            echo "<ul>";
            echo "<li>Title: ".$titleResult->title."</li>";
            echo "<li>Rating: ".$titleResult->rating."</li>";
            echo "</ul>";
        }

        // close the connection
        unset($databaseConnection);
    }
?>