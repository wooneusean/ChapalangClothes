<?php
include_once "includes/database.php";
$vendorid = $_SESSION["vendorid"];
$inboxItems = mysqlidb::fetchRow("SELECT COUNT(*) AS InboxCount FROM (SELECT * FROM `message` WHERE VendorId=$vendorid AND MessageReadVendor=0 GROUP BY UserId) t1")["InboxCount"];
$approvals = mysqlidb::fetchRow("SELECT COUNT(*) AS Reports FROM (SELECT COUNT(report.ProductId) AS TotalReports FROM `report` INNER JOIN Product ON product.ProductId = report.ProductId WHERE product.ProductStatus = 'Approved' GROUP BY report.ProductId) t1")["Reports"];
?>
<div class="vendor-sidenav">
  <div class="vendor-sidenav-group">
    <div class="vendor-sidenav-header">
      Profile
    </div>
    <a href="vendor_profile.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">person</i>
      Manage
    </a>
    <a href="vendor_inbox.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">mail</i>
      Inbox
      <?php
      if ($inboxItems > 0) {
        echo "<sup class=\"notification bg-ruby white\">$inboxItems</sup>";
      }
      ?>
    </a>
  </div>
  <div class="vendor-sidenav-group">
    <a class="vendor-sidenav-header">
      Products
    </a>
    <a href="vendor_add_product.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">add</i>
      Add
    </a>
    <a href="vendor_product_approval.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">check</i>
      Approval
    </a>
  </div>
  <div class="vendor-sidenav-group">
    <div class="vendor-sidenav-header">
      Orders
    </div>
    <a href="vendor_order_info.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">info</i>
      Order Info
    </a>
    <a href="vendor_refund.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">money_off</i>
      Refund
    </a>
  </div>
  <div class="vendor-sidenav-group">
    <div class="vendor-sidenav-header">
      Finance
    </div>
    <a href="vendor_income.php" class="vendor-sidenav-item">
      <i class="material-icons md-12">attach_money</i>
      Income
    </a>
  </div>
</div>