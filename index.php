<!DOCTYPE html>

<html>
<head>
    <?php
        include '/htmlTemplates/blocks/b_0.0_head.html';
    ?>
</head>
<body> 
    <div id="page">
        <?php
            include '/htmlTemplates/blocks/b_1.0_primary_navigation.html';
        ?>
        <div id="content">
            <h1> Film Lizard</h1>
            <form action="/assets/scripts/php/search.php" method="POST">
                <fieldset>
                    <legend>Search for a film </legend>
                    <label for="film-search">Search by title</label>
                    <input type="text" name="film-search" id="film-search">
                    <input type="submit" value="Search" name="submit">
                </fieldset>
                <fieldset>
                    <legend>Search from random film</legend>
                    <input type="submit" value="i'm feeling lucky" name="random">
                </fieldset>
            </form>            
            <h2> What is Film Lizard? </h2>
            <p>
                Film Lizard is a film library that enables you to keep a track of your movie collection
                online.
            </p>
            <p>
                Ever felt like watching a film, but weren't sure what to choose? Fancy watching a
                film with Tom Hanks in, but unsure which one? With Film Lizard you effortlessly browse
                through your collection by Genre and Actor. If you're not particularly fussed, why not
                try the "I'm feeling lucky" option? This will select a random film from your collection.
            </p>
            <h2> Categories </h2>
            <form action="/assets/scripts/php/categories.php" method="POST">
                <fieldset>
                    <legend>Search by genre </legend>
                    <label for="genre-search"> Search by genre </label>
                    <select name="genre-search" id="genre-search">
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
