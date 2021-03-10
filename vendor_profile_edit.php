<?php
include "includes/vendor_session.php";
include("includes/database.php");
$vendor_img_dir = "images/vendors/";
$vendor_img_file = $vendor_img_dir . basename($_FILES["vendor_image"]["name"]);
$vendor_filetype = strtolower(pathinfo($vendor_img_file, PATHINFO_EXTENSION));
$file_name = basename($_FILES["vendor_image"]["name"]);

$imagequery = "";
if ($_FILES["vendor_image"]["error"] !== UPLOAD_ERR_NO_FILE) {
  move_uploaded_file($_FILES["vendor_image"]["tmp_name"], $vendor_img_file);
  $imagequery = ", VendorImage = '$vendor_img_file'";
}

$password_query = "";
if (!empty($_POST["pass"])) {
  $password_query = "Password=sha1('" . mysqlidb::escape($_POST["pass"]) . "'),";
}

$sql = "UPDATE vendor SET 
        ShopName='" . mysqlidb::escape($_POST["shopname"]) . "',
        Username='" . mysqlidb::escape($_POST["username"]) . "',
        $password_query
        Email='" . mysqlidb::escape($_POST["email"]) . "',
        Description='" . mysqlidb::escape($_POST["desc"]) . "',
        Address='" . mysqlidb::escape($_POST["address"]) . "'
        $imagequery
        WHERE VendorId=$_POST[id];";
mysqlidb::query($sql);

echo "<script>
      alert('Profile Edited');
      window.location.href = 'vendor_profile.php'
      </script>";
