<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dairy Billing System</title>
    <link href="../css/public.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Add custom CSS for navigation */
        #navigation ul {
            list-style-type: none; /* Remove bullets */
            padding-left: 0;
        }
        #navigation li a i {
            margin-right: 5px;
        }
    </style>
</head>
<body bgcolor="#FFFF66">
<div id="header">
    <h1>DMS</h1>
</div>
<div id="main">
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
    <table id="structure">
        <tr>
            <td id="navigation">
                <ul>
                    <li class="last"><a href="customer.php"><i class="fas fa-user-plus"></i> Add Customer</a></li> <br>
                    <!--<li class="last"><a href="bratechart.php">Add Buffalo Rate Chart</a></li><br/>
                    <li class="last"><a href="cratechart.php">Add Cow Rate Chart</a></li><br/>
                    --><li class="last"><a href="collection.php"><i class="fas fa-shopping-cart"></i> Milk Collection</a></li> <br><br><br>


                <li class="last"><a href="export.php"><i class="fas fa-exchange-alt transfer-icon"></i> Export Milk</a></li> <br><br><br>

                  <!--<li class="last"><a href="allcustomerbill.php"><i class="fas fa-file-alt bill-icon"></i> Customer Bill</a></li><br/>
                    -->    <li class="last"><a href="singlecustomerbill.php"><i class="fas fa-file-alt bill-icon"></i> Customer Bill</a></li><br/>
                    <li class="last"><a href="getallcustomer.php"><i class="fas fa-file-alt"></i> Customer Report</a></li> <br>
                    <li class="last"><a href="totalincome.php"><i class="fas fa-file-alt"></i> Income Report</a></li><br/> <br><br>

        
                    <li class="last"><a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </td>
            <td id="page">
                <h2>DAIRY MANAGEMENT SYSTEM </h2>
                <img src="img/22.jpg" alt="" width="100%" height="100%"/>
            </td>
        </tr>
    </table>
</div>
<div id="footer" title="Designed & Developed by CRB"></div>
</body>
</html>
