<?php
include("includes/sessioncheck.php");
include_once("includes/database.php");


if (isset($_POST["refunddescrip"])) {

  $image_dir = "images/refund/";
  $image_file = $image_dir . basename($_FILES["image"]["name"]);
  $image_exist = mysqlidb::fetchRow("SELECT * from refund WHERE Images = '$image_file' ");
  $image_filetype = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));

  if (is_null($image_exist)) {

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_file)) {

      $refund = "INSERT INTO refund (OrderId, ProductId, Reason, RefundStatus, DateRequested, Images)
            VALUES ('$_POST[orderid]','$_POST[productid]','$_POST[refunddescrip]','Pending','" . date("Y-m-d") . "','$image_file')";

      $orderrefund = "UPDATE orderitem SET OrderStatus='RefundPending' WHERE OrderId = '{$_POST["orderid"]}' AND ProductId='{$_POST["productid"]}'";

      mysqlidb::query($orderrefund);
      mysqlidb::query($refund);

      header("location: purchase_history.php?message=refund_success");
    }
  } else {
    echo "<script>
        alert('Image already exists! Please choose another image');
        window.location.href = 'purchase_history.php?message=refund_fail'
        </script>";
  }
}
