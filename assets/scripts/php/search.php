<?php
    // include the database class
    include 'classes/database.php';

    // checks if the form has been submitted
    $databaseConnection = new database("localhost", "aaronfa1_faberaa", "23!Arsakia1089",   "aaronfa1_films");

?>
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
    <div id="page" class="film-details">
        <?php
            // this ensures that the file is located properly from the assets folder
            $navigation = $path."/htmlTemplates/blocks/b_1.0_primary_navigation.html";
            include_once($navigation);
        ?>
        <div id="content">
            <h1 class="hidden">Film Details</h1> 
<?php
    if(isset($_POST['film-search'])){
        if($_POST['film-search'] !== ''){
            $film = $_POST['film-search'];        
            $filmQuery = "select * from film where title like '%".$film."%'";
            $result = $databaseConnection->selectQuery($filmQuery);
        }
    } elseif (isset($_POST['film-id'])){
        if($_POST['film-id'] !== ''){
            $film = $_POST['film-id'];
            $filmQuery = "select * from film where id='".$film."'";
            $result = $databaseConnection->selectQuery($filmQuery);
        }
    } elseif (isset($_POST['random'])){
        // random film
        $filmQuery = "select * from film where id >= RAND() * (select max(id) from film) limit 1";
        $result = $databaseConnection->selectQuery($filmQuery);
    } else {
        $result = null;
    }
    
    if ($result !== null) {
        // get the genres
        $genreQuery = "select genre from genre where id in (select genreId from genreFilm where filmId = '".$result[0]['id']."')";
        $actorQuery = "select name from actor where id in (select actorId from actorFilm where filmid = '".$result[0]['id']."')";
        $genres = $databaseConnection->selectQuery($genreQuery);
        $actors = $databaseConnection->selectQuery($actorQuery);
        $genresLength = count($genres);
        $actorsLength = count($actors);
    
        echo "<h2>".$result[0]['title']."</h2>";
        echo "<img src='".urldecode($result[0]['poster'])."' alt='".$result[0]['title']."'>";
        echo "<ul>";
            echo "<li><span class='category'>Rating</span>: ".$result[0]['rating']."</li>";
            echo "<li><span class='category'>Certificate</span>: ".$result[0]['certificate']."</li>";
            echo "<li><span class='category'>Release Year</span>: ".$result[0]['releaseDate']."</li>";
            echo "<li><span class='category'>Current Location</span>: ".$result[0]['location']." </li>";
            echo "<li><span class='category'>Genres</span>: ";
                for ($i = 0; $i < $genresLength; $i++){
                    if ($i !== ($genresLength - 1)){
                        echo urldecode($genres[$i]['genre']).", ";
                    } else {
                        echo urldecode($genres[$i]['genre']);
                    }
                }
            echo "</li>";
            echo "<li><span class='category'>Principal Actors</span>: ";
                for ($i = 0; $i < $actorsLength; $i++){
                    if ($i !== ($actorsLength - 1)){
                        echo urldecode($actors[$i]['name']).", ";
                    } else {
                        echo urldecode($actors[$i]['name']);
                    }
                }
            echo "</li>";
        echo "</ul>";
    } else {
        echo "<p> Sorry, we couldn't find anything! </p>";
    }
    
    // close the connection
    unset($databaseConnection);    
?>
            <a href="/index.php">Search for another film</a>   
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