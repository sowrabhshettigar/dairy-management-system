<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Milk</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .milk-info, .export-form {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        input {
            padding: 8px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
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
<body>
    <div class="container">
    <h1 style="background-color: skyblue; width: 100%; margin: 0; padding: 20px 0; text-align: center;">EXPORT MILK</h1>
    <div class="milk-info">
        <h2>Total Liters of Milk Available: <span id="total-liters">
            <?php
                // Connect to database
                $conn = mysqli_connect('localhost', 'root', '', 'dairy');

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query to get total liters of milk from stock table
                $sql_stock = "SELECT total_qty FROM stock";
                $result_stock = mysqli_query($conn, $sql_stock);

                if (mysqli_num_rows($result_stock) > 0) {
                    $row_stock = mysqli_fetch_assoc($result_stock);
                    echo $row_stock['total_qty'];
                } else {
                    echo "0";
                }

                // Close connection
                mysqli_close($conn);
            ?>
        </span></h2>
    </div>
    <div class="export-form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="export-liters">Liters to Export:</label>
            <input type="number" id="export-liters" name="export_liters" min="0" required> <br>
            <label for="export-location">Export Location:</label>
            <input type="text" id="export-location" name="export_location" required> <br><br>
            <button type="submit">Export</button>
            <button class="back" ><a href="index.php">Back</a></button>
            <button onclick="openPrintPalette()">Print</button>
        </form>
    </div>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to database
        $conn = mysqli_connect('localhost', 'root', '', 'dairy');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get export data from form
        $export_liters = $_POST['export_liters'];
        $export_location = $_POST['export_location'];
        $export_date = date("Y-m-d");

        // Query to get total liters of milk from stock table
        $sql_stock = "SELECT total_qty FROM stock";
        $result_stock = mysqli_query($conn, $sql_stock);
        $row_stock = mysqli_fetch_assoc($result_stock);
        $total_liters_available = $row_stock['total_qty'];

        // Check if export quantity is valid
        if ($export_liters < 0 || $export_liters > $total_liters_available) {
            echo "<script>alert('Invalid quantity to export. Please enter a valid quantity.')</script>";
        } else {
            // Deduct exported liters from total
            $sql_deduct = "UPDATE stock SET total_qty = total_qty - $export_liters";
            mysqli_query($conn, $sql_deduct);

            // Add export details to new table
            $sql_insert = "INSERT INTO export (liters, location, date) VALUES ($export_liters, '$export_location', '$export_date')";
            mysqli_query($conn, $sql_insert);

            // Close connection
            mysqli_close($conn);
            
            // Refresh page to update total liters
            echo "<meta http-equiv='refresh' content='0'>";
            echo "<script>alert('Successfully Exported ".$export_liters." ltrs of milk to ".$export_location."')</script>";
    
        }
    }
?>
</body>
</html>
