<?php
    // include the database class
    include 'assets/scripts/php/classes/database.php';
    
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
    
?>

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
                <h1>Add A Film To Your Collection</h1>
                <p>
                    Search for a film and add it to your collection. Some searches can take up to 10 seconds
                    to process, so please be patient.
                </p>
                <p>
                    We search the <a href="http://www.rottentomatoes.com/">Rotten Tomatoes</a> movie
                    database to find possible matches. We'll show you the results and then you get to
                    decide which film is added to your collection.
                </p>                    
                <form action="/assets/scripts/php/results.php" method="POST" id="film-update">
                    <fieldset>
                        <legend> Rotten Tomatoes data search for films </legend>
                        <label for="film-search">Search for this film on Rotten Tomatoes: </label>
                        <input type="text" name="film-search" id="film-search" placeholder="Find a film to add to your collection...">
                        <input type="text" name="submitted" class="hidden">
                        <input type="submit" value="Search" name="submit">
                    </fieldset>
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