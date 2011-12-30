<?php
    // include the database class
    include '/assets/scripts/php/classes/database.php';
    
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Film Lizard</title>
        <link href="/assets/styles/common.css" rel="stylesheet">
    </head>
    
    <body>
        <div id="page">
            <?php
                include '/htmlTemplates/blocks/b_1.0_primary_navigation.html';
            ?>
            <div id="content">
                <h1>Add A Film To Your Collection</h1>
                <p>
                    Search for a film and add it to your collection.
                </p>
                <form action="/assets/scripts/php/results.php" method="POST" id="film-update">
                    <fieldset>
                        <legend> Rotten Tomatoes data search for films </legend>
                        <label for="film-search">Search for this film on Rotten Tomatoes: </label>
                        <input type="text" name="film-search" id="film-search">
                        <input type="submit" value="search for film" name="submit">
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- javascript files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <!--<script src="/assets/scripts/js/common.js"></script>-->
    </body>
</html>