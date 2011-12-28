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
            
            if ($insert !== "success"){
                echo "<p> an error inserting data into film table has occurred </p>";
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
                    
            // the differences between the two arrays is compared and genres that do not exist
            // in the database are assigned to the new genres variable
            if ($existingGenres !== null){
                $newGenres = array_diff_assoc($genreArray, $existingGenres);
                // these are then inserted into the genre table
                $insertGenres = $databaseConnection->insertGenres($newGenres);                
            } else {
                $insertGenres = $databaseConnection->insertGenres($genreArray);  
            }
            if ($insertGenres === "error"){
                echo $insertGenres;
            }
            
            
            // code to update the genreFilm table
            $updateGenreFilm = $databaseConnection->updateGenreFilm($id, $genreArray);
            //if ($updateGenreFilm === "error") {
                var_dump($updateGenreFilm);
            //} 
        }
        
    } else {
        echo "<p>form not submitted</p>";
    }

    echo "<a href='/filmUpdate.php'>Go Back </a>";

?>