<?php
    // include the database class
    include '/classes/database.php';
    
    // checks if the form has been submitted
    if (isset($_POST['submit'])) {
        // start a new connection to the database
        $databaseConnection = new database("localhost", "root", "", "films");
    }
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
    <div id="page" class="categories">
        <?php
            // this ensures that the file is located properly from the assets folder
            $navigation = $path.'/htmlTemplates/blocks/b_1.0_primary_navigation.html';
            include_once($navigation);
        ?>        
        <div id="content">
            <h1> Results </h1>
<?php
    // sort by
    if (isset($_POST['sort-by'])){
        if ($_POST['sort-by'] !== null){  
            $orderBy = $_POST['sort-by'];
        } 
    } else {
        $orderBy = '';
    }

    // first we will find out which categories the user wishes to search by
    if ($_POST['genre-search'] !== 'select' && $_POST['actor-search'] !== ''){
        $genre = urlencode($_POST['genre-search']);
        $actor = urlencode($_POST['actor-search']);
        echo "<p class='search-by-information'> You searched by genre : ".urldecode($genre).". And by actor : ".urldecode($actor)."</p>";
       
        if ($orderBy !== 'select' && $orderBy !== ''){
            $queryResults = $databaseConnection->selectByGenreAndActor($actor, $genre, $orderBy);
        } else {
            $queryResults = $databaseConnection->selectByGenreAndActor($actor, $genre);
        }
    
        $arrayLength = count($queryResults);
        
    } elseif ($_POST['genre-search'] !== 'select'){
        $genre = urlencode($_POST['genre-search']);
        echo "<p class='search-by-information'> You searched by genre : ".urldecode($genre)."</p>";
        if ($orderBy !== 'select' && $orderBy !== ''){
            $query = "select * from film where id in (select filmId from genreFilm where genreId in (select id from
            genre where genre = '".$genre."')) order by ".$orderBy." desc";
            $queryResults = $databaseConnection->selectQuery($query);
        } else {
            $query = "select * from film where id in (select filmId from genreFilm where genreId in (select id from
            genre where genre = '".$genre."'))";
            $queryResults = $databaseConnection->selectQuery($query);
        }
        $arrayLength = count($queryResults);
        

    } elseif ($_POST['actor-search'] !== '') {
        $actor = urlencode($_POST['actor-search']);
        echo "<p class='search-by-information'> You searched by actor : ".urldecode($actor)."</p>";
        if ($orderBy !== 'select' && $orderBy !== ''){
            echo "here";
            $query = "select * from film where id in (select filmId from actorFilm where actorId in (select id from actor
            where name like '%".$actor."%')) order by ".$orderBy." desc";
            $queryResults = $databaseConnection->selectQuery($query);
        } else {
            $query = "select * from film where id in (select filmId from actorFilm where actorId in (select id from actor
            where name like '%".$actor."%'))";
            $queryResults = $databaseConnection->selectQuery($query);
        }        
        $arrayLength = count($queryResults);
               
    } else {
        $queryResults = "empty";
        echo "<p> Oops. It seems you didn't search for anything. Why don't you <a href='/index.php'>make another search?</a> </p>";
    }
?>

<?php

    if ($queryResults !== null && $queryResults !== "empty"){
            echo "<form action='/assets/scripts/php/categories.php' method='POST' class='sort-by'>";
                echo "<fieldset class='hidden'>";
                    echo "<legend>Original search values</legend>";
                    // inserting values if they exist
                    if ($_POST['genre-search'] !== 'select' && $_POST['actor-search'] !== ''){
                        $genre = urldecode($_POST['genre-search']);
                        $actor = urldecode($_POST['actor-search']);
                        echo "<select name='genre-search' readonly='readonly'>";
                        echo    "<option value='".$genre."'>".$genre."</option>";
                        echo "</select>";
                        echo "<input type='text' name='actor-search' readonly='readonly' value='".$actor."'>";
                    } elseif ($_POST['genre-search'] !== 'select'){
                        $genre = urldecode($_POST['genre-search']);
                        echo "<select name='genre-search' readonly='readonly'>";
                        echo    "<option value='".$genre."'>".$genre."</option>";
                        echo "</select>";
                        echo "<input type='text' name='actor-search' readonly='readonly' value=''>";        
                    } elseif ($_POST['actor-search'] !== '') {
                        $actor = urldecode($_POST['actor-search']);
                        echo "<select name='genre-search' readonly='readonly'>";
                        echo    "<option value='select'>select</option>";
                        echo "</select>";
                        echo "<input type='text' name='actor-search' readonly='readonly' value='".$actor."'>";      
                    }
                echo "</fieldset>";
                echo "<fieldset class='sort-by-options'>";
                    echo "<legend>Sort by rating </legend>";
                    echo "<label for='sort-by'>Sort by</label>";
                    echo "<select name='sort-by' id='sort-by'>";
                        echo "<option value='select'>Select an option</option>";
                        echo "<option value='rating'>rating</option>";
                        echo "<option value='releaseDate'>release date</option>";
                    echo "</select>";
                echo "</fieldset>";
                echo "<input type='submit' name='submit' value='filter'>";
            echo "</form>";
        echo "<ul class='search-results'>";
        for ($i = 0; $i < $arrayLength; $i++){
            echo "<li class='result'>";
                echo "<ul>";
                    echo "<li class='title'>".$queryResults[$i]['title']." </li>";
                    echo "<li class='poster'><img src='".urldecode($queryResults[$i]['poster'])."' alt='".$queryResults[$i]['title']."' </li>";
                    echo "<li><span class='category'>Certificate</span>: ".$queryResults[$i]['certificate']." </li>";
                    echo "<li><span class='category'>Release Date</span>: ".$queryResults[$i]['releaseDate']." </li>";
                    echo "<li><span class='category'>Audience Rating</span>: ".$queryResults[$i]['rating']." </li>";
                    echo "<li><span class='category'>Location</span>: ".$queryResults[$i]['location']." </li>";
                echo "</ul>";
                echo "<form action='/assets/scripts/php/search.php' method='post' class='get-details'>";
                    echo "<input type='text' name='film-id' value='".$queryResults[$i]['id']."' readonly='readonly' class='hidden'>";
                    echo "<input type='submit' name='submit' value='View Details'>";
                echo "</form>";
            echo "</li>";
        } 
        echo "</ul>";
        echo "<p> Try a <a href='/index.php'> different search</a>. </p>";
    } elseif ($queryResults !== "empty") {
        echo "<p> No results for your search. Sad times! </p>";
        echo "<p> Try a <a href='/index.php'> different search</a>. </p>";
    }
?>
        </div>
    </div>
</body>
</html>
