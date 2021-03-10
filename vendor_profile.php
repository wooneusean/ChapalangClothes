<?php
include "includes/vendor_session.php";
include "conn.php";
$vendorid = $_SESSION["vendorid"]; // USE SESSIONS
$sql = "SELECT * FROM vendor WHERE VendorId = $vendorid";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
          <form action="vendor_profile_edit.php" method="POST" enctype="multipart/form-data" name="vendorprof" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $row["VendorId"] ?>">
            <h3>Manage Account</h3>
            <hr><br>

            <?php
            $imgurl = $row['VendorImage'];
            echo "<img src=\"$imgurl\" class=\"img-upload\" id=\"output\">"
            ?>
            <br>
            <div class="btn-primary w-2">
              <label for="file" style="cursor: pointer;">Upload Profile Image</label>
              <input class="ignorefile" type="file" accept="image/*" name="vendor_image" id="file" onchange="displayprofile(event)">
            </div>
            <br><br>

            <label for="shopname">Shopname
              <input placeholder="Enter shopname" type="text" name="shopname" id="shopnm" required value="<?php echo $row["ShopName"] ?>">
            </label>
            <br><br>

            <div class="readonly"><label for="username">Username
                <input placeholder="Enter username" type="text" name="username" id="usernm" required readonly value="<?php echo $row["Username"] ?>">
              </label>
            </div>
            <br>

            <label for="email">Email
              <input placeholder="Enter Email" type="email" name="email" id="vendem" required value="<?php echo $row["Email"] ?>">
            </label>
            <br><br>

            <label for="desc">Description
              <textarea placeholder="Enter description" name="desc" required><?php echo $row["Description"]; ?></textarea>
            </label>
            <br><br>

            <label for="address">Address
              <textarea placeholder="Enter address" name="address" id="vendadd" required><?php echo $row["Address"] ?></textarea>
            </label>
            <br><br>

            <h3>Change Password</h3>
            <hr><br>
            <label for="pass">Password
              <input placeholder="Enter password" type="password" name="pass" id="pass1">
            </label>
            <br><br>

            <label for="confpass">Confirm Password
              <input placeholder="Enter password" type="password" name="confpass" id="pass2">
            </label>
            <br><br>

            <input type="submit" name="editprofile" value="Edit">

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
<script src="scripts/main.js"></script>

</html>