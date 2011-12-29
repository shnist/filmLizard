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
    <title>Aaron's Film Collection</title>
    <link href="/assets/styles/common.css" rel="stylesheet">
</head>

<body>
    <div id="page">
        <ul class="navigation" id="primary-navigation">
            <li>
                <a href="/index.php">Home</a>
            </li>
            <li>
                <a href="/filmUpdate.php">Update Database</a>
            </li>
        </ul>
        <div id="content">
            <h1> Results </h1>
            <form action="/assets/scripts/php/categories.php" method="POST">
                <fieldset>
                    <legend>Original search values</legend>
<?php
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
?>                    
                </fieldset>
                <fieldset>
                    <legend>Sort by rating </legend>
                    <select name="sort-by" id="sort-by">
                        <option value="select">Select an option</option>
                        <option value="rating">rating</option>
                        <option value="releaseDate">release date</option>
                    </select>
                </fieldset>
                <input type ="submit" name="submit" value="filter">
            </form>
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
        echo "<p> You searched be genre : ".urldecode($genre)."</p>";
        echo "<p> And by actor : ".urldecode($actor)."</p>";
        
        if ($orderBy !== 'select'){
            $queryResults = $databaseConnection->selectByGenreAndActor($actor, $genre, $orderBy);
        } else {
            $queryResults = $databaseConnection->selectByGenreAndActor($actor, $genre);
        }
        
        $queryResults = $databaseConnection->selectByGenreAndActor($actor, $genre);
        $arrayLength = count($queryResults);
       
        echo "<ul class='category-results'>";
        for ($i = 0; $i < $arrayLength; $i++){
            echo "<li class='result'>";
                echo "<ul>";
                    echo "<li>".$queryResults[$i]['title']." </li>";
                    echo "<li><img src='".urldecode($queryResults[$i]['poster'])."' alt='".$queryResults[$i]['title']."' </li>";
                    echo "<li>".$queryResults[$i]['certificate']." </li>";
                    echo "<li>".$queryResults[$i]['releaseDate']." </li>";
                    echo "<li>".$queryResults[$i]['rating']." </li>";
                echo "</ul>";
                echo "<form action='/assets/scripts/php/search.php' method='post'>";
                    echo "<input type='text' name='film-id' value='".$queryResults[$i]['id']."' readonly='readonly'>";
                    echo "<input type='submit' name='submit' value='get details'>";
                echo "</form>";
            echo "</li>";
        } 
        echo "</ul>";
        
    } elseif ($_POST['genre-search'] !== 'select'){
        $genre = urlencode($_POST['genre-search']);
        echo "<p> You searched by genre : ".urldecode($genre)."</p>";
        if ($orderBy !== 'select'){
            $genreResults = $databaseConnection->selectByGenre($genre, $orderBy);
        } else {
            $genreResults = $databaseConnection->selectByGenre($genre);
        }
        $arrayLength = count($genreResults);
        
        echo "<ul class='category-results'>";
        for ($i = 0; $i < $arrayLength; $i++){
            echo "<li class='result'>";
                echo "<ul>";
                    echo "<li>".$genreResults[$i]['title']." </li>";
                    echo "<li><img src='".urldecode($genreResults[$i]['poster'])."' alt='".$genreResults[$i]['title']."' </li>";
                    echo "<li>".$genreResults[$i]['certificate']." </li>";
                    echo "<li>".$genreResults[$i]['releaseDate']." </li>";
                    echo "<li>".$genreResults[$i]['rating']." </li>";
                echo "</ul>";
                echo "<form action='/assets/scripts/php/search.php' method='post'>";
                    echo "<input type='text' name='film-id' value='".$genreResults[$i]['id']."' readonly='readonly'>";
                    echo "<input type='submit' name='submit' value='get details'>";
                echo "</form>";
            echo "</li>";
        } 
        echo "</ul>";
    } elseif ($_POST['actor-search'] !== '') {
        $actor = urlencode($_POST['actor-search']);
        echo "<p> You searched by actor : ".urldecode($actor)."</p>";
        if ($orderBy !== 'select'){
            $queryResults = $databaseConnection->selectByActor($actor, $orderBy);
        } else {
            $queryResults = $databaseConnection->selectByActor($actor);
        }        
        $actorResults = $databaseConnection->selectByActor($actor);
        $arrayLength = count($actorResults);
        
        echo "<ul class='category-results'>";
        for ($i = 0; $i < $arrayLength; $i++){
            echo "<li class='result'>";
                echo "<ul>";
                    echo "<li>".$actorResults[$i]['title']." </li>";
                    echo "<li><img src='".urldecode($actorResults[$i]['poster'])."' alt='".$actorResults[$i]['title']."' </li>";
                    echo "<li>".$actorResults[$i]['certificate']." </li>";
                    echo "<li>".$actorResults[$i]['releaseDate']." </li>";
                    echo "<li>".$actorResults[$i]['rating']." </li>";
                echo "</ul>";
                echo "<form action='/assets/scripts/php/search.php' method='post'>";
                    echo "<input type='text' name='film-id' value='".$actorResults[$i]['id']."' readonly='readonly'>";
                    echo "<input type='submit' name='submit' value='get details'>";
                echo "</form>";
            echo "</li>";
        } 
        echo "</ul>";        
    } else {
        "<p> nothing was searched </p>";
    }

?>
            <a href="/index.php">Back to search </a>
        </div>
    </div>
</body>
</html>
