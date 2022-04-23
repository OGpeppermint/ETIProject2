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
                echo "<b>".$row["title"]."</b>";
            }

        } else {
            echo "none";
        }


        $sql = "SELECT ID, seasonNum
        FROM tv_season
        WHERE tvID = ".$_SESSION["seriesID"].";";

        $res = $connection->query($sql);


    ?>
    <form method = "post">
        <label for='chooseSeason'>Choose Season</label><br>
        <select name = "chooseSeason" id = "chooseSeason">
        <?php while($row = $res->fetch_assoc()) { ?>
            <option value = "<?php echo $row["ID"];?>"><?php echo $row["seasonNum"];?></option>
            <?php } ?>
        </select>
        <input type='submit' value='Submit'/>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST["chooseSeason"];

            $_SESSION["seasonID"] = $input;

            header("location: tvEpisodes.php");
        }
    ?>
    <?php


        $sql = "SELECT seasonNum, numOfEpisodes
        FROM tv_season
        WHERE tvID = ".$_SESSION["seriesID"].";";

            

        $res = $connection->query($sql);

        if($res->num_rows > 0) {
            echo "<table><tr><th>Season Number</th>
            <th>Number Of Episodes</th></tr>";

            while($row = $res->fetch_assoc()) {
                echo "<tr><td>".$row["seasonNum"]."</td>
                <td>".$row["numOfEpisodes"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "none";
        }
    ?>
    <form action="tvShows.php">
    <input type="submit" value="Back"/>
    </form>
    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>