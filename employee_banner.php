<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$rows = mysqlidb::fetchAllRows("SELECT * FROM banner");
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
  <title>Manage Banners</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>Manage Banners</h1>
      <div class="employee-wrapper p-2">
        <?php include "includes/employee_sidenav.php" ?>
        <div>
          <?php if (isset($_GET["error"])) {
            echo "<div class=\"card-error\">Error occured.</div>";
          } else if (isset($_GET["success"])) {
            echo "<div class=\"card-success\">Success!</div>";
          } ?>

          <a href="employee_add_banner.php">
            <div class="btn-primary btn-add-banner">
              <i class="material-icons icons white">add</i>
              Add Banner
            </div>
          </a>
          <table class="employee-table bg-white">
            <tr>
              <th width="25%">Banner Header</th>
              <th width="50%">Banner Description</th>
              <th class="employee-table-header-tr" width="25%">Action</th>
            </tr>
            <?php
            if (count($rows) > 0) {
              foreach ($rows as $row) {
                echo "<tr>
                        <td width=\"25%\">{$row['BannerName']}</td>
                        <td width=\"50%\">{$row['BannerDescription']}</td>
                        <td width=\"25%\">
                            <a href=\"employee_edit_banner.php?bannerid={$row['BannerId']}\" class=\"btn-primary p-1 visited-white\"><i class=\"material-icons icons white\">edit</i>Edit</a><a href=\"employee_delete_banner.php?bannerid={$row['BannerId']}\" class=\"btn-primary p-1 visited-white\"><i class=\"material-icons icons white\">delete</i>Delete</a>
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