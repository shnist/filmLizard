<?php
    // include the database class
    include '/classes/database.php';
    
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Populate Database</title>
        <link href="/assets/styles/common.css" rel="stylesheet">
    </head>
    
    <body>
        <div id="page">
            <h1>Database</h1>
            <p>
                This page is used for populating the database.
            </p>
            <p>
                Below is a list of all the films that have not
                been populate with data yet. Click on one of them to populate the form, which can then
                be used to search for data on a film.
            </p>
            <div class="results">
                <h3> Unpopulated data </h3>
<?php
        $results = $databaseConnection->retrieveAll();
        $length = sizeof($results);
        echo "<ul>";
         for ($i = 0; $i < $length; $i++) {
             echo "<li><a href='#'>".$results[$i]["title"]."</a></li>";
         
         }
        echo "</ul>";
?>
            </div>
            <form action="#" method="POST" id="imdb">
                <fieldset>
                    <legend> IMDB data search for films </legend>
                    <label for="film-search">Search for this film on IMDB: </label>
                    <input type="text" name="" id="film-search">
                    <input type="submit" value="search for film">
                </fieldset>
            </form>
            <form action="/assets/scripts/php/populateDatabase.php" method="POST">
                <fieldset>
                    <legend> Populate the Database with the film </legend>
                    <ul>
                        <li>
                            <label for="id">ID from database </label>
                            <input type="text" name="id" id="id">
                        </li>
                        <li>
                            <label for="certificate">Certificate</label>
                            <input type="text" name="certificate" id="certificate">
                        </li>
                        <li>
                            <label for="release-date">Release Date </label>
                            <input type="text" name="release-date" id="release-date">
                        </li>
                        <li>
                            <label for="rating">Rating </label>
                            <input type="text" name="rating" id="rating">
                        </li>
                    </ul>
                    <input type="submit" value="populate database" name="submit">
                </fieldset>
                
            </form>
        </div>
        <!-- javascript files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="/assets/scripts/js/common.js"></script>
    </body>
</html>