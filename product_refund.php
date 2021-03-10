<?php
include("includes/employee_session.php");
include_once("includes/database.php");

if ($_GET['action'] == 'approve') {
  mysqlidb::query("UPDATE `refund` SET `RefundStatus` = 'Approved' WHERE `refund`.`RefundId` = $_GET[refundid]");
  mysqlidb::query("UPDATE `orderitem` SET `OrderStatus` = 'Refund' WHERE `orderitem`.`OrderId` = $_GET[orderid] AND `orderitem`.`ProductId` = $_GET[productid]");
} else {
  mysqlidb::query("DELETE FROM refund WHERE `refund`.`RefundId` = $_GET[refundid]");
  mysqlidb::query("UPDATE `orderitem` SET `OrderStatus` = 'Shipped' WHERE `orderitem`.`OrderId` = $_GET[orderid] AND `orderitem`.`ProductId` = $_GET[productid]");
}

header("location: employee_refunds.php");
