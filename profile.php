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

    $sql = "SELECT ID, name
    FROM profile
    WHERE userID = " .$_SESSION["ID"]. ";";


    $res = $connection->query($sql);

    ?>
    <form method = "post">
        <label for='profiles'>Choose Your Profile</label><br>
        <select name = "profiles" id = "profiles">
        <?php while($row = $res->fetch_assoc()) { ?>
            <option value = "<?php echo $row["ID"];?>"><?php echo $row["name"];?></option>
            <?php } ?>
        </select></br>
        <input type='submit' value='Submit'/>
    </form>

    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST["profiles"];

        $_SESSION["profileID"] = $input;

        header("location: home.php");
    }
    ?>
</body>
</html>