<?php
include "includes/vendor_session.php";
include("includes/database.php");
$vendorid = $_SESSION["vendorid"]; // USE SESSIONS
$rows = mysqlidb::fetchAllRows("SELECT orderitem.OrderId, Username, PurchaseDate, Address, ProductName, ProductQuantity, OrderStatus, product.ProductId,
orderitem.ProductQuantity*product.ProductPrice AS TotalPrice
FROM orderitem
INNER JOIN productorder ON productorder.OrderId = orderitem.OrderId
INNER JOIN product ON product.ProductId = orderitem.ProductId
INNER JOIN user ON user.UserId = productorder.UserId 
WHERE (OrderStatus = 'Shipped' OR OrderStatus = 'To Ship')
AND ProductStatus = 'Approved'
AND VendorId = $vendorid
ORDER BY PurchaseDate Desc");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link rel="stylesheet" href="styles/template.css" />
  <link rel="stylesheet" href="styles/vendor.css" />
  <link rel="stylesheet" href="styles/pagetopbar.css" />
  <title>Chapalang Clothes</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <div class="vendor-container">
        <?php
        include("includes/vendor_sidenav.php");
        ?>
        <div class="vendor-body">
          <h3>Order Info</h3>
          <hr>
          <form action="vendor_order_statuschange.php" method="POST">
            <table>
              <tr>
                <th width="4%"></th>
                <th width="8%">Order ID</th>
                <th width="10%">Customer</th>
                <th width="12%">Purchase Date</th>
                <th width="25%">Address</th>
                <th width="13%">Product</th>
                <th width="8%">Quantity</th>
                <th width="10%">Amount Paid</th>
                <th width="10%">Order Status</th>
              </tr>
              <?php
              if (count($rows) > 0) {
                foreach ($rows as $row) {
                  echo "
                <tr>
                  <td><input type='checkbox' name='checkbox[]' value='" . $row['OrderId'] . ", " . $row['ProductId'] . "'></td>
                  <td>{$row['OrderId']}</td>
                  <td>{$row['Username']}</td>
                  <td>{$row['PurchaseDate']}</td>
                  <td>{$row['Address']}</td>
                  <td>{$row['ProductName']}</td>
                  <td>{$row['ProductQuantity']}</td>
                  <td>RM {$row['TotalPrice']}</td>
                  <td>{$row['OrderStatus']}</td>
                </tr>";
                }
              } else {
                echo "<tr><td colspan=\"9\"><h2 class=\"cultured-dark\">There are no orders.</h2></td></tr>";
              }

              ?>
            </table>

            <br>

            <label for="status">Shipping Status
              <select name="shippingstatus" required>
                <option value="">Please Select</option>
                <option value="To Ship">To Ship</option>
                <option value="Shipped">Shipped</option>
              </select>
            </label>

            <br><br>

            <input type="submit" name="orderstatus" value="Edit">
            <br><br>
          </form>
        </div>
      </div>
    </div>
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footeremployee.html" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/vendor_page.js"></script>

</html>