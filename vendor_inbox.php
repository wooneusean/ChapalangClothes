<?php
include "includes/vendor_session.php";
include_once "includes/database.php";

$vendorid = $_SESSION['vendorid'];

$conversations = mysqlidb::fetchAllRows("SELECT `message`.`MessageId`, `message`.`MessageBody`, `message`.`MessageTimestamp`, `user`.`Username`, `user`.`UserId` FROM `message` LEFT JOIN `user` ON `user`.UserId = `message`.`UserId` WHERE `message`.MessageId IN( SELECT MAX(MessageId) FROM `message` WHERE VendorId=$vendorid GROUP BY UserId ) ORDER BY `message`.MessageTimestamp DESC");
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
          <div>
            <div class="inbox-title">Inbox</div>
            <?php
            if (isset($_GET['error'])) {
              echo '<div class="card-error">Unknown error occured</div>';
            }
            if (count($conversations) > 0) {

              echo '<table class="table">
            <thead>
              <tr>
                <th>Last Message</th>
                <th>User Name</th>
              </tr>
            </thead>
            <tbody>';

              foreach ($conversations as $conversation) {
                echo "<tr>
              <td class=\"ellipsis-truncate\" width=\"75%\">
                <a class=\"underline vis-ruby ruby\" href=\"vendor_conversation.php?userid={$conversation['UserId']}\">
                  {$conversation['MessageBody']}
                </a>
                <div class=\"inbox-timestamp\">Posted on " . date("g:ia d/n/Y", strtotime($conversation['MessageTimestamp'])) . "</div>
              </td>
              <td class=\"ellipsis-truncate\" width=\"25%\">
                <div>{$conversation['Username']}</div>
              </td>
            </tr>";
              }

              echo '</tbody>
          </table>';
            } else {
              echo "<h1 class=\"grey text-center unselectable\">Your inbox is empty!</h1>";
            }
            ?>
          </div>
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