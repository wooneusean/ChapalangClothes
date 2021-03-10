<?php
include "includes/sessioncheck.php";
include_once "includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="styles/user_profile.css" />
  <title>User Profile</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php"; ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->

  <!-- ----------------------------------- MODAL ----------------------------------- -->
  <div class="modal-background modal hidden">
    <div class="modal-content center-in-page-abs">
      <div onclick="DismissModal()" class="material-icons modal-close-button white">close</div>
      <div class="modal-body">
        <form action="report.php" id="form-report">
          <input type="hidden" name="productid" id="form-report-productid" value="1">
          <div class="form-input-group">
            <label for="reason" class="block">Reason</label>
            <select name="reason" id="reason">
              <option value="Fake">This is a fake product.</option>
              <option value="FalseAd">This vendor falsly advertised their product.</option>
              <option value="InappropriateName">The name for this product is inappropriate.</option>
              <option value="InappropriatePicture">The picture used for this product is inappropriate.</option>
            </select>
          </div>
          <div class="form-input-group">
            <div id="btn-report-item" class="btn-primary" onclick="SendReportData();">Report</div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal-background modal hidden">
    <div class="modal-content center-in-page-abs product-modal">
      <div onclick="DismissModal(1)" class="material-icons modal-close-button white">close</div>
      <div class="modal-body">
        <div class="flex flex-justify-center flex-align-center">
          <div class="material-icons md-48 unselectable ruby">info</div>
          <div class="modal-text">Successfully reported product.</div>
        </div>
        <div class="btn-primary w-3 m-0-a" onclick="DismissModal(1);">Ok</div>
      </div>
    </div>
  </div>

  <div class="modal-background modal hidden">
    <div class="modal-content center-in-page-abs product-modal">
      <div onclick="DismissModal(2)" class="material-icons modal-close-button white">close</div>
      <div class="modal-body">
        <div class="flex flex-justify-center flex-align-center">
          <div class="material-icons md-48 unselectable ruby">info</div>
          <div class="modal-text">Failed to report product, unknown error occured.</div>
        </div>
        <div class="btn-primary w-3 m-0-a" onclick="DismissModal(2);">Ok</div>
      </div>
    </div>
  </div>
  <!-- ----------------------------------- MODAL ----------------------------------- -->

  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <?php
      $userId = $_SESSION["userid"];
      $user = mysqlidb::fetchRow("SELECT * FROM user WHERE UserId=$userId");
      ?>
      <div class="profile-wrapper h-4">
        <div class="profile-navbar">
          <a href="user_profile.php">
            <div class="profile-owner flex w-4">
              <img class="profile-pic" src="<?php echo $user["UserImage"] ?>" alt="" />
              <div class="profile-name"><?php echo $user["Username"] ?></div>
            </div>
          </a>
          <a href="user_profile.php#my-profile" class="profile-menu-item flex active">
            <div class="profile-menu-item-icon material-icons unselectable ruby">person</div>
            <div class="profile-menu-item-name">My Profile</div>
          </a>
          <a href="user_profile.php#change-password" class="profile-menu-item flex">
            <div class="profile-menu-item-icon material-icons unselectable ruby">lock</div>
            <div class="profile-menu-item-name">Change Password</div>
          </a>
          <a href="inbox.php" class="profile-menu-item flex">
            <div class="profile-menu-item-icon material-icons unselectable ruby">mail</div>
            <div class="profile-menu-item-name">Inbox</div>
          </a>
          <a href="#my-purchases" class="profile-menu-item flex">
            <div class="profile-menu-item-icon material-icons unselectable ruby">shopping_basket</div>
            <div class="profile-menu-item-name">My Purchases</div>
          </a>
        </div>
        <div>
          <div id="my-purchases"></div>
          <div class="profile-body-header m-t-2">My Purchases</div>
          <?php
          if (isset($_GET["message"])) {
            switch ($_GET["message"]) {
              case 'refund_success':
                echo '<div class="card-success">Successfully applied for refund!</div>';
                break;
              case 'refund_fail':
                echo '<div class="card-error">Failed to apply for refund!</div>';
                break;
            }
          }

          $orders = mysqlidb::fetchAllRows("SELECT productorder.OrderId,productorder.PurchaseDate,productorder.OrderTotal,orderitem.ProductId,orderitem.ProductQuantity,orderitem.OrderStatus,product.ProductPrice,product.ProductName FROM productorder INNER JOIN orderitem ON orderitem.OrderId = productorder.OrderId INNER JOIN product ON orderitem.ProductId = product.ProductId WHERE UserId=$userId ORDER BY PurchaseDate DESC, OrderId DESC ");


          if (count($orders) > 0) {
            $prevOrderId = -1;
            for ($i = 0; $i < count($orders); $i++) {
              if ($orders[$i]["OrderId"] != $prevOrderId) {
                echo "<div class=\"purchase-item\">
                        <div class=\"purchase-item-header flex\">
                          <div class=\"purchase-item-header-details\">Ordered on <span class=\"ruby\">{$orders[$i]['PurchaseDate']}</span></div>
                        </div>
                        <div class=\"purchase-item-body\">";
              }
              $prevOrderId = $orders[$i]['OrderId'];
              echo "<div class=\"purchase-item-record\">
                      <div class=\"purchase-item-name ellipsis-truncate\">
                        <a href=\"item.php?id={$orders[$i]['ProductId']}\">
                        {$orders[$i]['ProductName']}
                        </a>
                      </div>
                      <div class=\"purchase-item-quanity\"><span class=\"material-icons md-12 unselectable\">close</span>{$orders[$i]['ProductQuantity']}</div>
                      <div class=\"purchase-item-price\">RM " . number_format($orders[$i]['ProductPrice'], 2) . "</div>
                      <div class=\"purchase-item-actions flex-wrapper\">";

              echo "<a class=\"pointer\" onclick=\"ShowReportModal({$orders[$i]['ProductId']})\"\">Report</a>";

              if ($orders[$i]['OrderStatus'] != "Refund") {
                if ($orders[$i]['OrderStatus'] != "RefundPending") {
                  echo "<a href=\"refundapplication.php?productid={$orders[$i]['ProductId']}&orderid={$orders[$i]['OrderId']}\">Refund</a>";
                } else {
                  echo "<div class=\"ruby bold\">Pending Refund</div>";
                }
              } else {
                echo "<div class=\"ruby bold\">Refunded</div>";
              }

              echo "</div>
                    </div>";

              if ($i + 1 <= count($orders) - 1) {
                if ($orders[$i + 1]["OrderId"] != $prevOrderId) {
                  echo "</div>
                  <div class=\"purchase-item-footer\">
                  <a class=\"white vis-white w-3\" href=\"orderinformation.php?orderid={$orders[$i]['OrderId']}\"><div class=\"btn-primary\">View Details</div></a>
                    <div class=\"m-r-2\">Total</div>
                    <div class=\"purchase-item-total ruby\">RM " . number_format($orders[$i]['OrderTotal'], 2) . "</div>
                  </div>
                </div>";
                }
              } else {
                echo "</div>
                <div class=\"purchase-item-footer\">
                <a class=\"white vis-white w-3\" href=\"orderinformation.php?orderid={$orders[$i]['OrderId']}\"><div class=\"btn-primary\">View Details</div></a>
                  <div class=\"m-r-2\">Total</div>
                  <div class=\"purchase-item-total ruby\">RM " . number_format($orders[$i]['OrderTotal'], 2) . "</div>
                </div>
              </div>";
              }
            }
          } else {
            echo "<h1 class=\"text-center cultured-dark\">No purchases to show.</h1>";
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
<script src="scripts/user_profile_page.js"></script>
<script src="scripts/purchase_history_page.js"></script>
<script>
  HandleHash();
  window.addEventListener("hashchange", HandleHash);
</script>

</html>