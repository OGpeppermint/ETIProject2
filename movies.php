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

    require_once "login.php";

    $sql = "SELECT m.title, m.runtime, m.releaseDate, g.genre 
    FROM Movie m
    LEFT JOIN genre g on m.genreID = g.ID";

        

    $res = $connection->query($sql);

    if($res->num_rows > 0) {
        echo "<table><tr><th>Title</th>
        <th>Runtime</th>
        <th>Release Date</th>
        <th>Genre</th></tr>";

        while($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row["title"]."</td>
            <td>".$row["runtime"]."</td>
            <td>".$row["releaseDate"]."</td>
            <td>".$row["genre"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "none";
    }
    ?>
    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>