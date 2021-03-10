<?php
include "includes/vendor_session.php";
include("includes/database.php");
$vendorid = $_SESSION["vendorid"]; // USE SESSIONS
$approvedrows = mysqlidb::fetchAllRows("SELECT * FROM refund
INNER JOIN product ON refund.ProductId = product.ProductId
INNER JOIN orderitem ON refund.OrderId = orderitem.OrderId
INNER JOIN productorder ON refund.OrderId = productorder.OrderId
WHERE RefundStatus = 'Approved'
AND VendorId = $vendorid
AND OrderStatus = 'Refund'
GROUP BY product.ProductId, productorder.OrderId
ORDER BY DateRequested Desc
LIMIT 10");
$pendingrows = mysqlidb::fetchAllRows("SELECT * FROM refund
INNER JOIN product ON refund.ProductId = product.ProductId
WHERE RefundStatus = 'Pending'
AND VendorId = $vendorid
ORDER BY DateRequested Desc");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link rel="stylesheet" href="styles/template.css" />
  <link rel="stylesheet" href="styles/vendor.css" />
  <link rel="stylesheet" href="styles/pagetopbar.css" />
  <title>Chapalang Clothes</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <div class="vendor-container">
        <?php
        include("includes/vendor_sidenav.php");
        ?>
        <div class="vendor-body">
          <h3>Pending Refund</h3>
          <hr>

          <table>
            <tr>
              <th width="15%">Order ID</th>
              <th width="20%">Product Name</th>
              <th width="15%">Date Requested</th>
              <th width="35%">Detail</th>
              <th width="15%">Action</th>
            </tr>
            <?php
            if (count($pendingrows) > 0) {
              foreach ($pendingrows as $row) {
                echo "
                <tr>
                  <td>{$row['OrderId']}</td>
                  <td>{$row['ProductName']}</td>
                  <td>{$row['DateRequested']}</td>
                  <td>{$row['Reason']}</td>
                  <td><a href=\"vendor_refund_ticket.php?productid={$row['ProductId']}&orderid={$row['OrderId']}\" class=\"btn-primary p-1 visited-white\">View Ticket</td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan=\"5\"><h2 class=\"cultured-dark\">There are no pending refunds.</h2></td></tr>";
            }

            ?>
          </table>

          <br>

          <h3>Approved Refund</h3>
          <hr>

          <table>
            <tr>
              <th width="15%">Order ID</th>
              <th width="20%">Product Name</th>
              <th width="15%">Date Requested</th>
              <th width="50%">Detail</th>
            </tr>
            <?php
            if (count($approvedrows) > 0) {
              foreach ($approvedrows as $row) {
                echo "
                <tr>
                  <td>{$row['OrderId']}</td>
                  <td>{$row['ProductName']}</td>
                  <td>{$row['DateRequested']}</td>
                  <td>{$row['Reason']}</td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan=\"5\"><h2 class=\"cultured-dark\">There are no approved refunds.</h2></td></tr>";
            }

            ?>
          </table>
          <br><br>
        </div>
      </div>
    </div>
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footeremployee.html" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/vendor_page.js"></script>

</html>