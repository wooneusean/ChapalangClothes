<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$productid = $_GET['productid'];
$rows = mysqlidb::fetchAllRows("SELECT COUNT(*) as TotalReports,report.ReportReason,product.* FROM report 
INNER JOIN product ON product.ProductId = report.ProductId 
WHERE report.ProductId=$productid GROUP BY report.ReportReason ORDER BY TotalReports DESC");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
    <link href="styles/template.css" type="text/css" rel="stylesheet">
    <link href="styles/pagetopbar.css" type="text/css" rel="stylesheet">
    <link href="styles/khor.css" type="text/css" rel="stylesheet">
    <title>Report Tickets</title>
</head>

<body>
    <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
    <?php include "includes/pagetopbaremployee.php" ?>
    <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
    <div class="body-wrapper">
        <div></div>
        <!-- ----------------------------------- BODY ----------------------------------- -->
        <div class="content-wrapper container">
            <h1>Product Reports</h1>
            <div class="employee-wrapper p-2">
                <?php include "includes/employee_sidenav.php" ?>
                <div class="card-generic">

                    <?php
                    $rows[0];
                    echo "<h1 class=\"m-0\">Reports for {$rows[0]['ProductName']}</h1>
                        <h3>This item has been reported for<h3> 
                        <ul>";
                    foreach ($rows as $row) {
                        if ($row['ReportReason'] == 'FalseAd') {
                            echo "<li>False Advertisement : $row[TotalReports] times</li>";
                        }
                        if ($row['ReportReason'] == 'Fake') {
                            echo "<li>Fake Item : $row[TotalReports] times</li>";
                        }
                        if ($row['ReportReason'] == 'InappropriateName') {
                            echo "<li>Innappropriate Name : $row[TotalReports] times</li>";
                        }
                        if ($row['ReportReason'] == 'InappropriatePicture') {
                            echo "<li>Inappropriate Picture : $row[TotalReports] times</li>";
                        }
                    }
                    echo " </ul><div class=\"margin-y\">
                        <a href=\"product_reports.php?productid={$rows[0]['ProductId']}&action=blacklist\" class=\"btn-primary p-1 m-1 visited-white\">Blacklist Product</a>
                        <a href=\"product_reports.php?productid={$rows[0]['ProductId']}&action=ignore\" class=\"btn-primary p-1 m-1 visited-white\">Clear Reports</a>
                        </div>
                        ";
                    ?>

                </div>
            </div>
        </div>
        <!-- ----------------------------------- BODY ----------------------------------- -->

        <!-- ----------------------------------- FOOTER ----------------------------------- -->
        <?php include "includes/footeremployee.html" ?>
        <!-- -----------------------------------FOOTER----------------------------------- -->
    </div>
</body>
<script src="scripts/main.js"></script>
<script src="scripts/employee_sidenav.js"></script>

</html>