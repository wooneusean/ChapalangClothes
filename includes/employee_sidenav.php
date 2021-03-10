<?php
$approvals = mysqlidb::fetchRow("SELECT COUNT(*) AS Approvals FROM product WHERE ProductStatus='Pending' ")['Approvals'];
$reports = mysqlidb::fetchRow("SELECT COUNT(*) AS Reports FROM (SELECT COUNT(report.ProductId) AS TotalReports FROM `report` INNER JOIN Product ON product.ProductId = report.ProductId WHERE product.ProductStatus = 'Approved' GROUP BY report.ProductId) t1")["Reports"];
$refunds = mysqlidb::fetchRow("SELECT COUNT(*) AS Refunds FROM `refund` WHERE RefundStatus = 'Denied'")["Refunds"];
?>
<div class="employee-sidenav">
  <div class="employee-sidenav-group">
    <div class="employee-sidenav-label">
      <a href="employee_approval.php">
        <i class="material-icons icons ruby">check</i>
        Product Approval <sup class="notification white bg-ruby">
          <?php echo $approvals ?>
        </sup>
      </a>
    </div>
    <div class="employee-sidenav-label">
      <a href="employee_reports.php">
        <i class="material-icons icons ruby">report</i>
        Product Reports <sup class="notification white bg-ruby">
          <?php echo $reports ?>
        </sup>
      </a>
    </div>
    <div class="employee-sidenav-label">
      <a href="employee_refunds.php">
        <i class="material-icons icons ruby">redo</i>
        Product Refunds <sup class="notification white bg-ruby">
          <?php echo $refunds ?>
        </sup>
      </a>
    </div>
    <div class="employee-sidenav-label">
      <a href="employee_banner.php">
        <i class="material-icons icons ruby">view_carousel</i>
        Manage Banners
      </a>
    </div>
    <div class="employee-sidenav-label">
      <a href="employee_feedback.php">
        <i class="material-icons icons ruby">feedback</i>
        View Feedback
      </a>
    </div>
    <div class="employee-sidenav-label">
      <a href="employee_statistic.php">
        <i class="material-icons icons ruby">stacked_line_chart</i>
        View Statistics
      </a>
    </div>
  </div>
</div>