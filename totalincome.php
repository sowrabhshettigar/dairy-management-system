
<!DOCTYPE html>
<html>
<head>
    <title>Income Report</title>
    <style>
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

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
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

<h1>INCOME REPORT</h1><br><br><br>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="fromDate">From Date:</label>
    <input type="date" id="fromDate" name="fromDate">

    <label for="toDate">To Date:</label>
    <input type="date" id="toDate" name="toDate">

    <button type="submit">Calculate</button>
    
    <button class="back" ><a href="index.php">Back</a></button>
    <button onclick="openPrintPalette()">Print</button>
</form>

<table>
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>User ID</th>
        <th>Total</th>
    </tr>

    
<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dairy";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromDate = $_POST["fromDate"];
    $toDate = $_POST["toDate"];

    // Fetch data from database based on selected date range
    $sql = "SELECT * FROM collection WHERE date BETWEEN '$fromDate' AND '$toDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            if($row["total"] >0 )
            {
            echo "<tr>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["ssn"] . "</td>";
            echo "<td>" . $row["total"] . "</td>";
            echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='8'>0 results</td></tr>";
    }

    // Calculate overall income
    $sql = "SELECT SUM(total) AS overall_income FROM collection WHERE date BETWEEN '$fromDate' AND '$toDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<tr><td colspan='4'><h2><center>Total Income :   " . $row["overall_income"] . "</center></h2></td></tr>";
    } else {
        echo "<tr><td colspan='3'>Total Income: 0</td></tr>";
    }
}

// Close connection
$conn->close();
?>
</table>

</body>
</html>



























<!-- <!DOCTYPE html>
<html>
<head>
    <title>Calculate Overall Income</title>
</head>
<body>

<h2>Select Date Intervals to Calculate Overall Income</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="fromDate">From Date:</label>
    <input type="date" id="fromDate" name="fromDate">

    <label for="toDate">To Date:</label>
    <input type="date" id="toDate" name="toDate">

    <button type="submit">Calculate</button>
</form>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>SSN</th>
        <th>Type</th>
        <th>Qty</th>
        <th>Fat</th>
        <th>Rate</th>
        <th>Total</th>
    </tr>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dairy";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromDate = $_POST["fromDate"];
    $toDate = $_POST["toDate"];

    // Fetch data from database based on selected date range
    $sql = "SELECT * FROM collection WHERE date BETWEEN '$fromDate' AND '$toDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["ssn"] . "</td>";
            echo "<td>" . $row["type"] . "</td>";
            echo "<td>" . $row["qty"] . "</td>";
            echo "<td>" . $row["fat"] . "</td>";
            echo "<td>" . $row["rate"] . "</td>";
            echo "<td>" . $row["total"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>0 results</td></tr>";
    }

    // Calculate overall income
    $sql = "SELECT SUM(total) AS overall_income FROM collection WHERE date BETWEEN '$fromDate' AND '$toDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<tr><td colspan='7'>Total Income:</td><td>" . $row["overall_income"] . "</td></tr>";
    } else {
        echo "<tr><td colspan='8'>Total Income: 0</td></tr>";
    }
}

// Close connection
$conn->close();
?>

</table>

</body>
</html>
 -->