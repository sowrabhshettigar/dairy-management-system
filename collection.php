<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Milk Collection</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }button {
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

    
    h2,h1 {
            text-align: center;
            margin-bottom: 20px;
        }

    </style>

<script>
    function redirectToIndex() {
    window.location.replace("localhost/dairy_management_system/index.html");
}


    function openPrintPalette() {
        window.print();
    }
            document.getElementById('date').value = Date();
        </script>
    </head>
    <body class="a">
        <?php
        $mysql = mysqli_connect("localhost", "root", "");
        mysqli_select_db($mysql, "dairy");
        ?>

        <h1 align="center">DAILY MILK COLLECTION</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <table  cellspacing="5" cellpadding="5" align="center">
                <tr align="center"><th>DATE</th><th>TIME</th><th>CUSTOMER ID</th><th>QTY/LTR</th><th>FAT</th></tr>
                <tr align="center">
                    <td><input type="date" name="date" id="date"/></td>
                    <td><select name="time" id="time"><option>Morning</option><option>Evening</option></select></td>
                    <td><select name="ssn" id="ssn">
                        <?php
                        $result1 = mysqli_query($mysql, "SELECT * FROM customer");
                        while ($row = mysqli_fetch_assoc($result1)) {
                            print "<option>" . $row["ssn"] . "</option>";
                        }
                        mysqli_free_result($result1);
                        ?>
                        </select>
                    </td>
                    <td><input type="text" name="qty" id="qty"/></td>
                    <td><input type="text" name="fat" id="fat"/></td>
                </tr>
               <tr align="center"> <td colspan="5">
               <button class="back" ><a href="index.php">Back</a></button>
                <button onclick="openPrintPalette()">Print</button>
                <button type="submit" >Insert</button>
 
               </td></tr>
            </table>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $date = $_POST["date"];
            $time = $_POST["time"];
            $ssn = $_POST["ssn"];
            $qty = $_POST["qty"];
            $fat = $_POST["fat"];
            $total = 66;
            $rate = 45;

            $result2 = mysqli_query($mysql, "SELECT * FROM customer WHERE ssn = $ssn");
            while ($array = mysqli_fetch_row($result2)) {
                $type = $array[3];
            }
            mysqli_free_result($result2);

            if ($type == "Buffalo") {

                $result3 = mysqli_query($mysql, "SELECT * FROM bratechart WHERE bfat='$fat'");
                while ($array = mysqli_fetch_row($result3)) {
                    $rate = $array[1];
                }
                mysqli_free_result($result3);
            } else {
                $result4 = mysqli_query($mysql, "SELECT * FROM cratechart WHERE cfat='$fat'");
                while ($array = mysqli_fetch_row($result4)) {
                    $rate = $array[1];
                }
                mysqli_free_result($result4);
            }

            $total = $qty * $rate;

            if ($date && $time && $ssn && $type && $total) {
                mysqli_query($mysql, "INSERT INTO collection(`date`, `time`, `ssn`, `type`, `qty`, `fat`, `rate`, `total`)VALUES('$date','$time','$ssn','$type','$qty','$fat','$rate','$total')");
                
                // Update stock table
                mysqli_query($mysql, "UPDATE stock SET total_qty = total_qty + $qty");
            }
        }

        ?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    caption {
        font-weight: bold;
        margin-bottom: 10px;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>

<table cellspacing="5" cellpadding="5" align="center">
    <tr>
        <th>DATE</th>
        <th>TIME</th>
        <th>CUSTOMER ID</th>
        <th>MILK TYPE</th>
        <th>QTY/LTR</th>
        <th>FAT</th>
        <th>RATE</th>
        <th>TOTAL</th>
    </tr>
    <?php
    $result6 = mysqli_query($mysql, "SELECT * FROM collection");
    while ($array = mysqli_fetch_row($result6)) {
        echo "<tr>";
        echo "<td>$array[0]</td>";
        echo "<td>$array[1]</td>";
        echo "<td>$array[2]</td>";
        echo "<td>$array[3]</td>";
        echo "<td>$array[4]</td>";
        echo "<td>$array[5]</td>";
        echo "<td>$array[6]</td>";
        echo "<td>$array[7]</td>";
        echo "</tr>";
    }
    mysqli_free_result($result6);
    mysqli_close($mysql);
    ?>
</table>

        
    </body>
</html>
