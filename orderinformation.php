<?php
include("includes/sessioncheck.php");
include_once("includes/database.php");

$userid = $_SESSION["userid"];
$orderid = $_GET["orderid"]; //USE GET

$rows = mysqlidb::fetchAllRows("SELECT *, (orderitem.productquantity * product.ProductPrice) AS ItemSubtotal FROM productorder 
INNER JOIN orderitem ON orderitem.OrderId = productorder.OrderId
INNER JOIN product ON product.ProductId = orderitem.ProductId
INNER JOIN user ON user.UserId = productorder.UserId 
INNER JOIN vendor ON vendor.VendorId = product.VendorId
WHERE user.UserId = $userid AND productorder.OrderId = $orderid");

$ordertotal = mysqlidb::fetchRow("SELECT SUM(OT.ItemSubtotal) AS OrderTotal FROM (
SELECT (orderitem.ProductQuantity * product.ProductPrice) AS ItemSubtotal FROM productorder
INNER JOIN orderitem ON orderitem.OrderId = productorder.OrderId
INNER JOIN product ON product.ProductId = orderitem.ProductId
INNER JOIN user ON user.UserId = productorder.UserId 
INNER JOIN vendor ON vendor.VendorId = product.VendorId
WHERE user.UserId = $userid AND productorder.OrderId = $orderid) OT");

$userinformation = mysqlidb::fetchRow("SELECT * FROM user WHERE userId = $userid");
$orderid = mysqlidb::fetchRow("SELECT * FROM productorder WHERE userId = $userid AND productorder.OrderId = $orderid");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link href="styles/template.css" type="text/css" rel="stylesheet">
  <link href="styles/khor.css" type="text/css" rel="stylesheet">
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <link href="styles/storetopbar.css" type="text/css" rel="stylesheet">
  <title>Order Information</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <div class="order-content-card margin-y">
        <div class="black">
          <h1 class="m-0"><i class="material-icons md-36 icons ruby">location_on</i> Delivery Address</h1>
        </div>
        <div class="order-content-card-grid">
          <?php
          echo "
                    <div class=\"black pad-sides\">
                        <h3 class=\"m-0\">$userinformation[Username]<br>
                        $userinformation[Email]</h3>
                    </div>
                    <div class=\"cultured-dark pad-sides\">
                        $userinformation[Address]
                    </div>
                    <div>
                        <h2><a class=\"ruby visited-ruby\" href=\"user_profile.php\">EDIT</a></h2>
                    </div>
                    ";
          ?>
        </div>
      </div>

      <div class="order-content-card margin-y">
        <div class="order-border-bottom flex">
          <h1 class="m-0"><i class="material-icons md-36 icons ruby">shopping_bag</i> Products Ordered</h1>
          <i class="material-icons md-48 icons ruby pad-sides">arrow_right_alt</i>
          <h3>OrderID : <?php echo "$orderid[OrderId]" ?></h3>
        </div>
        <div>
          <table class="orderinfo-table margin-y">
            <tr>
              <th width="10%">Item Image</th>
              <th width="25%">Item Name</th>
              <th width="15%">Shop Name</th>
              <th width="10%">Shipping Status</th>
              <th width="15%">Unit Price</th>
              <th width="10%">Quantity</th>
              <th width="15%">Item Subtotal</th>
            </tr>
            <?php
            foreach ($rows as $row) {
              $unitprice_format = number_format($row['ProductPrice'], 2);
              $itemsub_format = number_format($row['ItemSubtotal'], 2);
              $imgurl = explode(",", $row['ProductImage'])[0];
              echo "
                        <tr>
                            <td class=\"p-1\"><img src=\"$imgurl\"></td>
                            <td class=\"p-1\">$row[ProductName]</td>
                            <td class=\"p-1\">$row[ShopName]</td>
                            <td class=\"p-1\">$row[OrderStatus]</td>
                            <td class=\"p-1\">RM $unitprice_format</td>
                            <td class=\"p-1\">$row[ProductQuantity]</td>
                            <td class=\"p-1\">RM $itemsub_format</td>
                        </tr>
                        ";
            } ?>
            <tr>
              <th colspan="6" id="ordertotal">Order Total</th>
              <td><?php
                  $ordertotal_format = number_format($ordertotal['OrderTotal'], 2);
                  echo "RM $ordertotal_format" ?>
              </td>
            </tr>
            <tr>
              <th colspan="6" id="shipping">Shipping Fee + Tax</th>
              <td><?php
                  $shippingfee = $row['OrderTotal'] - $ordertotal['OrderTotal'];
                  $shippingfee_format = number_format($shippingfee, 2);
                  echo "RM $shippingfee_format" ?></td>
            </tr>
            <tr class="order-border-top">
              <th colspan="6" id="total">Total</th>
              <td><?php
                  $productordertotal_format = number_format($row['OrderTotal'], 2);
                  echo "RM $productordertotal_format" ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footer.php" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<?php include "includes/store_scripts.php"; ?>


</html>