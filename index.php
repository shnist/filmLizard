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
            <p>
                Keep track of your physical film collection online with Film Lizard. Let it
                help you choose a film for that romantic night in, those lazy days and
                for when you need to procrastinate!
            </p>
            <form action="/assets/scripts/php/search.php" method="POST" class="primary-search">
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
