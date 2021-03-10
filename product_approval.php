<?php
include("includes/employee_session.php");
include_once("includes/database.php");

if ($_GET['action'] == 'approve') {
mysqlidb::query("UPDATE `product` SET `ProductStatus` = 'Approved' WHERE `product`.`ProductId` = $_GET[productid]");
} else { 
mysqlidb::query("UPDATE `product` SET `ProductStatus` = 'Denied' WHERE `product`.`ProductId` = $_GET[productid]");
}

header("location: employee_approval.php");
?>