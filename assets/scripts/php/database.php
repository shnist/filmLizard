<?php
    // include the database class
    include '/classes/database.php';
    
    // start a new connection to the database
    $databaseConnection = new database("localhost", "root", "", "films");
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Populate Database</title>
        
    </head>
    
    <body>
        <h1>Database</h1>
        <p> This page is used for populating the database </p>
        <div class="results">
<?php
        $results = $databaseConnection->retrieveAll();
       // var_dump($results);
       $length = sizeof($results);
       echo "<ul>";
        for ($i = 0; $i < $length; $i++) {
            echo "<li><a href='#'>".$results[$i]["title"]."</a></li>";
        
        }
        echo "</ul>";
?>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $('a').click(function (e) {
                    e.preventDefault();
                    // value of search parameter
                    
                    
                       
                   
                });
                
                var imdb = window.imdb || {};
                
                imdb = {
                    connect : function (search) {
                        $.ajax(function (search){
                        
                        
                        });
                        
                        
                    }
                
                };
                
            });
            
        </script>
    </body>
</html>