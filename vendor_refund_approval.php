<?php
include "includes/vendor_session.php";
include("includes/database.php");

if ($_GET['action'] == 'approve') {
mysqlidb::query("UPDATE refund SET RefundStatus = 'Approved' WHERE RefundId = $_GET[refundid]");
mysqlidb::query("UPDATE orderitem SET OrderStatus = 'Refund' WHERE OrderId = $_GET[orderid]");
} else { 
mysqlidb::query("UPDATE refund SET RefundStatus = 'Denied' WHERE RefundId = $_GET[refundid]");
mysqlidb::query("UPDATE orderitem SET OrderStatus = 'RefundPending' WHERE OrderId = $_GET[orderid]");
}

header("location: vendor_refund.php");
