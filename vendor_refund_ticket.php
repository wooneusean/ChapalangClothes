<?php
include "includes/vendor_session.php";
include("includes/database.php");
$rows = mysqlidb::fetchAllRows("SELECT * FROM refund
INNER JOIN productorder ON refund.OrderId = productorder.OrderId
INNER JOIN product ON refund.ProductId = product.ProductId
INNER JOIN user ON user.UserId = productorder.UserId
WHERE refund.RefundStatus = 'Pending' AND product.ProductId = '$_GET[productid]' AND productorder.OrderId = '$_GET[orderid]'");
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
          <?php
          foreach ($rows as $row) {
            echo "<div class=\"productdetails\">
            <h1 class=\"m-0\">Refund Details for {$rows[0]['ProductName']}</h1>
            <hr>
            <h3>Refund ID : $row[RefundId]</h3>
            <h3>Order ID : $row[OrderId]</h3>
            <h3>Product ID : $row[ProductId]</h3>
            <h3>Customer Name : $row[Username]</h3>
            <h3>Customer Address : $row[Address]</h3>
            <h3>Order Total : RM $row[OrderTotal]</h3>
            <h3>Refund Reason : $row[Reason]</h3>
            <h3>Customer Image : </h3>
            <br>
            <div class=\"vendor-product-image\"><img src=\"$row[Images]\"></div>
            <br>
            </div>
            ";
          }
          echo "
            <a href=\"vendor_refund_approval.php?refundid={$rows[0]['RefundId']}&orderid={$rows[0]['OrderId']}&action=approve\" class=\"btn-primary p-1 m-1 visited-white\">Approve Refund</a>
            <a href=\"vendor_refund_approval.php?refundid={$rows[0]['RefundId']}&orderid={$rows[0]['OrderId']}&action=deny\" class=\"btn-primary p-1 m-1 visited-white\">Deny Refund</a>
            </div>
            ";
          ?>
          <br>
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
<script src="scripts/main.js"></script>

</html>