<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link rel="stylesheet" href="styles/style.css" />
  <title>Error - Chapalang Clothes</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php"; ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container text-center card-generic">
      <?php
      if (isset($_GET["error"])) {
        $error = $_GET["error"];
        switch ($error) {
          case 'cart':
            echo '<h1>There has been an error in handling your shopping cart.</h1>';
            break;
          case 'upload':
            echo '<h1>There has been an error in uploading your file(s).</h1>';
            break;
          case 'bad_item':
            echo '<h1>The item you are looking for does not exist or is blacklisted.</h1>';
            break;
          case 'review':
            echo '<h1>There is an error submitting your review.</h1>';
            break;
          case 'user_not_exist':
            echo '<h1>The user does not exist.</h1>';
            break;
          default:
            echo '<h1>An unknown error occured.</h1>';
            break;
        }
      } else {
        echo '<h1>An unknown error occured.</h1>';
      }
      ?>
      <a class="vis-ruby" href="index.php">
        <h2>Return to home</h2>
      </a>
    </div>
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footer.php" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<?php include "includes/store_scripts.php"; ?>
<script src="scripts/search_bar.js"></script>

</html>