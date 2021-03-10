<?php
include("includes/employee_session.php");
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
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <title>Add Banner</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>Add Banner</h1>
      <div class="employee-wrapper p-2">
        <?php include "includes/employee_sidenav.php"; ?>
        <form action="employee_adding_banner.php" method="post" enctype="multipart/form-data">
          <div class="form-input-group flex flex-column">
            <div class="flex-wrapper flex-column">
              <label for="bannerimage">Banner Image (Preferably 1200x300)</label>
              <img class="employee-banner-image" src="" id="image" alt="">
              <input accept="image/jpeg, image/png" type="file" name="bannerimage" id="bannerimage" required />
            </div>
          </div>
          <input type="hidden" name="bannerid" required>
          <div class="form-input-group">
            <label for="bannername">Banner Header</label>
            <input type="text" maxlength="140" name="bannername" id="bannername" required>
          </div>
          <div class="form-input-group">
            <label for="bannerdesc">Banner Description</label>
            <textarea name="bannerdesc" maxlength="250" id="bannerdesc" required></textarea>
          </div>
          <div class="form-input-group">
            <input type="submit" value="Add" name="Submit">
          </div>
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
<script src="scripts/main.js"></script>
<script src="scripts/employee_sidenav.js"></script>
<script src="scripts/employee_add_banner.js"></script>

</html>