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

    echo "<table><tr><th>Title</th><th>Format</th><th>Genre</th></tr>";

    require_once "login.php";




    $sql = "SELECT m.title, 'Film' AS Type, g.genre
    FROM My_Stuff ms
    INNER JOIN Movie m ON m.ID = ms.MovieID
    INNER JOIN genre g on m.genreID = g.ID
    WHERE profileID = " .$_SESSION["profileID"]. "
    
    UNION
    
    SELECT ts.title, 'Tv Show' AS Type, g.genre
    FROM My_Stuff ms
    INNER JOIN Tv_Series ts ON ts.ID = ms.Tv_SeriesID
    INNER JOIN genre g on ts.genreID = g.ID
    WHERE profileID = " .$_SESSION["profileID"]. "
    
    UNION
    
    SELECT te.title, 'Tv Episode' AS Type, g.genre
    FROM My_Stuff ms
    INNER JOIN Tv_Episode te ON te.ID = ms.Tv_EpisodeID
    INNER JOIN genre g on te.genreID = g.ID
    WHERE profileID = " .$_SESSION["profileID"]. ";";
    

    $res = $connection->query($sql);

    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row["title"]."</td>
            <td>".$row["Type"]."</td>
            <td>".$row["genre"]."</td></tr>";
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
