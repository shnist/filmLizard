<?php
    // include the database class
    include '/classes/database.php';
    
    if (isset ($_POST['submit'])){
        // ensuring empty values are not submitted
        if ($_POST['id'] !== '' || $_POST['certificate'] !== '' || $_POST['release-date'] !== '' || $_POST['rating'] !== '' || $_POST['poster'] !== ''){
            $databaseConnection = new database("localhost", "root", "", "films");
            $id = $_POST['id'];
            $certificate = $_POST['certificate'];
            $date = $_POST['release-date'];
            $rating = $_POST['rating'];
            $poster = urlencode($_POST['poster']);
            $insert = $databaseConnection->insertNewData($id, $certificate, $date, $rating, $poster);
            
            if ($insert === "success"){
                echo "<p> Data successfully inserted into film</p>";
            } else {
                echo "<p> an error has occurred </p>";
            }
        } else {
            echo "an empty value has been submitted";
        }
        
        // code to update the genre tables
        // this code will add a genre if it doesn't already exist and then populate the genreFilm table
        // for the film 
        if ($_POST['genres'] !== ''){
            $genres = $_POST['genres'];
            // break the genres into an array using
            $genreArray = explode(",", $genres);
            
            // get all the existing genres from the database
            $existingGenres = $databaseConnection->selectGenres();
            
            // 
            
        }
        
     
    } else {
        echo "<p>form not submitted</p>";
    }

    echo "<a href='/filmUpdate.php'>Go Back </a>";

?>