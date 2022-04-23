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

        $sql = "SELECT ID, title
        FROM tv_series;";

        $res = $connection->query($sql);


    ?>
    <form method = "post">
        <label for='chooseShow'>Choose Tv Show</label><br>
        <select name = "chooseShow" id = "chooseShow">
        <?php while($row = $res->fetch_assoc()) { ?>
            <option value = "<?php echo $row["ID"];?>"><?php echo $row["title"];?></option>
            <?php } ?>
        </select>
        <input type='submit' value='Submit'/>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST["chooseShow"];

            $_SESSION["seriesID"] = $input;

            header("location: tvSeasons.php");
        }
    ?>
    <?php


        $sql = "SELECT t.title, t.numOfSeasons, g.genre 
        FROM Tv_Series t
        LEFT JOIN genre g on t.genreID = g.ID";

            

        $res = $connection->query($sql);

        if($res->num_rows > 0) {
            echo "<table><tr><th>Title</th>
            <th>Number Of Seasons</th>
            <th>Genre</th></tr>";

            while($row = $res->fetch_assoc()) {
                echo "<tr><td>".$row["title"]."</td>
                <td>".$row["numOfSeasons"]."</td>
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
