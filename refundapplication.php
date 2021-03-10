<?php

include("includes/sessioncheck.php");
include_once("includes/database.php");

$productid = $_GET['productid']; //USE GET
$orderid = $_GET['orderid']; //USE GET
$userid = $_SESSION['userid']; //USE SESSIONS

$row = mysqlidb::fetchRow("SELECT * FROM `productorder`
INNER JOIN orderitem ON orderitem.OrderId = productorder.OrderId
INNER JOIN `product` on orderitem.ProductId = product.ProductId 
INNER JOIN `vendor` on vendor.VendorId = product.VendorId 
WHERE orderitem.ProductId = $productid AND productorder.OrderId = $orderid AND productorder.UserId = $userid");

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
  <title>Refund Application</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div id="modal" class="modal hidden">
      <div class="modal-content center-in-page-abs modal-size">
        <div onclick="DismissModal()" class="material-icons modal-close-button white">close</div>
        <div class="modal-body modal-font modal-center">
          <div class="text-center m-0-a">
            Please attach an image to apply for the refund
          </div>
        </div>
      </div>
    </div>
    <div class="content-wrapper container bg-white p-2">
      <div class="refund-product-rows">
        <div class="refund-product-grid pad-bottom">
          <div class="refund-image">
            <?php
            $imgurl = explode(",", $row['ProductImage'])[0];
            echo "<img src=\"$imgurl\" alt=\"\" class=\"refund-product-grid-image\">"
            ?>
          </div>
          <div class="pad-sides refund-font">
            <div class="margin-sides pad-bottom">Product Name :<span class="pad-sides"><a href="item.php?id=<?php echo $row['ProductId'] ?>"><?php echo $row['ProductName'] ?></a></span></div>
            <div class="margin-sides pad-bottom">Shop Name :<span class="pad-sides"><?php echo $row['ShopName'] ?></span></div>
            <div class="margin-sides pad-bottom">Quantity :<span class="pad-sides"><?php echo $row['ProductQuantity'] ?></span></div>
            <div class="margin-sides pad-bottom">Price :<span class="pad-sides"><?php echo ('RM' . $row['ProductPrice']) ?></span></div>
            <div class="margin-sides pad-bottom">Date Purchased :<span class="pad-sides"><?php echo ($row['PurchaseDate']) ?></span></div>
          </div>
        </div>

        <div>
          <form action="refund_submission.php" method="POST" enctype="multipart/form-data" name="refund">
            <div class="refund-product-grid-bottom pad-bottom">
              <textarea name="refunddescrip" id="refunddescrip" placeholder="Enter refund / return reason here ..." required></textarea>
              <div class="pad-sides">
                <img class="refund-upload-image" id="output">
                <br>
                <label class="btn-primary p-1" for="file" style="cursor: pointer;">Upload Image</label>
                <input class="hidden" type="file" accept="image/*" name="image" id="file" required onchange="displayimage(event)">
              </div>
            </div>
            <input type="submit" value="SUBMIT" onclick="return valimage()">
            <input type="hidden" name="orderid" value="<?php echo $row['OrderId'] ?>">
            <input type="hidden" name="productid" value="<?php echo $row['ProductId'] ?>">
          </form>
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
<script src="scripts/khor.js"></script>
<?php include "includes/store_scripts.php"; ?>

</html>