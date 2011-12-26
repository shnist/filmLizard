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
<?php
    // if someone has search by title
    if($_POST['film-search'] !== ''){
        $filmTitle = $_POST['film-search'];
        $titleResult = $databaseConnection->searchByTitle($filmTitle);
       
        if ($titleResult !== null) {
            echo "<ul>";
            echo "<li>Title: ".$titleResult->title."</li>";
            echo "<li>Rating: ".$titleResult->rating."</li>";
            echo "<li>Certificate: ".$titleResult->certificate."</li>";
            echo "<li>Release Year: ".$titleResult->releaseDate."</li>";
            echo "<li><img src='".urldecode($titleResult->poster)."' alt='".$titleResult->title."'></li>";
            echo "</ul>";
        }

        // close the connection
        unset($databaseConnection);
    }
?>
    <a href="/index.php">Search another film</a>
    </div>
</body>
</html>