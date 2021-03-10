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
  <title>Chapalang Clothes</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->

  <div class="modal-background modal hidden">
    <div class="modal-content center-in-page-abs">
      <div onclick="DismissModal(0)" class="material-icons modal-close-button white">close</div>
      <div class="modal-body">
        <div class="flex flex-justify-center flex-align-center">
          <div class="material-icons md-48 unselectable ruby">info</div>
          <div class="modal-text m-2">Are you sure you want to delete this item?</div>
        </div>
        <form action="vendor_delete_product.php" method="post">
          <input type="hidden" name="productId" value="<?php echo $row['ProductId'] ?>">
          <div class="flex flex-row">
            <input class="m-1 w-3" type="submit" value="Yes">
            <input class="m-1 w-3" type="button" value="Cancel" onclick="DismissModal(0);">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <div class="vendor-container">
        <?php
        include("includes/vendor_sidenav.php");
        ?>
        <div class="vendor-body">
          <?php
          $productimages = explode(",", $row['ProductImage'])[0];
          echo "<div class=\"productdetails\">
            <h1 class=\"m-0\">Product Details for {$row['ProductName']}</h1>
            <hr>
            <h3>Product ID : $row[ProductId]</h3>
            <h3>Product Name : $row[ProductName]</h3>
            <h3>Description : $row[ProductDescription]</h3>
            <h3>Product Tags : $row[ProductTags]</h3>
            <h3>Product Price : RM $row[ProductPrice]</h3>
            <h3>Product Stock : $row[ProductStock]</h3>
            <h3>Product Image: </h3>
            <div class=\"vendor-product-image\"><img src=\"$productimages\"></div>
            <div class=\"flex flex-row\">
            <div class=\"btn-primary w-1\" onclick=\"ShowModal(0)\">Delete</div>
            <a class=\"white vis-white w-1\" href=\"vendor_edit_product.php?productid=$row[ProductId]\">
            <div class=\"btn-primary\">Edit</div>
            </a> 
            </div>
            </div>
            ";
          ?>

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
<script src="scripts/main.js"></script>

</html>