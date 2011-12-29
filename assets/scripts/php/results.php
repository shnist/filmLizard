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
                <h1> Search results </h1>
<?php

if (isset($_POST['submit'])){
    if ($_POST['film-search'] !== ''){
        $film = $_POST['film-search'];
        $apikey = 'wje47anurr2v5f4kv9e3ppjy';
        $q = urlencode($film); // make sure to url encode an query parameters
        // construct the query with our apikey and the query we want to make
        $endpoint = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $apikey . '&q=' . $q;

        // setup curl to make a call to the endpoint
        $session = curl_init($endpoint);
        
        // indicates that we want the response back
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        
        // exec curl and get the data back
        $data = curl_exec($session);
        
        // remember to close the curl session once we are finished retrieveing the data
        curl_close($session);
        
        // decode the json data to make it easier to parse the php
        $search_results = json_decode($data);
        if ($search_results === NULL) die('Error parsing json');
        
        // play with the data!
        $movies = $search_results->movies;

        echo "<ul class='search-results'>";
        foreach ($movies as $movie) {
            echo "<li class='result'>";
                echo "<ul>";
                    echo "<li>".$movie->title." </li>";
                    echo "<li><img src='".urldecode($movie->posters->original)."' alt='".$movie->title."' </li>";
                    echo "<li>".$movie->mpaa_rating." </li>";
                    echo "<li>".$movie->year." </li>";
                    echo "<li>".$movie->ratings->audience_score." </li>";
                echo "</ul>";
                echo "<form action='/assets/scripts/php/search.php' method='post'>";
                    echo "<input type='text' name='film-id' value='".$movie->title."' readonly='readonly'>";
                    echo "<input type='submit' name='submit' value='get details'>";
                echo "</form>";
            echo "</li>";
        } 
        echo "</ul>";        
        

        echo "<a href='/filmUpdate.php'>New search</a>";
    } elseif ($_POST['film-search'] === '') {
        echo "<p> You did not search for anything</p>";
        echo "<a href='/filmUpdate.php'>New search</a>";
    } else {
        echo "<p> No results returned</p>";
        echo "<a href='/filmUpdate.php'>New search</a>";
    }
}
    
?>
            </div>
        </div>
    </body>
</html>