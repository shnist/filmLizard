<?php
    // include the database class
    include '/classes/database.php';
    
    if (isset ($_POST['submit'])){
        // ensuring empty values are not submitted
        if ($_POST['id'] !== '' || $_POST['certificate'] !== '' || $_POST['release-date'] !== '' || $_POST['rating'] !== '' || $_POST['poster'] !== ''){
            $databaseConnection = new database("localhost", "root", "", "films");
            $id = $_POST['id'];
            $certificate = $_POST['certificate'];
            $date = $_POST['release-date'];
            $rating = $_POST['rating'];
            $poster = urlencode($_POST['poster']);
            $insert = $databaseConnection->insertNewData($id, $certificate, $date, $rating, $poster);
            
            if ($insert === "success"){
                echo "<p> Data successfully inserted </p>";
            } else {
                echo "<p> an error has occurred </p>";
            }
        } else {
            echo "an empty value has been submitted";
        }
     
    } else {
        echo "<p>form not submitted</p>";
    }

    echo "<a href='/assets/scripts/php/database.php'>Go Back </a>";

?>