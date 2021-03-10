<?php
include "includes/sessioncheck.php";
include_once "includes/database.php";

$userId = $_SESSION['userid'];

$conversations = mysqlidb::fetchAllRows("SELECT `message`.`MessageId`,`message`.`MessageBody`,`message`.`MessageTimestamp`, vendor.ShopName, vendor.VendorId FROM `message` LEFT JOIN vendor ON vendor.VendorId = `message`.VendorId WHERE `message`.MessageId IN( SELECT MAX(MessageId) FROM `message` WHERE UserId = $userId GROUP BY VendorId ) ORDER BY `message`.MessageTimestamp DESC ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <title>Inbox - Chapalang Clothes</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php"; ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->

  <!-- ----------------------------------- MODAL ----------------------------------- -->

  <!-- ----------------------------------- MODAL ----------------------------------- -->

  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container card-generic">
      <div class="p-2">
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
                <th>Shop Name</th>
              </tr>
            </thead>
            <tbody>';

          foreach ($conversations as $conversation) {
            echo "<tr>
              <td class=\"ellipsis-truncate\" width=\"75%\">
                <a class=\"underline vis-ruby ruby\" href=\"conversation.php?vendorid={$conversation['VendorId']}\">
                  {$conversation['MessageBody']}
                </a>
                <div class=\"inbox-timestamp\">Posted on " . date("g:ia d/n/Y", strtotime($conversation['MessageTimestamp'])) . "</div>
              </td>
              <td class=\"ellipsis-truncate\" width=\"25%\">
                <div>{$conversation['ShopName']}</div>
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

  <!-- ----------------------------------- BODY ----------------------------------- -->

  <!-- ----------------------------------- FOOTER ----------------------------------- -->
  <?php include "includes/footer.php" ?>
  <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<?php include "includes/store_scripts.php"; ?>

</html>