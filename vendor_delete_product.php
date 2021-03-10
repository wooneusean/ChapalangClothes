<?php
include "includes/vendor_session.php";

if (isset($_POST["productId"])) {
  include("includes/database.php");

  $vendorId = $_SESSION["vendorid"]; // USE SESSIONS
  $productId = $_POST["productId"];

  $sql = "UPDATE product SET ProductStatus='Removed' WHERE ProductId=$productId AND VendorId=$vendorId";

  try {
    mysqlidb::query($sql);
  } catch (\Throwable $th) {
    echo "<script>
        alert('Product failed to delete!');
        window.location.href = 'vendor_profile.php'
        </script>";
  }

  echo "<script>
        alert('Product successfully removed.');
        window.location.href = 'vendor_profile.php'
        </script>";
}
