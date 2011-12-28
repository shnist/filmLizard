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
            $existingGenres = $databaseConnection->selectAllGenres();
            
            // error checking
            echo "<p> genres of film </p>";
            var_dump($genreArray);
            if ($existingGenres !== null){
                echo "<p> existing genres </p>";
                var_dump($existingGenres);
            } else {
                echo "<p> no existing genres </p>";
            }
            
            // eo error checking
                    
            // the differences between the two arrays is compared and genres that do not exist
            // in the database are assigned to the new genres variable
            if ($existingGenres !== null){
                // array_values resets the index of the returned array - known short coming of array_diff
                $newGenres = array_values(array_diff($genreArray, $existingGenres));
                // these are then inserted into the genre table
                $insertGenres = $databaseConnection->insertGenres($newGenres);
                echo "<p> new genres </p>";
                var_dump($newGenres);
            } else {
                //echo "first insert";
                $insertGenres = $databaseConnection->insertGenres($genreArray);  
            }
            //if ($insertGenres === "error"){
                //var_dump($insertGenres);
            //}
            
            // code to update the genreFilm table
            $updateGenreFilm = $databaseConnection->updateGenreFilm($id, $genreArray);
            if ($updateGenreFilm === "error") {
                echo $updateGenreFilm;
            } 
        }
        
    } else {
        echo "<p>form not submitted</p>";
    }

    echo "<a href='/filmUpdate.php'>Go Back </a>";

?>