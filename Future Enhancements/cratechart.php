<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Account</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
         </style>
    </head>
    <body class="a">
        <h3><a href="index.php">HOME</a></h3>
        <?php
        $mysql = mysqli_connect("localhost", "root", "");
        mysqli_select_db($mysql, "dairy");
        ?>
        <h1 align="center">ADD COW RATE CHART</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <table border="1" cellspacing="5" cellpadding="5" align="center">
                <tr><th>Cow Fat</th><th>Cow Rate</th></tr>
                <tr>
                    <td><input type="text" name="cfat" id="cfat" size="20" maxlength="20"/></td>
                    <td><input type="text" name="crate" id="crate" size="20"/></td>
                </tr>
                <tr align="center">
                    <td colspan="4">
                        <input style="background-color: orange" type="submit" value="Insert" size="5"/>
                        <input style="background-color: orange" type="reset" value="Cancel" size="5"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $cfat = $_POST["cfat"];
            $crate = $_POST["crate"];
            if ($cfat && $crate) {
                mysqli_query($mysql, "INSERT INTO cratechart VALUES('$cfat','$crate')");
            }
        }
        ?>
        <table border="1" cellspacing="5" cellpadding="5" align="center">
            <caption><strong>COW-FAT-n-RATE-CHART-DETAILS</strong></caption>
            <tr><th>COW FAT</th><th>COW RATE</th></tr>
            <?php
            $result3 = mysqli_query($mysql, "SELECT * FROM cratechart ORDER BY cfat");
            while ($array = mysqli_fetch_row($result3)) {
                print"<tr align='center'>";
                print"<td> $array[0]</td>";
                print"<td> $array[1]</td>";
                print"</tr>";
            }
            mysqli_free_result($result3);
            mysqli_close($mysql);
            ?>
        </table>
    </body>
</html>
