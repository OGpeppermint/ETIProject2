<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method = "post">
        <label for='searchbar'>Search Bar </label><br>
		<input type='text' name='searchbar'/><br>
        <label for="table">What are you searching for</label>
        <select name="table" id="table">
            <option value="actor">Actor</option>
            <option value="director">Director</option>
            <option value="movie">Movie</option>
            <option value="tv_series">Tv Show</option>
            <option value="tv_episode">Tv Episode</option>
            <option value="genre">Genre</option>
        </select></br>
        <input type='submit' value='Submit'/>
    </form>
    <?php

    require_once "login.php";

    echo "<table>";
    echo "<table><tr><th>Title</th></tr>";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST["searchbar"];
        $table = $_POST["table"];


        if($table == "actor" || $table == "director") {

            $input = strtolower($input);
            

            $input = explode(" ", $input);

            if(count($input) == 1) {
                $sql = "SELECT ID
                FROM $table
                WHERE firstName LIKE '%$input[0]%' OR lastName LIKE '%$input[0]%';";

                echo $sql;

                $res = $connection->query($sql);

                if($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $sql = "SELECT title
                        FROM Movie
                        WHERE $table" ."ID"." = " . $row["ID"] . ";";
                        

                        $res2 = $connection->query($sql);
                        
                        if($row1 = $res2->num_rows > 0) {
                            

                            while($row1 = $res2->fetch_assoc()) {
                                echo "<tr><td>".$row1["title"]."</td></tr>";
                            }
                        }

                        if($table == "actor") {

                            $sql = "SELECT title
                            FROM Tv_Series
                            WHERE $table" ."ID"." = " . $row["ID"] . ";";

                            echo $sql;

                            $res3 = $connection->query($sql); 


                            if($row2 = $res3->num_rows > 0) {
                                while($row2 = $res3->fetch_assoc()) {
                                    echo "<tr><td>".$row2["title"]."</td></tr>";

                                }
                            }
                        }
                    }
                }
            }
            if(count($input) > 1) {
                $sql = "SELECT ID
                FROM $table
                WHERE firstName LIKE '%$input[0]%' OR lastName LIKE '%$input[1]%';";

                echo $sql;

                $res = $connection->query($sql);

                if($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $sql = "SELECT title
                        FROM Movie
                        WHERE $table" ."ID"." = " . $row["ID"] . ";";
                        

                        $res2 = $connection->query($sql);
                        
                        if($row1 = $res2->num_rows > 0) {
                            

                            while($row1 = $res2->fetch_assoc()) {
                                echo "<tr><td>".$row1["title"]."</td></tr>";
                            }
                        }

                        if($table == "actor") {

                            $sql = "SELECT title
                            FROM Tv_Series
                            WHERE $table" ."ID"." = " . $row["ID"] . ";";

                            echo $sql;

                            $res3 = $connection->query($sql); 


                            if($row2 = $res3->num_rows > 0) {
                                while($row2 = $res3->fetch_assoc()) {
                                    echo "<tr><td>".$row2["title"]."</td></tr>";

                                }
                            }
                        }
                    }
                }
            }
        }
        if($table == "movie") {
            $sql = "SELECT title
            FROM Movie
            WHERE title LIKE '%$input%';";

            $res = $connection->query($sql);

            if($row = $res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<tr><td>".$row["title"]."</td></tr>";

                }
            }
        }
        if($table == "tv_series") {
            $sql = "SELECT title
            FROM Tv_Series
            WHERE title LIKE '%$input%';";

            $res = $connection->query($sql);

            if($row = $res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<tr><td>".$row["title"]."</td></tr>";

                }
            }
        }
        if($table == "tv_episode") {
            $sql = "SELECT title
            FROM Tv_Episode
            WHERE title LIKE '%$input%';";

            $res = $connection->query($sql);

            if($row = $res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<tr><td>".$row["title"]."</td></tr>";

                }
            }
        }
        if($table == "genre") {
            $sql = "SELECT ID
            FROM genre
            WHERE genre LIKE '%$input%';";

            echo $sql;
            $res = $connection->query($sql);

            if($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $sql = "SELECT title
                    FROM Movie
                    WHERE genreID"." = " . $row["ID"] . ";";
                        

                    $res2 = $connection->query($sql);
                        
                    if($row1 = $res2->num_rows > 0) {
                            

                        while($row1 = $res2->fetch_assoc()) {
                            echo "<tr><td>".$row1["title"]."</td></tr>";   
                        }
                    }
                }
            }
        }
    }
    ?>
    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>