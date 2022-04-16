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
        <label for="addtype">What Type of Content do You Want to Add to My Stuff</label></br>
        <select name="addType" id="addType">
            <option value="Movie">Movie</option>
            <option value="Tv_Series">Tv Show</option>
            <option value="Tv_Episode">Tv Episode</option>
        </select></br>
        <input type='submit' value='Submit'/>
    </form>
    <?php

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST["addType"];

        echo $_SESSION["addToMyStuffType"];

        $_SESSION["addToMyStuffType"] = $input;

        header("location: addToMyStuff.php");
    }

    ?>
    <form action="home.php">
    <input type="submit" value="Home"/>
    </form>
</body>
</html>