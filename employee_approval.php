<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$rows = mysqlidb::fetchAllRows("SELECT * FROM product
INNER JOIN vendor ON vendor.VendorId = product.vendorId
WHERE ProductStatus='Pending' LIMIT 10");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link href="styles/template.css" type="text/css" rel="stylesheet">
  <link href="styles/pagetopbar.css" type="text/css" rel="stylesheet">
  <link href="styles/khor.css" type="text/css" rel="stylesheet">
  <title>Product Approvals</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>Product Approvals</h1>
      <div class="employee-wrapper p-2">
        <?php include "includes/employee_sidenav.php" ?>
        <table class="employee-table bg-white">
          <tr>
            <th class="employee-table-header-tl" width="25%">Item Image</th>
            <th width="25%">Item Name</th>
            <th width="25%">Item Vendor</th>
            <th class="employee-table-header-tr" width="25%">Action</th>
          </tr>
          <?php
          if (count($rows) > 0) {
            foreach ($rows as $row) {
              $imgurl = explode(",", $row['ProductImage'])[0];
              echo "<tr>
                        <td width=\"25%\"><img src=\"$imgurl\" alt=\"\" class=\"table-image\"></td>
                        <td width=\"25%\">{$row['ProductName']}</td>
                        <td width=\"25%\">{$row['ShopName']}</td>
                        <td width=\"25%\">
                            <a href=\"product_approval.php?productid={$row['ProductId']}&action=approve\" class=\"btn-primary p-1 visited-white\">Approve</a>
                            <a href=\"product_approval.php?productid={$row['ProductId']}&action=deny\" class=\"btn-primary p-1 visited-white\">Deny</a>
                        </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan=\"4\"><h2 class=\"cultured-dark\">There are no product approvals.</h2></td></tr>";
          }
          ?>
        </table>
      </div>
    </div>
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footeremployee.html" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<script src="scripts/employee_sidenav.js"></script>

</html>