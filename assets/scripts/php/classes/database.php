<?php
class database {
    public $connection, $host, $userName, $password, $database;
    // constructor
    function database ($host, $userName, $password, $database) {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
        // host, username, password, default database
        $this->connection = new mysqli($this->host,$this->userName,$this->password,$this->database);
        if(mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }
    }
    // destructor
    function __destruct (){
        $this->connection->close();
    }
    function selectQuery ($query){
        // search the database by title
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                //echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    }
    function insertQuery ($query) {
        if ($result = $this->connection->query($query)){
            return "success";
        } else {
            return $query." error";
        }  
    }
    function createView($query){
        if ($result = $this->connection->query($query)){
            return "success";
        } else {
            return "error";
        }  
    }
    function searchForIdByTitle($title) {
        $query = "select id from film where title='".$title."'";
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                //echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    }
    function searchByQuery ($query){
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                //echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    }
    function insertGenres($genres){
        $length = count($genres);
        for ($i = 0; $i < $length; $i++){
            $query = "insert into genre(genre) values ('".urlencode($genres[$i])."')";
            if ($this->connection->query($query) !== true){
                return $query." = error";
            }
        }
    }
    function insertNewActors($actors){
        $actorLength = count($actors);
        for ($a = 0; $a < $actorLength; $a++){
            $query = "insert into actor(name) values ('".urlencode($actors[$a])."')";
            if ($this->connection->query($query) !== true){
                return $query." = error";
            }
        }
    }    
    function updateGenreFilm($filmId, $genres){
        $genresLength = count($genres);
        for ($j = 0; $j < $genresLength; $j++){
            $genre = urlencode($genres[$j]);
           // $idQuery = "select id from genre where genre='".$genre."'";
           $idQuery = "select id from genre where genre='Drama'";
            if ($genreIdResult = $this->connection->query($idQuery)){
                if ($genreIdResult->num_rows !== 0){
                    $genreId = $genreIdResult->fetch_object();
                }
                $genreFilmInsert = "insert into genreFilm(filmId, genreId) values('".$filmId."','".$genreId->id."')";
                if ($this->connection->query($genreFilmInsert) !== true){
                    echo "<p>".$genreFilmInsert." = error</p>";
                } 
            } else {
                echo "<p>".$idQuery." = error</p>";
            }
        }
    }
    function updateActorFilm($filmId, $actors){
        $actorsLength = count($actors);
        for ($b = 0; $b < $actorsLength; $b++){
            $actor = urlencode($actors[$b]);
            $actorIdQuery = "select id from actor where name='".$actor."'";
            if ($actorIdResult = $this->connection->query($actorIdQuery)){
                if ($actorIdResult->num_rows !== 0){
                    $actorId = $actorIdResult->fetch_object();
                }
                $actorFilmInsert = "insert into actorFilm(filmId, actorId) values('".$filmId."','".$actorId->id."')";
                if ($this->connection->query($actorFilmInsert) !== true){
                    echo "<p>".$actorFilmInsert." = error </p>";
                }
            } else {
                echo "<p>".$actorIdQuery." = error</p>";
            }
        }
    }    
    function selectByGenreAndActor($actor, $genre, $order){
        // create genre view
        $genreView = "create or replace view genreSelection as select * from film where id in (select filmId from genreFilm where genreId in (select id from genre where genre = '".$genre."'))";
        if ($this->connection->query($genreView) !== true){
            return "view creation error";
        } else {
            // filter by actor on genreview - with optional order
            if ($order !== ''){
                $actorFilter = "select * from genreSelection where id in (select filmId from actorFilm where actorId in (select id from
                actor where name = '".$actor."')) order by ".$order." desc";
            } else {
                $actorFilter = "select * from genreSelection where id in (select filmId from actorFilm where actorId in (select id from
                actor where name = '".$actor."'))";
            }
            if ($result = $this->connection->query($actorFilter)){
                // if results were returned
                if ($result->num_rows !== 0){
                    while ($row = $result->fetch_assoc()){
                        $returnedResult[] = $row;
                    }
                    return $returnedResult;
                } else {
                    //echo "no results returned!";
                }
                // close query
                $result->close();
                // tidy up by deleting the view
                $deleteView = "";
            } else {
                echo "query error";
            } 
        }
    }
    function selectGenreIdByGenre($genre){
        $query = "select id from genre where genre='".$genre."'";
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                //echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    }
    function selectActorIdByActor($actor){
        $query = "select id from actor where name='".$actor."'";
        if ($result = $this->connection->query($query)){
            // if results were returned
            if ($result->num_rows !== 0){
                while ($row = $result->fetch_assoc()){
                    $returnedResult[] = $row;
                }
                return $returnedResult;
            } else {
                //echo "no results returned!";
            }
            // close query
            $result->close();
        } else {
            echo "query error";
        }
    }
    function updateGenreActor($genreId, $actorId){
        $query = "insert into genreActor (genreId, actorId) values ('".$genreId."', '".$actorId."')";
        if ($this->connection->query($query) !== true){
            return "error";
        }
    }
}

?>