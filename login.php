<?php
    // Clear login data
    session_start();
    // remove all session variables
    session_unset(); 
    // destroy the session 
    session_destroy(); 
    // Start session again
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>User Login</title>
    <style>
        .ip{
            border-radius : 10px;
        }
        .heading{
            color : #6CB4EE;
        }
        .a {
            background-image: url(img/loginBg.png);
            background-size : stretch;
        }

        .aa {
            width: 300px;
            margin: auto;
            position: absolute;
            top: 80px;
            right: 400px;
            background: rgba(255, 255, 255, 0.8); /* Add some transparency for better readability */
            padding: 20px;
            border-radius: 10px;
        }

        .aa h1 {
            text-align: center;
        }

        .aa form {
            text-align: center;
        }

        .aa input[type="text"],
        .aa input[type="password"] {
            width: calc(100% - 22px); /* Adjusting width to accommodate the padding and border */
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #89CFF0; /* Adding border with specified color */
            border-radius: 5px; /* Adding border-radius for rounded corners */
        }


        .aa input[type="submit"],
        .aa input[type="reset"] {
            background-color : #6CB4EE;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body class="a">
<div class="aa">
    <h1 class="heading" >Staff Login</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p><input class="ip" type="text" name="user" placeholder="Enter Username"/></p>
        <p><input class="ip" type="password" name="password" placeholder="Enter Password"/></p>
        <p><input class="ip" type="submit" value="Login"/> <input type="reset" value="Clear"/></p>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];

    if ($user && $password) {

        $mysql = mysqli_connect("localhost", "root", "");
        mysqli_select_db($mysql, "dairy");

        $result1 = mysqli_query($mysql, "SELECT * FROM login WHERE user='$user' and password='$password'");
        $count = mysqli_num_rows($result1);
        mysqli_free_result($result1);
        if ($count == 1) {
            $_SESSION['User'] = $user;
            header("location:index.php");
        } else {
            echo '<script type="text/javascript">alert("Wrong username or password");</script>';

        }
    }
}
?>
</body>
</html>
