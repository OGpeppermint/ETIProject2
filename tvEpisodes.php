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


        require_once "login.php";

        $sql = "SELECT title
        FROM tv_series
        WHERE ID = ".$_SESSION["seriesID"].";";

        $res = $connection->query($sql);

        if($res->num_rows > 0) {;

            while($row = $res->fetch_assoc()) {
                echo "<b>".$row["title"]."</b></br>";
            }

        } else {
            echo "none";
        }

        $sql = "SELECT seasonNum
        FROM tv_season
        WHERE ID = ".$_SESSION["seasonID"].";";

        $res = $connection->query($sql);

        if($res->num_rows > 0) {;

            while($row = $res->fetch_assoc()) {
                echo "<b>Season ".$row["seasonNum"]."</b>";
            }

        } else {
            echo "none";
        }

        $sql = "SELECT t.episodeNum, t.title, t.runtime, t.airDate, g.genre
        FROM tv_episode t
        LEFT JOIN genre g ON t.genreID = g.ID
        WHERE t.seasonID = ".$_SESSION["seasonID"].";";

        $res = $connection->query($sql);

        if($res->num_rows > 0) {
            echo "<table><tr><th>Episode Number</th>
            <th>Title</th>
            <th>Runtime(in minutes)</th>
            <th>Air Date</th>
            <th>Genre</th></tr>";

            while($row = $res->fetch_assoc()) {
                echo "<tr><td>".$row["episodeNum"]."</td>
                <td>".$row["title"]."</td>
                <td>".$row["runtime"]."</td>
                <td>".$row["airDate"]."</td>
                <td>".$row["genre"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "none";
        }
    ?>
    <form action="tvSeasons.php">
    <input type="submit" value="Back"/>
    </form>
    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>