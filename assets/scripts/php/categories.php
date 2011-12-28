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
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="filmUpdate.php">Update Database</a>
            </li>
        </ul>
        <div id="content">
            <h1> Results </h1>
            <form action="/assets/scripts/php/categories.php" method="POST">
                <fieldset>
                    <legend>Filter by rating </legend>
                    <select name="rating" id="rating">
                        <option value="select">Select an option</option>
                        <option value="100">100</option>
                        <option value="90">90</option>
                        <option value="80">80</option>
                        <option value="70">70</option>
                        <option value="60">60</option>
                        <option value="50">50</option>
                        <option value="40">40</option>
                        <option value="30">30</option>
                        <option value="20">20</option>
                        <option value="10">10</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>Filter by release date </legend>
                    <select name="date" id="date">
                        <option value="select">Select an option</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                    </select>
                </fieldset>                
            </form>
<?php
    // first we will find out which categories the user wishes to search by
    if($_POST['genre'] !== 'select'){
        $genre = urlencode($_POST['genre']);
        echo "<p> You search by : ".urldecode($genre)."</p>";
        $genreResults = $databaseConnection->selectByGenre($genre);
        
        echo "<ul>";
        
        var_dump($genreResults);
        
        echo "</ul>";
   }



?>
            <a href="/index.php">Back to search </a>
        </div>
    </div>
</body>
</html>
