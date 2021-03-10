<?php
// if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
//   die(http_response_code(404));
// }

include "includes/sessioncheck.php";
include_once "includes/database.php";
// productId, quantity, action - add
// productId, action - remove

if (isset($_GET["action"])) {
  $userId = $_SESSION["userid"];
  $action = $_GET["action"];
  if ($action == "add") {
    if (isset($_GET["productId"]) && isset($_GET["quantity"])) {
      $productId = $_GET["productId"];
      $productQuantity = $_GET["quantity"];
      if ($item = mysqlidb::fetchRow("SELECT * FROM product WHERE ProductId=$productId")) {
        if (intval($productQuantity) <= intval($item["ProductStock"])) {
          if (mysqlidb::checkRecordExists("SELECT * FROM shopping_cart WHERE ProductId = $productId AND UserId = $userId")) {
            $row = mysqlidb::fetchRow("SELECT * FROM shopping_cart WHERE ProductId = $productId AND UserId = $userId");
            $newQuantity = intval($row["CartQuantity"]) + intval($productQuantity);
            mysqlidb::query("UPDATE shopping_cart SET CartQuantity = $newQuantity WHERE ProductId = $productId AND UserId = $userId");
          } else {
            mysqlidb::query("INSERT INTO shopping_cart(UserId, ProductId, CartQuantity) VALUES($userId,$productId,$productQuantity)");
          }
        } else {
          http_response_code(404);
        }
      }
    } else {
      http_response_code(404);
    }
  } else if ($action == "remove") {
    if (isset($_GET["productId"])) {
      $productId = mysqlidb::escape($_GET["productId"]);
      mysqlidb::query("DELETE FROM shopping_cart WHERE ProductId='$productId' AND UserId=$userId");
    }
  } else {
    http_response_code(404);
  }
} else {
  http_response_code(404);
}
