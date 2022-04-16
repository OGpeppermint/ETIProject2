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
        FROM " .$_SESSION["addToMyStuffType"].
        ";";

        $res = $connection->query($sql);


    ?>
    <form method = "post">
        <label for='add'>Add to My Stuff</label><br>
        <select name = "add" id = "add">
        <?php while($row = $res->fetch_assoc()) { ?>
            <option value = "<?php echo $row["ID"];?>"><?php echo $row["title"];?></option>
            <?php } ?>
        </select></br>
        <input type='submit' value='Submit'/>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST["add"];

            $sql = "INSERT INTO My_Stuff (profileID, " .$_SESSION["addToMyStuffType"]. "ID)
            Values (" .$_SESSION["profileID"]. ", $input);";

            $connection->query($sql);

            header("location: myStuff.php");
        }
    ?>

    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>