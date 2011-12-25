<?php

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
        <h1> Results </h1>
<?php    
    // if someone searches by genre
    if($_POST['genre'] !== 'select'){
        $genre = $_POST['genre'];
        $genreResult = $databaseConnection->searchByGenre($genre);

        echo "<h2> Results for ".$genre."</h2>";
        echo "<ol>";
        foreach ($genreResult as $row){
            echo "<li>";
            echo "<ul>";
            echo "<li>".$row['title']."</li>";
            echo "<li>".$row['rating']."</li>";
            echo "</ul>";
            echo "</li>";
        }
        echo "</ol>";
    
    } else {
        echo "nothing has been selected";
    }
    
    // close the connection
    unset($databaseConnection);    
?>
        <a href="/index.php">Back to search </a>
    </div>
</body>
</html>
