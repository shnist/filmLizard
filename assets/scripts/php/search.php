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
    if(isset($_POST['film-search'])){
        if($_POST['film-search'] !== ''){
            $film = $_POST['film-search'];        
            $query = "select * from film where title='".$film."'";
            $result = $databaseConnection->selectQuery($query);
            if ($result !== null) {
                echo "<ul>";
                echo "<li>Title: ".$result->title."</li>";
                echo "<li>Rating: ".$result->rating."</li>";
                echo "<li>Certificate: ".$result->certificate."</li>";
                echo "<li>Release Year: ".$result->releaseDate."</li>";
                echo "<li><img src='".urldecode($result->poster)."' alt='".$result->title."'></li>";
                echo "</ul>";
            }
        }
    } elseif (isset($_POST['film-id'])){
        if($_POST['film-id'] !== ''){
            $film = $_POST['film-id'];
            $query = "select * from film where id='".$film."'";
            $result = $databaseConnection->selectQuery($query);
            if ($result !== null) {
                echo "<ul>";
                echo "<li>Title: ".$result->title."</li>";
                echo "<li>Rating: ".$result->rating."</li>";
                echo "<li>Certificate: ".$result->certificate."</li>";
                echo "<li>Release Year: ".$result->releaseDate."</li>";
                echo "<li><img src='".urldecode($result->poster)."' alt='".$result->title."'></li>";
                echo "</ul>";
            }
        }
    }
    // close the connection
    unset($databaseConnection);    
?>
    <a href="/index.php">Search another film</a>
    </div>
</body>
</html>