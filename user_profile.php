<?php
include_once "includes/sessioncheck.php";
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
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <?php
      $userId = $_SESSION["userid"];
      $user = mysqlidb::fetchRow("SELECT * FROM user WHERE UserId=$userId");
      $purchases = mysqlidb::fetchAllRows("SELECT * FROM productorder WHERE UserId=$userId ORDER BY PurchaseDate DESC");
      ?>
      <div class="profile-wrapper h-4">
        <div class="profile-navbar">
          <a href="user_profile.php">
            <div class="profile-owner flex w-4">
              <img class="profile-pic" src="<?php echo $user["UserImage"] ?>" alt="" />
              <div class="profile-name"><?php echo $user["Username"] ?></div>
            </div>
          </a>
          <a href="#my-profile" class="profile-menu-item flex active">
            <div class="profile-menu-item-icon material-icons unselectable ruby">person</div>
            <div class="profile-menu-item-name">My Profile</div>
          </a>
          <a href="#change-password" class="profile-menu-item flex">
            <div class="profile-menu-item-icon material-icons unselectable ruby">lock</div>
            <div class="profile-menu-item-name">Change Password</div>
          </a>
          <a href="inbox.php" class="profile-menu-item flex">
            <div class="profile-menu-item-icon material-icons unselectable ruby">mail</div>
            <div class="profile-menu-item-name">Inbox</div>
          </a>
          <a href="purchase_history.php#my-purchases" class="profile-menu-item flex">
            <div class="profile-menu-item-icon material-icons unselectable ruby">shopping_basket</div>
            <div class="profile-menu-item-name">My Purchases</div>
          </a>
        </div>
        <div>
          <?php
          if (isset($_GET['message'])) {
            if ($_GET['message'] == "error") {
              echo '<div class="card-error">Error Occured</div>';
            }
            if ($_GET['message'] == "edited") {
              echo '<div class="card-success">Successfully Edited</div>';
            }
          }
          ?>
          <div id="my-profile"></div>
          <div class="profile-body">
            <div class="profile-body-header">My Profile</div>
            <form action="update_user.php" method="POST" enctype="multipart/form-data">
              <div class="form-input-group flex flex-column">
                <label class="block">Profile Picture</label>
                <div class="flex-wrapper flex-column flex-align-center flex-justify-center">
                  <img src="<?php echo $user["UserImage"] ?>" id="userImage" alt="">
                  <input accept="image/jpeg, image/png" type="file" name="picture" id="picture" />
                  <label class="w-2" for="picture">Choose an Image</label>
                </div>
              </div>
              <div class="form-input-group">
                <label class="block" for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $user["Username"] ?>" disabled />
              </div>
              <div class="form-input-group">
                <label class="block" for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $user["Email"] ?>" />
              </div>
              <div class="form-input-group">
                <label class="block" for="gender">Gender</label>
                <select name="gender" id="gender">
                  <option value="Male" <?php echo $user["Gender"] == "Male" ? "selected" : ""; ?>>Male</option>
                  <option value="Female" <?php echo $user["Gender"] == "Female" ? "selected" : ""; ?>>Female</option>
                  <option value="None" <?php echo $user["Gender"] == "None" ? "selected" : ""; ?>>Prefer not to say</option>
                </select>
              </div>
              <div class="form-input-group">
                <label class="block" for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?php echo $user["DOB"] ?>" />
              </div>
              <div class="form-input-group">
                <label class="block" for="address">Address</label>
                <textarea id="address" name="address" rows="4" maxlength="240"><?php echo $user["Address"] ?></textarea>
              </div>
              <div class="form-input-group text-center">
                <input class="w-2" type="submit" id="profile-submit" value="Save" disabled />
              </div>
            </form>
          </div>
          <div id="change-password"></div>
          <div class="profile-body">
            <div class="profile-body-header">Change Password</div>
            <?php
            if (isset($_GET["message"])) {
              switch ($_GET["message"]) {
                case 'same_password':
                  echo '<div class="card-error">Your new password cannot be the same as your old password!</div>';
                  break;
                case 'wrong_password':
                  echo '<div class="card-error">Your old password provided is wrong!</div>';
                  break;
                case 'ok_password':
                  echo '<div class="card-success">Successfully changed password!</div>';
                  break;
              }
            }
            ?>
            <form action="change_password.php" method="POST">
              <div class="form-input-group">
                <label class="block" for="password">Change Password</label>
                <input type="password" id="password" placeholder="Old Password" name="password" />
                <input type="password" id="newpassword" placeholder="New Password" name="newpassword" />
              </div>
              <div class="form-input-group text-center">
                <input class="w-2" type="submit" id="password-submit" value="Save" disabled />
              </div>
            </form>
          </div>
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
<script>
  HandleHash();
  window.addEventListener("hashchange", HandleHash);
</script>

</html>