<?php
if (!isset($_GET["userid"]) || !is_numeric($_GET["userid"])) {
  die(header("Location: vendor_inbox.php"));
}
include "includes/vendor_session.php";
include_once "includes/database.php";

$vendorId = mysqlidb::escape($_SESSION['vendorid']);
$userId = mysqlidb::escape($_GET["userid"]);

$vendorData;
$userData;
$convoMessages;
try {
  $vendorData = mysqlidb::fetchRow("SELECT * FROM vendor WHERE VendorId=$vendorId");
  $userData = mysqlidb::fetchRow("SELECT * FROM user WHERE UserId=$userId");
  $convoMessages = mysqlidb::fetchAllRows("SELECT Sender,MessageBody,MessageTimestamp FROM `message` WHERE UserId=$userId AND VendorId=$vendorId ORDER BY MessageTimestamp ASC, MessageId ASC ");
  mysqlidb::query("UPDATE `message` SET MessageReadVendor=1 WHERE UserId=$userId AND VendorId=$vendorId");
} catch (\Throwable $th) {
  die(header("Location: vendor_inbox.php?error=true"));
}

if (!$userData) {
  die(header("Location: vendor_inbox.php?error=true"));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <script src="scripts/jquery-3.5.1.min.js"></script>
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
            <a href="vendor_inbox.php" class="ruby vis-ruby underline m-l-1">Back to Inbox</a>
            <div class="conversation-title">
              Conversation with <b><?php echo $userData["Username"]; ?></b>
            </div>
            <?php

            if (count($convoMessages) > 0) {
              foreach ($convoMessages as  $message) {
                echo "<table class=\"conversation\">
            <tbody>
              <tr>
                <th width=\"20%\">
                  <div class=\"conversation-timestamp\">Posted on 
                  " . date('g:ia d/n/Y', strtotime($message['MessageTimestamp'])) . "
                  </div>
                </th>
                <th width=\"80%\">
  
                </th>
              </tr>
              <tr>
                <td class=\"ellipsis-truncate\" width=\"20%\">
                  <div class=\"flex flex-align-center flex-justify-center conversation-user-container\">
                    <div class=\"conversation-user\">
                      <div class=\"text-center bold m-b-1\">" . ($message['Sender'] == 0 ? $userData['Username'] : $vendorData['ShopName']) . "</div>
                      <img src=\"" . ($message['Sender'] == 0 ? $userData['UserImage'] : $vendorData['VendorImage']) . "\" alt=\"\">
                    </div>
                  </div>
                </td>
                <td width=\"80%\">
                  <div class=\"conversation-message pre-line\">$message[MessageBody]</div>
                </td>
              </tr>
            </tbody>
          </table>";
              }
            } else {
              echo "<h1 class=\"grey text-center unselectable\">You have no conversations with this user.</h1>
          <h2 class=\"grey text-center unselectable\">Start one by sending a message.</h2>";
            }
            ?>
            <a href="vendor_inbox.php" class="ruby vis-ruby underline m-l-1">Back to Inbox</a>

            <form id="messageform" action="vendor_add_message.php" method="POST">
              <input type="hidden" name="userId" value="<?php echo $userId; ?>">
              <div class="form-input-group">
                <label for="conversationMessage">Message: </label>
                <textarea name="conversationMessage" id="conversationMessage" maxlength="1024" minlength="5" required></textarea>
              </div>
              <div class="form-input-group">
                <input class="w-1" type="button" value="Send" onclick="SubmitMessage();">
              </div>
            </form>
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
<script src="scripts/vendor_conversation_page.js"></script>

</html>