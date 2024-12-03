<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Customer Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(img/5.jpg);
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
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
<body>
 <table>
        <caption><strong>CUSTOMER REPORT</strong></caption><br><br>
        <tr>
            <th>CUSTOMER ID</th>
            <th>CUSTOMER NAME</th>
            <th>ADDRESS</th>
            <th>MILK TYPE</th>
        </tr>
        <?php
            $mysql = mysqli_connect("localhost", "root", "");
            mysqli_select_db($mysql, "dairy");
            $sql = 'SELECT * FROM customer';
            $result1 = mysqli_query($mysql, $sql);
            while ($array = mysqli_fetch_row($result1)) {
                echo "<tr>";
                echo "<td>{$array[0]}</td>";
                echo "<td>{$array[1]}</td>";
                echo "<td>{$array[2]}</td>";
                echo "<td>{$array[3]}</td>";
                echo "</tr>";
            }
            mysqli_free_result($result1);
            mysqli_close($mysql);
        ?>
    </table>
       <center>
    <button class="back" ><a href="index.php">Back</a></button>
    <button onclick="openPrintPalette()">Print</button>
        </center>
</body>
</html>
