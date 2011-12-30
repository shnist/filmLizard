<!DOCTYPE html>
<html>
    <head>
        <title>Populate Database</title>
        <link href="/assets/styles/common.css" rel="stylesheet">
    </head>
    <body>
        <div id="page">
            <?php
                // this ensures that the file is located properly from the assets folder
                $path = $_SERVER['DOCUMENT_ROOT'];
                $navigation = $path."/htmlTemplates/blocks/b_1.0_primary_navigation.html";
                include_once($path);
            ?>
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
        $searchResults = json_decode($data);
        if ($searchResults === NULL) die('Error parsing json');
        
        // play with the data!
        $movies = $searchResults->movies;
        echo "<ul class='search-results'>";
        foreach ($movies as $movie) {
            // search for movie details to extract the genres
            $detailsUrl = $movie->links->self.'?apikey=' . $apikey;
            // setup curl to make a call to the endpoint
            $detailsSession = curl_init($detailsUrl);
            // indicates that we want the response back
            curl_setopt($detailsSession, CURLOPT_RETURNTRANSFER, true);
            // exec curl and get the data back
            $detailsData = curl_exec($detailsSession);
            // remember to close the curl session once we are finished retrieveing the data
            curl_close($detailsSession);
            // decode the json data to make it easier to parse the php
            $filmDetails = json_decode($detailsData);
            if ($filmDetails === NULL) die('Error parsing json');
            
            $genresLength = count($filmDetails->genres);
            $actorsLength = count($filmDetails->abridged_cast);
            $genres = '';
            $actors = '';
            for ($i = 0; $i < $genresLength; $i++){
                if ($i !== ($genresLength - 1)){
                    $genres .= $filmDetails->genres[$i].',';
                } else {
                    $genres .= $filmDetails->genres[$i];
                }
            }
            for ($j = 0; $j < $actorsLength; $j++){
                if ($j !== ($actorsLength - 1)){
                    $actors .= $filmDetails->abridged_cast[$j]->name.',';
                } else {
                    $actors .= $filmDetails->abridged_cast[$j]->name;
                }
            }
            
            echo "<li class='result'>";
                echo "<ul>";
                    echo "<li>".$movie->title." </li>";
                    echo "<li><img src='".urldecode($movie->posters->original)."' alt='".$movie->title."' </li>";
                    echo "<li>".$movie->mpaa_rating." </li>";
                    echo "<li>".$movie->year." </li>";
                    echo "<li>".$movie->ratings->audience_score." </li>";
                echo "</ul>";
                echo "<form action='/assets/scripts/php/populateDatabase.php' method='POST'>";
                    echo "<fieldset>";
                        echo "<legend> Add the film to your collection </legend>";
                        echo "<ul>";
                            echo "<li>";
                                echo "<label for='title'>Title</label>";
                                echo "<input type='text' name='title' id='title' value='".$movie->title."' readonly='readonly'>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='certificate'>Certificate</label>";
                                echo "<input type='text' name='certificate' id='certificate' value='".$movie->mpaa_rating."' readonly='readonly'>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='release-date'>Release Date </label>";
                                echo "<input type='text' name='release-date' id='release-date' value='".$movie->year."' readonly='readonly'>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='rating'>Rating </label>";
                                echo "<input type='text' name='rating' id='rating' value='".$movie->ratings->audience_score."' readonly='readonly'>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='poster'>Poster</label>";
                                echo "<input type='text' name='poster' id='poster' value='".$movie->posters->original."' readonly='readonly'>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='genres'>Genres</label>";
                                echo "<textarea name='genres' id='genres' readonly='readonly'>".$genres."</textarea>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='actors'>Actors</label>";
                                echo "<textarea name='actors' id='actors' readonly='readonly'>".$actors."</textarea>";
                            echo "</li>";
                            echo "<li>";
                                echo "<label for='location'>Location</label>";
                                echo "<select name='location' id='location'>";
                                    echo "<option value='home'>Home</option>";
                                    echo "<option value='university'>University</option>";
                                echo "</select>";
                            echo "</li>";
                        echo "</ul>";
                       echo "<input type='submit' value='add to the collection' name='submit'>";
                    echo "</fieldset>";
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