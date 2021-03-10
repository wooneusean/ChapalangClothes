<?php
include "includes/sessioncheck.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <title>Chapalang Clothes</title>
</head>

<body>

  <div class="content-wrapper container text-center card-generic center-in-page-abs">
    <?php
    if (isset($_POST['card_no']) && isset($_POST['card_exp']) && isset($_POST['card_secret']) && isset($_POST['card_holder'])) {
      if (!preg_match('/^\d{16}$/', $_POST['card_no']) || !preg_match('/^\d{2}\/\d{2}$/', $_POST['card_exp']) || !preg_match('/^\d{3}$/', $_POST['card_secret']) || empty($_POST['card_holder'])) {
        die(header("Location: error.php?error=cart"));
      }

      include_once "includes/database.php";

      $userId = $_SESSION["userid"];

      $cartItems = mysqlidb::fetchAllRows("SELECT vendor.ShopName,vendor.VendorId,product.ProductId,product.ProductName,product.ProductImage,product.ProductPrice,shopping_cart.CartQuantity,(product.ProductPrice * shopping_cart.CartQuantity) as ProductTotal FROM shopping_cart INNER JOIN product ON product.ProductId = shopping_cart.ProductId INNER JOIN vendor ON vendor.VendorId = product.VendorId WHERE shopping_cart.UserId=$userId");

      $dateToday = date('Y-m-d');

      $subtotalSum = 0;
      foreach ($cartItems as $item) {
        $subtotalSum += $item["ProductTotal"];
      }
      $shippingCost = 5 / 100 * $subtotalSum;
      $sst = 6 / 100 * ($subtotalSum + $shippingCost);

      // OrderTotal
      $orderTotal = $subtotalSum + $shippingCost + $sst;

      mysqlidb::query("INSERT INTO productorder(UserId,PurchaseDate,OrderTotal) VALUES ($userId,'$dateToday',$orderTotal)");

      $lastOrderId  = mysqlidb::lastInsertId();

      $orderQuery = "INSERT INTO 
        orderitem(OrderId,ProductId,ProductQuantity,OrderStatus)
        VALUES ";

      $i = 0;
      $len = count($cartItems);
      foreach ($cartItems as $item) {
        if ($i != $len - 1) {
          $orderQuery .= "($lastOrderId, {$item['ProductId']},{$item['CartQuantity']},'To Ship'),";
        } else {
          $orderQuery .= "($lastOrderId, {$item['ProductId']},{$item['CartQuantity']},'To Ship');";
        }
        $i++;
      }

      $stockQuery = "";
      foreach ($cartItems as $item) {
        $stockQuery .= "UPDATE product SET ProductStock=ProductStock-{$item['CartQuantity']} WHERE ProductId={$item['ProductId']};";
      }

      $balanceQuery = "";
      foreach ($cartItems as $item) {
        $balanceQuery .= "UPDATE vendor SET Balance=Balance+{$item['ProductTotal']} WHERE VendorId={$item['VendorId']};";
      }

      try {
        if (mysqlidb::query($orderQuery)) {
          if (mysqlidb::query("DELETE FROM shopping_cart WHERE UserId = $userId")) {
            mysqlidb::multiQuery($stockQuery);
            mysqlidb::multiQuery($balanceQuery);
            echo "<h1>Your order is successful! To see your purchase history, go to your <a class=\"ruby vis-ruby\" href=\"user_profile.php\">profile</a>.</h1><a class=\"vis-ruby\" href=\"index.php\"><h2>Return to home</h2></a>";
          } else {
            die(header("Location: error.php?error=error"));
          }
        }
      } catch (\Throwable $th) {
        die(header("Location: error.php?error=cart"));
      }
    }
    ?>
  </div>
</body>
<script src="scripts/main.js"></script>

</html>