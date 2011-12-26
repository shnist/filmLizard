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
        <h1> Results </h1>
<?php
    $categoryNumber = 0;
    $useGenre = false;
    $useRating = false;
    $useDate = false;
    // first we will find out which categories the user wishes to search by
    if($_POST['genre'] !== 'select'){
        $genre = $_POST['genre'];
        $useGenre = true;
        $categoryNumber = $categoryNumber + 1;
        echo "<p> genre: ".$genre."</p>";
   }
   if($_POST['rating'] !== 'select'){
        $rating = $_POST['rating'];
        $useRating = true;
        $categoryNumber = $categoryNumber + 1;
        echo "<p> rating: ".$rating."</p>";
   }
   if($_POST['date'] !== 'select'){
        $date = $_POST['date'];
        $useDate = true;
        $categoryNumber = $categoryNumber + 1;
        echo "<p> date: ".$date."</p>";
   }
   
    if ($categoryNumber === 3){
        $query;
    } elseif ($categoryNumber === 2){
        echo "two";
    } elseif($categoryNumber === 1){
        if($useRating === true){
            $query = "select * from film where rating > ".$rating;
            $result = $databaseConnection->searchByQuery($query);
            $length = count($result);
            for ($i = 0; $i < $length; $i++){
                echo "<ul>";
                echo "<li>".$result[$i]["title"]."</li>";
                echo "<li>".$result[$i]["releaseDate"]."</li>";
                echo "<li>".$result[$i]["certificate"]."</li>";
                echo "<li>".$result[$i]["rating"]."</li>";
                echo "</ul>";
            }
        } elseif ($useDate === true){
            $query = "select * from film where releaseDate = '".$date."'";
            $result = $databaseConnection->searchByQuery($query);
            $length = count($result);
            for ($i = 0; $i < $length; $i++){
                echo "<ul>";
                echo "<li>".$result[$i]["title"]."</li>";
                echo "<li>".$result[$i]["releaseDate"]."</li>";
                echo "<li>".$result[$i]["certificate"]."</li>";
                echo "<li>".$result[$i]["rating"]."</li>";
                echo "</ul>";
            }
        } elseif ($useGenre === true){
            $query = "select * from film";
        }
    }


?>
        <a href="/index.php">Back to search </a>
    </div>
</body>
</html>
