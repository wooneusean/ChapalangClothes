<?php
include("includes/employee_session.php");
include_once("includes/database.php");

if ($_GET['action'] == 'blacklist') {
mysqlidb::multiQuery("UPDATE `product` SET `ProductStatus` = 'Blacklisted' WHERE `product`.`ProductId` = $_GET[productid];
DELETE FROM report WHERE report.ProductId = $_GET[productid]");
} else { 
mysqlidb::query("DELETE FROM report WHERE report.ProductId = $_GET[productid]");
}

header("location: employee_reports.php");
?>