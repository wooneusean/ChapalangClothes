<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$rows = mysqlidb::fetchAllRows("SELECT * FROM `refund` WHERE RefundStatus = 'Denied' ORDER BY DateRequested ASC LIMIT 10");


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
  <title>Product Refunds</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>Product Refunds</h1>
      <div class="employee-wrapper p-2">
        <?php include "includes/employee_sidenav.php" ?>
        <table class="employee-table bg-white">
          <tr>
            <th class="employee-table-header-tl" width="10%">OrderID</th>
            <th width="10%">ProductID</th>
            <th width="40%">Details</th>
            <th width="20%">Date Requested</th>
            <th class="employee-table-header-tr" width="20%">Action</th>
          </tr>
          <?php
          if (count($rows) > 0) {
            foreach ($rows as $row) {
              echo "<tr>
                        <td width=\"25%\" class=\"pad-sides\">{$row['OrderId']}</td>
                        <td width=\"25%\" class=\"pad-sides\">{$row['ProductId']}</td>
                        <td width=\"25%\" class=\"pad-sides\">{$row['Reason']}</td>
                        <td width=\"25%\" class=\"pad-sides\">{$row['DateRequested']}</td>
                        <td width=\"25%\" class=\"pad-sides\">
                            <a href=\"employee_refunds_detail.php?productid={$row['ProductId']}&refundid={$row['RefundId']}\" class=\"btn-primary p-1 m-1 visited-white\">View Ticket</a>
                            </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan=\"5\"><h2 class=\"cultured-dark\">There are no product refunds.</h2></td></tr>";
          }

          ?>
        </table>
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