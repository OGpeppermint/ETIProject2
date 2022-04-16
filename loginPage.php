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
	
    #To build the login page for my site I used this tutorial (https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php). 
    #Due to the that fact, my code reuses a fair amount of logic and and statements found in the tutorial,
    #though it's still modified to work with my code using my variables and database.
    #this use was given the ok by Dr. Raahemifar
	
    session_start();

    if(isset($_SESSION["li"]) && ($_SESSION["li"] === true)) {
        header("location: home.php");
        exit;
    }

    require_once "login.php";

    $username = "";
    $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = $_POST["email"];

        $password = $_POST["password"];
        
        $sql = "SELECT ID, email, password FROM User
    WHERE email = ?";

        if($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $p_email);
        
            $p_email = $email;

            if($stmt->execute()) {
                $stmt->store_result();

                if($stmt->num_rows == 1) {
                    $stmt->bind_result($ID, $email, $iPass);
                }

                if($stmt->fetch()) {
                    if($password == $iPass) {
                        session_start();

                        $_SESSION["li"] = true;
                        $_SESSION["ID"] = $ID;
                        $_SESSION["email"] = $email;
                        
                        header("location: profile.php");
                    }
                }
            }
        }
    }
    ?>
    <form method="post">
			<label for='email'>Email </label><br>
			<input type='text' name='email'/><br>
			<label for='password'>Password </label><br>
			<input type='text' name='password'/><br>
			<input type='submit' value='Submit'/>
	</form>
</body>
</html>
