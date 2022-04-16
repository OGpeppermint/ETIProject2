<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    session_start();

    echo "<table><tr><th>Title</th></tr>";

    require_once "login.php";


    $sql = "SELECT m.title
    FROM My_Stuff ms
    LEFT JOIN Movie m ON m.ID = ms.MovieID
    WHERE profileID = " .$_SESSION["profileID"]. ";";

    $res = $connection->query($sql);

    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row["title"]."</td></tr>";
        }
    }

    $sql = "SELECT ts.title
    FROM My_Stuff ms
    LEFT JOIN Tv_Series ts ON ts.ID = ms.Tv_SeriesID
    WHERE profileID = " .$_SESSION["profileID"]. ";";

    $res = $connection->query($sql);

    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row["title"]."</td></tr>";
        }
    }

    $sql = "SELECT te.title
    FROM My_Stuff ms
    LEFT JOIN Tv_Episode te ON te.ID = ms.Tv_EpisodeID
    WHERE profileID = " .$_SESSION["profileID"]. ";";

    $res = $connection->query($sql);

    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row["title"]."</td></tr>";
        }
    }
    ?>

    <form action="addToMyStuffTypeSelect.php">
    <input type="submit" value="Add to My Stuff"/>
    </form>
    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>