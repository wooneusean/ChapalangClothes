<?php
include "includes/vendor_session.php";

if (isset($_POST["productname"]) && isset($_POST["productdesc"]) && isset($_POST["producttag"]) && isset($_POST["productvalue"]) && isset($_POST["productstock"])) {
  include("includes/database.php");

  $img_list = [];
  $count = count($_FILES['file']['name']);

  $productimage_dir = "images/items/";

  for ($i = 0; $i < $count; $i++) {
    if ($_FILES['file']['error'][$i] !== UPLOAD_ERR_NO_FILE) {
      $productimage_file = $productimage_dir . mysqlidb::escape(basename($_FILES["file"]["name"][$i]));
      if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $productimage_file)) {
        array_push($img_list, $productimage_file);
      }
    }
  }

  $image_urls = implode(",", $img_list);

  $vendorid = $_SESSION["vendorid"]; // USE SESSIONS

  $sql = "INSERT INTO product (ProductName, ProductDescription, ProductTags, ProductImage, ProductPrice, ProductStatus, ProductStock, VendorId)
        VALUES
        ('" . mysqlidb::escape($_POST["productname"]) . "','" . mysqlidb::escape($_POST["productdesc"]) . "', '" . mysqlidb::escape($_POST["producttag"]) . "', '" . mysqlidb::escape($image_urls) . "', '$_POST[productvalue]', 'Pending', '$_POST[productstock]', $vendorid)";
  mysqlidb::query($sql);

  echo "<script>
        alert('Product added, please wait for approval.');
        window.location.href = 'vendor_add_product.php'
        </script>";
}
