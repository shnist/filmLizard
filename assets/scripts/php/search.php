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
?>