<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Customer Information</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
            button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
        .back a {
        color: white; /* Set font color to white */
        text-decoration: none; /* Remove underline */
    }
         </style>
         
<script>
    function redirectToIndex() {
    window.location.replace("localhost/dairy_management_system/index.html");
}


    function openPrintPalette() {
        window.print();
    }
</script>
    </head>
    <?php
    $mysql = mysqli_connect("localhost", "root", "");
    mysqli_select_db($mysql, "dairy");
    ?>
    <center>
        <FORM action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p> Enter Customer SSN:<input type="text" name="ssn"/> </p>
            <p> <input style="background-color: orange" type="submit" value="Get Info"/> </p>
            <center>
    <button class="back" ><a href="index.php">Back</a></button>
    <button onclick="openPrintPalette()">Print</button>
        </center>
        </FORM>
    </center>
    <body class="a">
        <table border="1" cellspacing="5" cellpadding="5" align="center">
            <caption><strong>INDIVIDUAL-CUSTOMER-DETAILS</strong></caption>
            <tr><th>SSN</th><th>Customer Name</th><th>Address</th><th>Milk Type</th></tr>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $ssn = $_POST["ssn"];

                $sql = "SELECT * FROM customer WHERE ssn = '$ssn'";

                $result1 = mysqli_query($mysql, $sql);
                while ($array = mysqli_fetch_row($result1)) {
                    print"<tr>";
                    print"<td> $array[0]</td>";
                    print"<td> $array[1]</td>";
                    print"<td> $array[2]</td>";
                    print"<td> $array[3]</td>";
                    print"</tr>";
                }
                mysqli_free_result($result1);
            }
            ?>
        </table>
        <h3><a href="index.php">Home</a></h3>
    </body>
</html>
