<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$rows = mysqlidb::fetchAllRows("SELECT * FROM refund
INNER JOIN productorder ON refund.OrderId = productorder.OrderId
INNER JOIN product ON refund.ProductId = product.ProductId
INNER JOIN user ON user.UserId = productorder.UserId
WHERE refund.RefundStatus = 'Denied' AND refund.RefundId = '$_GET[refundid]' AND refund.ProductID = '$_GET[productid]'");


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
  <title>Refund Details</title>
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
        <div class="card-generic">

          <?php
          $rows[0];
          echo "<h1 class=\"m-0\">Refund Details for {$rows[0]['ProductName']}</h1>";
          foreach ($rows as $row) {
            echo "<h3>RefundID : $row[RefundId]</h3>
                <h3>OrderID : $row[OrderId]</h3>
                <h3>ProductID : $row[ProductId]</h3>
                <h3>Customer Name : $row[ProductName]</h3>
                <h3>Customer Address : $row[Address]</h3>
                <h3>Order Total : RM $row[OrderTotal]</h3>
                <br>
                <h3>Refund Reason : $row[Reason]</h3>
                <h3>Customer Image : </h3>
                <br>
                <div class=\"employee-refund-ticket-image\"><img src=\"$row[Images]\"></div>
                <br>
                ";
          }
          echo "<div class=\"margin-y\">
              <a href=\"product_refund.php?refundid={$rows[0]['RefundId']}&orderid={$rows[0]['OrderId']}&productid={$rows[0]['ProductId']}&action=approve\" class=\"btn-primary p-1 m-1 visited-white\">Approve Refund</a>
              <a href=\"product_refund.php?refundid={$rows[0]['RefundId']}&orderid={$rows[0]['OrderId']}&productid={$rows[0]['ProductId']}&action=delete\" class=\"btn-primary p-1 m-1 visited-white\">Delete Refund</a>
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