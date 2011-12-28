<!DOCTYPE html>

<html>
<head>
    <title>Aaron's Film Collection</title>
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
            <h1> Aaron's Film Collection </h1>
            <form action="/assets/scripts/php/search.php" method="POST">
                <fieldset>
                    <legend>Search for a film </legend>
                    <label for="film-search">Search by title</label>
                    <input type="text" name="film-search" id="film-search"> 
                </fieldset>
                <input type="submit" value="Search" name="submit">
            </form>
            <h2> Categories </h2>
            <form action="/assets/scripts/php/categories.php" method="POST">
                <fieldset>
                    <legend>Search by genre </legend>
                    <label for="genre-search"> Search by genre </label>
                    <select name="genre" id="genre-search">
                        <option value="select"> Select an option </option>
<?php
    // include the database class
    include '/assets/scripts/php/classes/database.php';

    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");

    $genres = $databaseConnection->selectAllGenres();
    $genresLength = count($genres);
    for ($i = 0; $i < $genresLength; $i++){
        echo "<option value='".$genres[$i]."'>".$genres[$i]."</option>";
    }
?>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>Search by actor</legend>
                    <label for="actor-search">Search by actor</label>
                    <input type="text" name="actor-search" id="actor-search">
                </fieldset>
                <input type="submit" value="Search" name="submit" class="submit">
            </form>
        </div>
    </div>
</body>
</html>
