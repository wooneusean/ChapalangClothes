<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <title>Contact Us - Chapalang Clothes</title>
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
    <div class="content-wrapper container card-generic about-us">
      <h1>Contact Us</h1>
      <hr>
      <form action="contact.php" method="post" id="contact-form">
        <div class="form-input-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="John Doe">
        </div>
        <div class="form-input-group">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" placeholder="john.doe@mail.com">
        </div>
        <div class="form-input-group">
          <label for="message">Message</label>
          <textarea name="message" id="message" placeholder="Your message here..."></textarea>
        </div>
        <div class="form-input-group text-center">
          <input type="submit" value="Submit" class="w-2">
        </div>
      </form>
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
<script src="scripts/search_bar.js"></script>
<script src="scripts/contact_page.js"></script>

</html>