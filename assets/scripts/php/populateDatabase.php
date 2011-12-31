<!DOCTYPE html>

<html>
<head>
    <?php
        // this ensures that the file is located properly from the assets folder
        $path = $_SERVER['DOCUMENT_ROOT'];
        $head = $path.'/htmlTemplates/blocks/b_0.0_head.html';
        include_once($head);
    ?>
</head>
<body> 
    <div id="page">
        <?php
            // this ensures that the file is located properly from the assets folder
            $navigation = $path.'/htmlTemplates/blocks/b_1.0_primary_navigation.html';
            include_once($navigation);
        ?>
        <div id="content">
<?php
    // include the database class
    include 'classes/database.php';
    

    if (isset($_POST['submitted'])){
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
                $id = $idResult[0]['id'];
                
                // code to update the genre tables
                // this code will add a genre if it doesn't already exist and then populate the genreFilm table
                // for the film 
                if ($_POST['genres'] !== ''){
                    $genres = $_POST['genres'];
                    // break the genres into an array using
                    $genreArray = explode(",", $genres);
                    
                    // get all the existing genres from the database
                    $selectGenres = "select genre from genre";
                    $existingGenresResult = $databaseConnection->selectQuery($selectGenres);
                    $existingGenres = array();
                    
                    // existing genres needs to processed so that the array difference can work
                    for ($j = 0; $j < count($existingGenresResult); $j++){
                        array_push($existingGenres, urldecode($existingGenresResult[$j]['genre']));
                    }
                    
                    // the differences between the two arrays is compared and genres that do not exist
                    // in the database are assigned to the new genres variable
                    if ($existingGenres !== null){
                        // array_values resets the index of the returned array - known short coming of array_diff
                        $newGenres = array_values(array_diff($genreArray, $existingGenres));
                        
                        // these are then inserted into the genre table
                        $insertGenres = $databaseConnection->insertGenres($newGenres);
                        if ($insertGenres === "error"){
                            echo $insertGenres;
                        }
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
                
                    $actorArray = explode(",", $actors);
                    // get all the existing actors from the database
                    $query = "select name from actor";
                    $existingActorsResult = $databaseConnection->selectQuery($query);
                    $existingActors = array();
                    
                    // existing genres needs to processed so that the array difference can work
                    for ($a = 0; $a < count($existingActorsResult); $a++){
                        array_push($existingActors, urldecode($existingActorsResult[$a]['name']));
                    }
                    
                    //echo "<p> actors from film </p>";
                    //var_dump($actorArray);
                    
                    //echo "<p> existing actors </p>";
                    //var_dump($existingActors);
                
                    if ($existingActors !== null){
                        // array_values resets the index of the returned array - known short coming of array_diff
                        $newActors = array_values(array_diff($actorArray, $existingActors));
                        //echo "<p> new actors </p>";
                        //var_dump($newActors);
                        
                        // these are then inserted into the genre table
                        $insertActors = $databaseConnection->insertNewActors($newActors);
                        if ($insertActors === "error"){
                            echo $insertActors;
                        }                        
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

    echo "<a href='/filmUpdate.php'>Add Another Film To Your Collection</a>";
?>
        </div>
<?php
    $footer = $path.'/htmlTemplates/blocks/b_2.0_footer.html';
    include_once($footer);
?>             
    </div>
<?php
    $scripts = $path.'/htmlTemplates/blocks/b_0.1_scripts.html';
    include_once($scripts);
?>        
</body>
</html>