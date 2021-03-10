<?php
include "includes/vendor_session.php";
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
        <div class="vendor-body card-generic p-2">
          <form action="vendor_adding_products.php" method="POST" enctype="multipart/form-data" name="vendoraddprod" onsubmit="return validateProduct()">
            <h3>Add Product</h3>
            <hr><br>

            <label for="productname">Name
              <input placeholder="Enter product name" type="text" name="productname" id="prodname" required>
            </label>
            <br><br>

            <label for="desc">Description
              <textarea placeholder="Enter description" name="productdesc" id="proddesc" required></textarea>
            </label>
            <br><br>

            <div class="addimages flex-wrapper">
              <div class="addimg">
                <img class="img-upload" id="output1">
                <br>
                <input type="file" accept="image/*" name="file[]" required onchange="displayproduct(event, 'output1')">
              </div>

              <div class="addimg">
                <img class="img-upload" id="output2">
                <br>
                <input type="file" accept="image/*" name="file[]" onchange="displayproduct(event, 'output2')">
              </div>

              <div class="addimg">
                <img class="img-upload" id="output3">
                <br>
                <input type="file" accept="image/*" name="file[]" onchange="displayproduct(event, 'output3')">
              </div>

              <div class="addimg">
                <img class="img-upload" id="output4">
                <br>
                <input type="file" accept="image/*" name="file[]" onchange="displayproduct(event, 'output4')">
              </div>

              <div class="addimg">
                <img class="img-upload" id="output5">
                <br>
                <input type="file" accept="image/*" name="file[]" onchange="displayproduct(event, 'output5')">
              </div>

              <div class="addimg">
                <img class="img-upload" id="output6">
                <br>
                <input type="file" accept="image/*" name="file[]" onchange="displayproduct(event, 'output6')">
              </div>
            </div>
            <br><br>

            <label for="tag">Tag
              <input placeholder="Enter tag" type="text" name="producttag" id="prodtag" required>
            </label>
            <br><br>

            <label for="value">Value
              <input placeholder="Enter value" type="number" name="productvalue" id="prodval" step="0.01" required>
            </label>
            <br><br>

            <label for="stock">Stock
              <input placeholder="Enter stock" type="number" name="productstock" id="prodstock" required>
            </label>
            <br><br>

            <input type="submit" value="Add">
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