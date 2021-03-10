<?php
include_once "includes/sessioncheck.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <title>Shopping Cart</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->

  <?php
  $hasItems = false;
  $userId = $_SESSION["userid"];
  $rows = mysqlidb::fetchAllRows("SELECT vendor.ShopName,product.ProductId,product.ProductName,product.ProductImage,product.ProductPrice,shopping_cart.CartQuantity,(product.ProductPrice * shopping_cart.CartQuantity) as ProductTotal FROM shopping_cart INNER JOIN product ON product.ProductId = shopping_cart.ProductId INNER JOIN vendor ON vendor.VendorId = product.VendorId WHERE shopping_cart.UserId=$userId");

  if (count($rows) > 0) {
    $hasItems = true;
  }
  ?>

  <!-- ----------------------------------- MODAL ----------------------------------- -->
  <?php
  if ($hasItems) {
    $checkoutTotal = 0;
    $totalItems = 0;
    foreach ($rows as $row) {
      $checkoutTotal += $row["ProductTotal"];
      $totalItems += 1;
    }
    $shippingCost = 5 / 100 * $checkoutTotal;
    $gstTax = 6 / 100 * ($shippingCost + $checkoutTotal);
    echo '<div  class="modal-background modal hidden">
          <div class="b-r-0 modal-content center-in-page-abs payment-modal">
          <div onclick="DismissModal()" class="material-icons modal-close-button white">close</div>
          <div class="modal-body">
          <div class="payment-form-container">
          <div class="payment-form">
          <form action="transaction.php" method="POST">
          <div class="form-input-group">
          <label for="card_no">Card Number</label>
          <input type="text" autocomplete="off" id="card_no" name="card_no" maxlength="16" placeholder="Enter Card Number (16 Digits)" required>
          </div>
          <div class="flex">
          <div class="form-input-group">
          <label for="card_exp">Expiration Date</label>
          <input type="text" autocomplete="off" maxlength="5" id="card_exp" name="card_exp" placeholder="MM/YY" required>
          </div>
          <div class="form-input-group">
          <label for="card_secret">Security Code (CCV)</label>
          <input type="text" autocomplete="off" maxlength="3" id="card_secret" name="card_secret" placeholder="XXX" required>
          </div>
          </div>
          <div class="form-input-group">
          <label for="card_holder">Card Holder Name</label>
          <input type="text" autocomplete="off" id="card_holder" name="card_holder" placeholder="John Doe" required>
          </div>
          <div class="form-input-group">
          <input type="submit" id="send_transaction" value="Place Order" disabled>
          </div>
          </form>
          </div>
          <!-- CHANGE THIS -->
          <div class="payment-items">
          <div class="payment-items-header">Checkout Items</div>
          <div class="payment-items-details flex">
          <div class="payment-items-name">
          Order Total
          </div>
          <div class="payment-items-subtotal">
          RM ' . number_format($checkoutTotal, 2) . '
          </div>
          </div>
          <div class="payment-items-details flex">
          <div class="payment-items-name">
          Shipping Cost (5%)
          </div>
          <div class="payment-items-subtotal">
          RM ' . number_format($shippingCost, 2) . '
          </div>
          </div>
          <div class="payment-items-details flex">
          <div class="payment-items-name">
          SST (6%)
          </div>
          <div class="payment-items-subtotal">
          RM ' . number_format($gstTax, 2) . '
          </div>
          </div>
          <div class="payment-items-total flex">
          Total <span>RM ' . number_format($checkoutTotal + $shippingCost + $gstTax, 2) . '</span>
          </div>
          </div>
          <!-- /CHANGE THIS/ -->
          </div>
          </div>
          </div>
          </div>';
  }
  ?>

  <!-- ----------------------------------- /MODAL/ ----------------------------------- -->
  <div class="body-wrapper">

    <div></div>

    <!-- ----------------------------------- BODY ----------------------------------- -->

    <div class="content-wrapper container">

      <!-- ----------------------------------- EMPTY CART ----------------------------------- -->
      <!-- <div class="center-in-page-abs text-center unselectable">
        <div class="material-icons md-144 ruby">shopping_bag</div>
        <h1 class="grey">Your shopping cart is empty!</h1>
        <a href="index.php">
          <div class="w-3 container">
            <div class="btn-primary">Go shopping now!</div>
          </div>
        </a>
      </div> -->
      <!-- ----------------------------------- /EMPTY CART/ ----------------------------------- -->

      <!-- ----------------------------------- CART WITH ITEMS ----------------------------------- -->
      <?php
      if ($hasItems) {
        echo '<div class="cart-item">
            <div class="cart-item-header">
              <div class="cart-product">Product</div>
              <div class="cart-price">Unit Price</div>
              <div class="cart-quantity">Quantity</div>
              <div class="cart-total">Total Price</div>
              <div class="cart-actions">Actions</div>
            </div>
            <div id="cart-item-body" class="cart-item-body">';
        $vendors = [];
        foreach ($rows as $row) {
          if (!in_array($row["ShopName"], $vendors)) {
            array_push($vendors, $row["ShopName"]);
          }
        }
        foreach ($vendors as $vendor) {
          echo "<div class=\"cart-item-vendor\">
                    from <span class=\"cart-item-vendor-name ruby\">$vendor</span>
                    </div>";

          foreach ($rows as $row) {
            if ($row["ShopName"] == $vendor) {
              $productImage = explode(",", $row["ProductImage"])[0];
              echo '<div class="cart-item-details">
                          <a href="item.php?id=' . $row["ProductId"] . '" class="cart-product ellipsis-truncate">
                            <img src="' . $productImage . '" alt="">
                            ' . $row["ProductName"] . '
                          </a>
              
                          <div class="cart-price">RM ' . number_format($row["ProductPrice"], 2) . '</div>
                          <div class="cart-quantity">' . $row["CartQuantity"] . '</div>
                          <div class="cart-total">RM ' . number_format($row["ProductTotal"], 2) . '</div>
                          <div class="cart-actions ruby" onclick="RemoveFromCart(' . $row["ProductId"] . ',true)">
                            Remove
                          </div>
                        </div>';
            }
          }
        }
        echo '</div>';
      } else {
        echo '<div class="center-in-page-abs text-center unselectable">
                  <div class="material-icons md-144 ruby">shopping_bag</div>
                  <h1 class="grey">Your shopping cart is empty!</h1>
                  <a href="index.php">
                    <div class="w-3 container">
                      <div class="btn-primary">Go shopping now!</div>
                    </div>
                  </a>
                </div>';
      }
      ?>
    </div>
  </div>

  <?php
  if ($hasItems) {
    echo '<div class="cart-checkout-area">
            <div class="cart-checkout-area-wrapper container content-wrapper">
              <div class="cart-checkout-quantity">Merchandise Subtotal (' . $totalItems . ' items)</div>
              <div class="cart-checkout-total">RM ' . number_format($checkoutTotal, 2) . '</div>
              <div class="cart-checkout-button-container">
                <div onclick="ShowModal()" class="cart-checkout-button btn-primary">Checkout</div>
              </div>
            </div>
          </div>';
  }
  ?>
  <!-- ----------------------------------- /BODY/ ----------------------------------- -->

  <!-- ----------------------------------- FOOTER ----------------------------------- -->
  <?php include "includes/footer.php" ?>
  <!-- ----------------------------------- /FOOTER/ ----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<script src="scripts/cart_page.js"></script>
<?php include "includes/store_scripts.php"; ?>

</html>