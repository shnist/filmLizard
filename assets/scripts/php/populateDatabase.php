<?php
    // include the database class
    include '/classes/database.php';
    
    if (isset ($_POST['submit'])){
        if ($_POST['certificate'] === ''){
            echo "<p>no value submitted for certificate</p>";
        }
        if ($_POST['release-date'] === ''){
            echo "<p>no value submitted for release date</p>";
        }
        if ($_POST['rating'] === ''){
            echo "<p>no value submitted for rating</p>";
        }
    } else {
        echo "<p>form not submitted</p>";
    }

    echo "<a href='/assets/scripts/php/database.php'>Go Back </a>";

?>