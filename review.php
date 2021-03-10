<?php
include "includes/sessioncheck.php";
include_once "includes/database.php";

$productId = mysqlidb::escape($_POST['productid']);

if (mysqlidb::checkRecordExists("SELECT * FROM product WHERE ProductId=$productId")) {
  $userId = $_SESSION["userid"];
  $reviewRating = mysqlidb::escape($_POST["review-rating"]);
  $reviewTitle = mysqlidb::escape($_POST["review-title"]);
  $reviewBody = mysqlidb::escape($_POST["review-body"]);

  if (empty($reviewRating) || empty($reviewTitle) || empty($reviewBody)) {
    die(header("Location: error.php?error=review"));
  }

  if (mysqlidb::query(
    "INSERT INTO review 
    (`ProductId`, `UserId`, `ReviewTitle`, `ReviewRating`, `ReviewComment`) 
    VALUES 
    ($productId,$userId,'$reviewTitle',$reviewRating,'$reviewBody')")) {
    die(header("Location: item.php?id=$productId"));
  } else {
    die(header("Location: error.php?error=review"));
  }
} else {
  die(header("Location: error.php?error=review"));
}
