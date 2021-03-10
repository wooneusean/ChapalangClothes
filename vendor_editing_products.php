<?php
include "includes/vendor_session.php";

if (
  isset($_POST["productid"]) &&
  isset($_POST["productname"]) &&
  isset($_POST["productdesc"]) &&
  isset($_POST["producttag"]) &&
  isset($_POST["productvalue"]) &&
  isset($_POST["productstock"])
) {
  include("includes/database.php");
  $vendorid = $_SESSION["vendorid"]; // USE SESSIONS

  $escProductId = mysqlidb::escape($_POST["productid"]);
  $escProductName = mysqlidb::escape($_POST["productname"]);
  $escProductDesc = mysqlidb::escape($_POST["productdesc"]);
  $escProductTag = mysqlidb::escape($_POST["producttag"]);
  $escProductValue = mysqlidb::escape($_POST["productvalue"]);
  $escProductStock = mysqlidb::escape($_POST["productstock"]);

  $currentData = mysqlidb::fetchRow("SELECT * FROM product WHERE ProductId=$escProductId");

  $newProductStatus = "Pending";
  $notificationMessage = "Product successfully edited, please wait for approval.";
  if (
    $currentData["ProductName"] == $escProductName &&
    mysqlidb::escape($currentData["ProductDescription"]) == $escProductDesc &&
    $currentData["ProductTags"] == $escProductTag &&
    $currentData["ProductPrice"] == $escProductValue
  ) {
    $newProductStatus = "Approved";
    $notificationMessage = "Product stock successfully edited, no approval is needed.";
  }

  $sql = "UPDATE 
  product 
  SET 
  ProductName='$escProductName',
  ProductDescription='$escProductDesc',
  ProductTags='$escProductTag',
  ProductPrice='$escProductValue',
  ProductStatus='$newProductStatus',
  ProductStock='$escProductStock'
  WHERE 
  ProductId=" . mysqlidb::escape($_POST["productid"]) . " AND VendorId=" . mysqlidb::escape($vendorid);

  mysqlidb::query($sql);

  echo "<script>
        alert('$notificationMessage');
        window.location.href = 'vendor_profile.php'
        </script>";
}
