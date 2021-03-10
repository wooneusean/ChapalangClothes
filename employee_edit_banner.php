<?php
include("includes/employee_session.php");
include_once("includes/database.php");

if (!isset($_GET['bannerid'])) {
  die(header("location: employee_banner.php"));
}

$bannerid = mysqlidb::escape($_GET['bannerid']);

$error = "";
$success = "";

if (isset($_POST['Submit']) && isset($_POST['bannername']) && isset($_POST['bannerdesc']) && isset($_POST['bannerid'])) {
  if (!empty($_POST['bannername']) && !empty($_POST['bannerdesc']) && !empty($_POST['bannerid'])) {
    try {
      $bannerName = mysqlidb::escape($_POST['bannername']);
      $bannerDesc = mysqlidb::escape($_POST['bannerdesc']);
      $bannerId = mysqlidb::escape($_POST['bannerid']);
      $sql = "UPDATE banner SET BannerName='$bannerName', BannerDescription='$bannerDesc' WHERE BannerId=$bannerId";
      mysqlidb::query($sql);
      $success = "Successfully updated banner!";
    } catch (\Throwable $th) {
      $error = "Unknown error occured!";
    }
  } else {
    $error = "Banner name or banner description must be filled up!";
  }
}

$banner;
try {
  $banner = mysqlidb::fetchRow("SELECT * FROM banner WHERE BannerId=$bannerid");
} catch (\Throwable $th) {
  die(header("location: employee_banner.php"));
}
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
  <title>Edit Banner</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>Edit Banners</h1>
      <div class="employee-wrapper p-2">
        <?php include "includes/employee_sidenav.php"; ?>
        <div>
          <?php if (!empty($error)) {
            echo "<div class=\"card-error\">$error</div>";
          } else if (!empty($success)) {
            echo "<div class=\"card-success\">$success</div>";
          }
          ?>
          <form action="<?php echo $_SERVER['PHP_SELF'] . "?bannerid=" . $bannerid; ?>" method="post">
            <div class="form-input-group">
              <label>Banner Image Preview</label>
              <img class="employee-banner-image" src="<?php echo $banner["BannerImage"]; ?>" alt="" required>
            </div>
            <input type="hidden" name="bannerid" value="<?php echo $bannerid; ?>">
            <div class="form-input-group">
              <label for="bannername">Banner Header</label>
              <input type="text" maxlength="140" name="bannername" id="bannername" value="<?php echo $banner["BannerName"]; ?>" required>
            </div>
            <div class="form-input-group">
              <label for="bannerdesc">Banner Description</label>
              <textarea name="bannerdesc" maxlength="250" id="bannerdesc" required><?php echo $banner["BannerDescription"]; ?></textarea>
            </div>
            <div class="form-input-group">
              <input type="submit" value="Save" name="Submit">
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

</html>