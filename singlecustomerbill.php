<?php
session_start();
if (!isset($_SESSION['User'])){
    header("location:login.php");
}

$mysql = mysqli_connect("localhost", "root", "");
mysqli_select_db($mysql, "dairy");
$grandtotal = 0;
?>
<!DOCTYPE Html>
<html>
    <head> <title> Print Customer Bill </title>  <style>
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





    body {
            font-family: Arial, sans-serif;
        }

        h2,h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
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
        
    <h1>CUSTOMER BILL</h1><br>

    <center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <p> 
        <label for="toDate">Select Customer ID:</label> 
        <select name="ssn" id="ssn"> 
            <?php
            $result1 = mysqli_query($mysql, "SELECT * FROM customer");
            while ($array = mysqli_fetch_row($result1)) {
                print "<option>" . $array[0] . "</option>";
            }
            mysqli_free_result($result1);
            ?> 
        </select> &nbsp; &nbsp;
        
        <label for="fromDate">From Date:</label> <input type="date" name="fromdate" id="fromdate"/> &nbsp; &nbsp;
        <label for="toDate">To Date:</label><input type="date" name="todate" id="todate"/> &nbsp; &nbsp;
        
        <button type="submit" name="submit">Generate</button> &nbsp; &nbsp;
        <button class="back"><a href="index.php">Back</a></button> &nbsp; &nbsp;
        <button onclick="openPrintPalette()">Print</button>
    </p>
</form>  

<br>
<center>
    <table border="border" cellspacing="1" cellpadding="1" align="center">
        <tr> <th>SL No</th> <th> CUSTOMER ID</th> <th>CUSTOMER NAME</th> <th>MILK TYPE</th> <th>TOTAL MILK in LTR</th> <th>TOTAL RUPEES</th> 
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            $ssn = $_POST["ssn"];
            $fromdate = $_POST["fromdate"];
            $todate = $_POST["todate"];

           
            if ($ssn && $fromdate && $todate) {
                $presult = mysqli_query($mysql, "SELECT name, ssn, type, SUM(qty), SUM(total) FROM viewbill WHERE ssn = '" . $ssn . "' AND date BETWEEN '" . $fromdate . "' AND '" . $todate . "'");
                $n = 1;
                $grandqty = 0;
                
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
    <!-- <center> <a href="javascript:window.print()" title="Print"> <b> Print </b> </a></center> -->
</body>
</html>