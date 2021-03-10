<?php
include "includes/vendor_session.php";
if (isset($_POST["shippingstatus"])) {
    $chkarr = $_POST['checkbox'];
    foreach ($chkarr as $orderinfo) {
        include_once("includes/database.php");
        $splitid = explode(",", $orderinfo);
        $sql = "UPDATE orderitem SET OrderStatus = '$_POST[shippingstatus]' 
        WHERE OrderId='{$splitid[0]}' AND ProductId='{$splitid[1]}'";
        mysqlidb::query($sql);
    }
    header("location:vendor_order_info.php");
}
?>