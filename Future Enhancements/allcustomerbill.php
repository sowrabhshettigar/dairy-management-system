<?php
session_start();
if (!isset($_SESSION['User'])){
    header("location:login.php");
}

$mysql = mysqli_connect("localhost", "root", "");
mysqli_select_db($mysql, "dairy");
?>
<!DOCTYPE html>
<html>
    <head>
        <title> PRINT BILL PAYMENT </title>
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

        input[type=date] {
            padding: 8px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
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
    <body class="a">
    <center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p> From Date: <input type="date" name="fromdate" id="fromdate"/>
                To Date: <input type="date" name="todate" id="todate"/>
                <!--<input style="background-color: orange" type="submit" name="submit" value="Generate"/>-->
                <button  type="submit" name="submit">Generate</button>

                <button class="back" ><a href="index.php">Back</a></button>
                <button onclick="openPrintPalette()">Print</button>
            </p>
    </center>
</form>
<center>

    <table border="border" cellspacing="1" cellpadding="1" align="center">
        <tr> <th>SL No</th> <th> CUSTOMER ID</th> <th>CUSTOMER NAME</th> <th>MILK TYPE</th> <th>TOTAL MILK in LTR</th> <th>TOTAL RUPEES</th> 
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $fromdate = $_POST["fromdate"];
            $todate = $_POST["todate"];

            echo '<h2 align="center">Bill Payent From ' . $fromdate . ' To ' . $todate . '</h2>';

            if ($fromdate && $todate) {
                $presult = mysqli_query($mysql, "SELECT name, ssn, type, SUM(qty), SUM(total) FROM viewbill WHERE date BETWEEN '" . $fromdate . "' AND '" . $todate . "' GROUP BY ssn");
                $n = 1;
                $grandqty = 0;
                $grandtotal = 0;
            }

            while ($array = mysqli_fetch_row($presult)) {
                print "<tr>";
                print "<td align='center'> $n </td>";
                print "<td align='center'> $array[1] </td>";
                print "<td align='center'> $array[0] </td>";
                print "<td align='center'> $array[2] </td>";
                print "<td align='center'> $array[3] </td>";
                print "<td align='center'> $array[4] </td>";
                print "</tr>";

                $n = $n + 1;
                $grandtotal = $grandtotal + $array[4];
            }
            mysqli_free_result($presult);
            mysqli_close($mysql); 
        }
        ?>
        <tr> <td colspan="5" align="right"> Grand Total Rupees </td> <td align="center"> <?php echo("$grandtotal") ?> </tr>
    </table>
    <br/>
</body>
</html> 

















