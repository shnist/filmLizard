<?php
    // include the database class
    include '/classes/database.php';
    

    if (isset($_POST['submit'])){
        $databaseConnection = new database("localhost", "root", "", "films");
        // empty value checking for the most important data
        if ($_POST['release-date'] !== '' || $_POST['rating'] !== ''){
            // values 
            $certificate = $_POST['certificate'];
            $rating = $_POST['rating'];
            $date = $_POST['release-date'];
            $title = $_POST['title'];
            $poster = urlencode($_POST['poster']);
            $location = $_POST['location'];
            // first we need to check whether the film already exists in the database
            $filmCheck = "select id from film where title='".$title."' and releaseDate= '".$date."'";
            $checkResult = $databaseConnection->selectQuery($filmCheck);
            
            if ($checkResult === null){
                // add the film to the collection
                $addNewValues = "insert into film (title, certificate, releaseDate, poster, location, rating) values
                ('".$title."', '".$certificate."', '".$date."', '".$poster."', '".$location."', '".$rating."')";
                $valuesResult = $databaseConnection->insertQuery($addNewValues);
                
                if ($valuesResult === 'success'){
                   echo "<p> Film added to your collection </p>"; 
                } else {
                    echo "<p> Sorry, but there was a problem with adding the film to your collection. Please try again </p>";
                }
                
                $idSelection = "select id from film where title ='".$title."' and releaseDate= '".$date."'";
                $idResult = $databaseConnection->selectQuery($idSelection);
                $id = $idResult->id;
                
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
                    //echo "<p> genres of film </p>";
                    //var_dump($genreArray);
                    //if ($existingGenres !== null){
                    //    echo "<p> existing genres </p>";
                    //    var_dump($existingGenres);
                    //} else {
                    //    echo "<p> no existing genres </p>";
                    //}
                    // eo error checking
                            
                    // the differences between the two arrays is compared and genres that do not exist
                    // in the database are assigned to the new genres variable
                    if ($existingGenres !== null){
                        // array_values resets the index of the returned array - known short coming of array_diff
                        $newGenres = array_values(array_diff($genreArray, $existingGenres));
                        // these are then inserted into the genre table
                        $insertGenres = $databaseConnection->insertGenres($newGenres);
                        //echo "<p> new genres </p>";
                        //var_dump($newGenres);
                    } else {
                        //echo "first insert";
                        $insertGenres = $databaseConnection->insertGenres($genreArray);  
                    }
                    if ($insertGenres === "error"){
                        echo $insertGenres;
                    }
                    
                    // code to update the genreFilm table
                    $updateGenreFilm = $databaseConnection->updateGenreFilm($id, $genreArray);
                    if ($updateGenreFilm === "error") {
                        echo $updateGenreFilm;
                    } 
                }
                
                // code to update the actors tables
                if ($_POST['actors'] !== ''){
                    $actors = $_POST['actors'];
                    //echo "<p> actors of film </p>";
                    //var_dump($actors);
            
                    $actorArray = explode(",", $actors);
                    // get all the existing actors from the database
                    $existingActors = $databaseConnection->selectAllActors();
                    
                    //echo "<p> existing actors </p>";
                    //var_dump($existingActors);
            
                    if ($existingActors !== null){
                        // array_values resets the index of the returned array - known short coming of array_diff
                        $newActors = array_values(array_diff($actorArray, $existingActors));
                        // these are then inserted into the genre table
                        $insertActors = $databaseConnection->insertNewActors($newActors);
                    } else {
                        $insertActors = $databaseConnection->insertNewActors($actorArray);  
                    }
                    if ($insertActors === "error"){
                        echo $insertActors;
                    }
                    // code to update the actorFilm table
                    $updateActorFilm = $databaseConnection->updateActorFilm($id, $actorArray);
                    if ($updateActorFilm === "error") {
                        echo $updateActorFilm;
                    }             
                }
                
            } else {
                echo "<p> This film already exists in your collection </p>";
            }
            
            
            
            
        } else {
            echo "<p> An empty value has been submitted </p>";
        }
        
        
        
    }
    
    // close the connection
    unset($databaseConnection);

    echo "<a href='/filmUpdate.php'>Go Back </a>";

?>