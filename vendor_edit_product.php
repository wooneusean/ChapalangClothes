<?php
include "includes/vendor_session.php";
include("includes/database.php");
if (!isset($_GET['productid'])) {
  header("location: error.php?error=bad_item");
}
$vendorId = $_SESSION['vendorid'];
$row = mysqlidb::fetchRow("SELECT * FROM product
WHERE product.ProductId = '$_GET[productid]' AND product.VendorId=$vendorId");
if (empty($row)) {
  echo "<script>
        alert('Error! This item does not belong to you!');
         window.location.href = 'vendor_profile.php'
         </script>";
}
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
  <script src="scripts/yeap.js"></script>
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
          <form action="vendor_editing_products.php" method="POST" name="vendoreditprod" onsubmit="return validateProduct()">
            <h3>Edit Product</h3>
            <hr><br>
            <label for="productid">Product ID
              <input type="hidden" value="<?php echo $row['ProductId'] ?>" name="productid">
              <h3><?php echo $row['ProductId'] ?></h3>
            </label>
            <br>

            <label for="productname">Name
              <input placeholder="Enter product name" type="text" value="<?php echo $row['ProductName'] ?>" name="productname" id="prodname" required>
            </label>
            <br><br>

            <label for="desc">Description
              <textarea placeholder="Enter description" name="productdesc" id="proddesc" required><?php echo $row['ProductDescription'] ?></textarea>
            </label>
            <br><br>

            <label for="tag">Tag
              <input placeholder="Enter tag" type="text" value="<?php echo $row['ProductTags'] ?>" name="producttag" id="prodtag" required>
            </label>
            <br><br>

            <label for="value">Value
              <input placeholder="Enter value" type="number" value="<?php echo $row['ProductPrice'] ?>" name="productvalue" id="prodval" step="0.01" required>
            </label>
            <br><br>

            <label for="stock">Stock
              <input placeholder="Enter stock" type="number" value="<?php echo $row['ProductStock'] ?>" name="productstock" id="prodstock" required>
            </label>
            <br><br>

            <input type="submit" value="Save">
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