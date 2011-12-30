<?php
    // include the database class
    include '/classes/database.php';

    // checks if the form has been submitted
    if (isset($_POST['submit']) || isset($_POST['random'])) {
        // start a new connection to the database
        $databaseConnection = new database("localhost", "root", "", "films");
    } 
?>
<!DOCTYPE html>

<html>
<head>
    <?php
        include '/htmlTemplates/blocks/b_0.0_head.html';
    ?>
</head>

<body>
    <div id="page">
        <?php
            // this ensures that the file is located properly from the assets folder
            $path = $_SERVER['DOCUMENT_ROOT'];
            $navigation = $path.="/htmlTemplates/blocks/b_1.0_primary_navigation.html";
            include_once($path);
        ?>
        <div id="content">
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
    // random film
    if (isset($_POST['random'])){
        $query = "select * from film where id >= RAND() * (select max(id) from film) limit 1";
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
    
    // close the connection
    unset($databaseConnection);    
?>
            <a href="/index.php">Search another film</a>
        </div>
    </div>
</body>
</html>