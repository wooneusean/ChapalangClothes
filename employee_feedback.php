<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$rows = mysqlidb::fetchAllRows("SELECT * FROM feedback");

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
  <title>View Feedback</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>View Feedback</h1>
      <div class="employee-wrapper">
        <?php include "includes/employee_sidenav.php" ?>
        <table class="employee-table bg-white">
          <thead>
            <tr>
              <th width="20%" class="employee-table-header-tl">Name</th>
              <th width="20%">Email</th>
              <th width="60%" class="employee-table-header-tr">Message</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (count($rows) > 0) {
              foreach ($rows as $row) {
                echo "<tr>
                        <td width=\"25%\">{$row['FeedbackName']}</td>
                        <td width=\"25%\">{$row['FeedbackEmail']}</td>
                        <td width=\"50%\" class=\"pre-line\">{$row['FeedbackMessage']}</td>
                    </tr>";
              }
            } else {
              echo "<tr><td colspan=\"4\"><h2 class=\"cultured-dark\">There is no feedback yet.</h2></td></tr>";
            }
            ?>
          </tbody>
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