<?php

echo '<div class="shopping-cart-popup-body">';

include 'includes/startsession.php';
if (isset($_SESSION["userid"])) {
  include_once 'includes/database.php';
  $userId = $_SESSION["userid"];
  $shoppingCartItems = mysqlidb::fetchAllRows("SELECT * FROM shopping_cart INNER JOIN product ON shopping_cart.ProductId = product.ProductId WHERE shopping_cart.UserId=$userId");
  if (count($shoppingCartItems) > 0) {
    foreach ($shoppingCartItems as $cartItem) {
      $cartItemImage = explode(",", $cartItem["ProductImage"])[0];
      echo '<div class="shopping-cart-popup-item bg-white">
            <a href="item.php?id=' . $cartItem["ProductId"] . '">
            <div class="shopping-cart-popup-image">
            <img src="' . $cartItemImage . '" alt="">
            </div>
            </a>
            <div class="shopping-cart-popup-item-details flex">
            <a href="item.php?id=' . $cartItem["ProductId"] . '">
            <div class="shopping-cart-popup-item-name ellipsis-truncate">
            ' . $cartItem["ProductName"] . '
            </div>
            <div class="shopping-cart-popup-item-detail-container flex">
            <div class="shopping-cart-popup-item-price">
            RM ' . number_format($cartItem["ProductPrice"], 2) . '
            </div>';

      if ($cartItem["CartQuantity"] > 1) {
        echo '<div class="shopping-cart-popup-item-quantity">
              ' . $cartItem["CartQuantity"] . '
              </div>';
      }

      echo '</div>
            </a>
            <div onclick="RemoveFromCart(' . $cartItem["ProductId"] . ')" class="material-icons unselectable shopping-cart-popup-item-remove">
            close
            </div>
            </div>
            </div>
            ';
    }
    echo '</div>
          <a href="cart.php"><div class="shopping-cart-popup-checkout btn-primary">Checkout Now</div></a>';
  } else {
    echo '<div class="shopping-cart-popup-empty center-in-page-rel text-center">
            <div class="material-icons md-72 ruby unselectable">shopping_bag</div>
            <div class="cultured-dark">Your shopping cart is empty!</div>
          </div>
          </div>';
  }
} else if (isset($_SESSION["employeeid"])) {
  echo '<div class="shopping-cart-popup-empty center-in-page-rel text-center">
          <div class="material-icons md-72 ruby unselectable">shopping_bag</div>
          <div class="cultured-dark">You cannot have a shopping cart as an employee!</div>
        </div>
        </div>';
} else {
  echo '<div class="shopping-cart-popup-empty center-in-page-rel text-center">
            <div class="material-icons md-72 ruby unselectable">shopping_bag</div>
            <div class="cultured-dark">You need to login first!</div>
          </div>
          </div>
        <div class="shopping-cart-popup-checkout btn-primary"><a href="loginpage.php">Login</a></div>';
}
