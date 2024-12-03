<?php
session_start();
if (!isset($_SESSION['User'])) {
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer</title>
    <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }
        .input-field {
            border: none;
            border-bottom: 1px solid #aaa;
            background-color: transparent;
            padding: 5px;
            font-size: 16px;
            transition: border-bottom-color 0.3s;
            width: 100%;
        }
        .input-field:focus {
            outline: none;
            border-bottom-color: #007bff;
        }
        .styled-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .styled-button:hover {
            background-color: #0056b3;
        }
        h1 {
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
    <script>
        function openPrintPalette() {
            window.print();
        }
    </script>
</head>
<body class="a">
<h1>CUSTOMER</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <table cellspacing="5" cellpadding="5" align="center">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Milk Type</th>
        </tr>
        <tr>
            <?php
            // Fetch the next customer ID
            $mysql = mysqli_connect("localhost", "root", "", "dairy");
            $result2 = mysqli_query($mysql, "SELECT MAX(ssn) FROM customer");
            $array = mysqli_fetch_row($result2);
            $next_ssn = $array[0] + 1;
            mysqli_close($mysql);
            ?>
            <td align="center">
                <input type="text" name="ssn" id="ssn" value="<?php echo $next_ssn; ?>" size="20" readonly />
            </td>
            <td><input type="text" name="name" id="name" size="20" class="input-field" required /></td>
            <td><input type="text" name="address" id="address" size="20" class="input-field" required /></td>
            <td>
                <select name="mtype" class="input-field">
                    <option>Buffalo</option>
                    <option>Cow</option>
                </select>
            </td>
        </tr>
        <tr align="center">
            <td colspan="4">
                <a href="index.php" class="styled-button">Back</a>
                <input type="submit" value="Insert" class="styled-button" />
                <input type="reset" value="Reset" class="styled-button" />
                <button type="button" onclick="openPrintPalette()">Print</button>
            </td>
        </tr>
    </table>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysql = mysqli_connect("localhost", "root", "", "dairy");
    if (!$mysql) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST["name"];
    $address = $_POST["address"];
    $mtype = $_POST["mtype"];

    if (empty($name) || empty($address)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        $stmt = $mysql->prepare("INSERT INTO customer (name, address, type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $address, $mtype);

        if ($stmt->execute()) {
            echo "<script>alert('Record added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding record: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }
    mysqli_close($mysql);
}
?>
<table border="1" cellspacing="5" cellpadding="5" align="center">
    <tr>
        <th>Customer No.</th>
        <th>Name</th>
        <th>Address</th>
        <th>Milk Type</th>
    </tr>
    <?php
    $mysql = mysqli_connect("localhost", "root", "", "dairy");
    $result3 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY ssn DESC");
    while ($array = mysqli_fetch_row($result3)) {
        echo "<tr>";
        echo "<td>$array[0]</td>";
        echo "<td>$array[1]</td>";
        echo "<td>$array[2]</td>";
        echo "<td>$array[3]</td>";
        echo "</tr>";
    }
    mysqli_free_result($result3);
    mysqli_close($mysql);
    ?>
</table>
</body>
</html>
