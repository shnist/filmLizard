<!DOCTYPE html>

<html>
<head>
    <?php
        include 'htmlTemplates/blocks/b_0.0_head.html';
    ?>
</head>
<body> 
    <div id="page">
        <?php
            include 'htmlTemplates/blocks/b_1.0_primary_navigation.html';
        ?>
        <div id="content">
            <h1> Film Lizard</h1>
            <p>
                Keep track of your physical film collection online with Film Lizard. Let it
                help you choose a film for those romantic nights in, those random lazy days and
                for when you need to procrastinate!
            </p>           
            <h2> Search for a film in my collection </h2>
            <form action="/assets/scripts/php/categories.php" method="POST">
                <fieldset>
                    <legend>Search by genre </legend>
                    <label for="genre-search"> Search by genre </label>
                    <select name="genre-search" id="genre-search">
                        <option value="select"> Select an option </option>
<?php
    // include the database class
    include 'assets/scripts/php/classes/database.php';

    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");

    $query = "select genre from genre";
    $genres = $databaseConnection->selectQuery($query);
    $genresLength = count($genres);
    for ($i = 0; $i < $genresLength; $i++){
        echo "<option value='".urldecode($genres[$i]['genre'])."'>".urldecode($genres[$i]['genre'])."</option>";
    }
?>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>Search by actor</legend>
                    <label for="actor-search">Search by actor</label>
                    <input type="text" name="actor-search" id="actor-search">
                </fieldset>
                <input type="text" name="submitted" class="hidden"> 
                <input type="submit" value="Search" name="submit" class="submit">
            </form>
        </div>
<?php
    include 'htmlTemplates/blocks/b_2.0_footer.html';
?>          
    </div>
<?php
    include 'htmlTemplates/blocks/b_0.1_scripts.html';
?>    
</body>
</html>
