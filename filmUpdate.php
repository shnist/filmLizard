<?php
    // include the database class
    include '/assets/scripts/php/classes/database.php';
    
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
            <ul class="navigation" id="primary-navigation">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="filmUpdate.php">Update Database</a>
                </li>
            </ul>
            <div id="content">
                <h1>Database</h1>
                <p>
                    This page is used for populating the database.
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