<?php
    // include the database class
    include '/assets/scripts/php/classes/database.php';
    
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
    
?>

<!DOCTYPE html>

<html>
<head>
    <title>Update Genre</title>
    <link href="/assets/styles/common.css" rel="stylesheet">   
</head>

<body>
    <div id="page">
        <h1> Update Genre </h1>
        <p> This page is used to update the genres of the films. </p>
        <p> Below are all the films that do not have a genre.</p>
<?php
        $query = "select all title from film where id not in (select filmId from genreFilm)";
        $results = $databaseConnection->retrieveUnpopulated($query);
        $length = sizeof($results);
        echo "<ul>";
         for ($i = 0; $i < $length; $i++) {
            echo "<li><a href='#'>".$results[$i]["title"]."</a></li>";
         }
        echo "</ul>";
?>
        <form action="#" method="POST" class="imdb" id="genre-update">
            <fieldset>
                <legend> IMDB data search for films </legend>
                <label for="film-search">Search for this film on IMDB: </label>
                <input type="text" name="film-search" id="film-search">
                <input type="submit" value="search for film">
            </fieldset>
        </form>
    </div>

    <!-- javascript files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="/assets/scripts/js/common.js"></script>
</body>
</html>
