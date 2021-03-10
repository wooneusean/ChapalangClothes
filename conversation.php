<?php
if (!isset($_GET["vendorid"]) || !is_numeric($_GET["vendorid"])) {
  die(header("Location: inbox.php"));
}
include "includes/sessioncheck.php";
include_once "includes/database.php";

$userId = mysqlidb::escape($_SESSION['userid']);
$vendorId = mysqlidb::escape($_GET["vendorid"]);

$vendorData;
$userData;
$convoMessages;
try {
  $vendorData = mysqlidb::fetchRow("SELECT * FROM vendor WHERE VendorId=$vendorId");
  $userData = mysqlidb::fetchRow("SELECT * FROM user WHERE UserId=$userId");
  $convoMessages = mysqlidb::fetchAllRows("SELECT Sender,MessageBody,MessageTimestamp FROM `message` WHERE UserId=$userId AND VendorId=$vendorId ORDER BY MessageTimestamp ASC, MessageId ASC ");
  mysqlidb::query("UPDATE `message` SET MessageReadUser=1 WHERE UserId=$userId AND VendorId=$vendorId");
} catch (\Throwable $th) {
  die(header("Location: inbox.php?error=true"));
}

if (!$vendorData) {
  die(header("Location: inbox.php?error=true"));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <title>Conversation with <?php echo $vendorData["ShopName"]; ?> - Chapalang Clothes</title>
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
      <div class="p-r-2 p-l-2 p-t-1">
        <a href="inbox.php" class="ruby vis-ruby underline m-l-1">Back to Inbox</a>
        <div class="conversation-title">
          Conversation with <b><?php echo $vendorData["ShopName"]; ?></b>
        </div>
        <?php

        if (count($convoMessages) > 0) {
          foreach ($convoMessages as  $message) {
            echo "<table class=\"conversation\">
            <tbody>
              <tr>
                <th width=\"18%\">
                  <div class=\"conversation-timestamp\">Posted on 
                  " . date('g:ia d/n/Y', strtotime($message['MessageTimestamp'])) . "
                  </div>
                </th>
                <th width=\"82%\">
  
                </th>
              </tr>
              <tr>
                <td class=\"ellipsis-truncate\" width=\"18%\">
                  <div class=\"flex flex-align-center flex-justify-center conversation-user-container\">
                    <div class=\"conversation-user\">
                      <div class=\"text-center bold m-b-1\">" . ($message['Sender'] == 0 ? $userData['Username'] : $vendorData['ShopName']) . "</div>
                      <img src=\"" . ($message['Sender'] == 0 ? $userData['UserImage'] : $vendorData['VendorImage']) . "\" alt=\"\">
                    </div>
                  </div>
                </td>
                <td width=\"82%\">
                  <div class=\"conversation-message pre-line\">$message[MessageBody]</div>
                </td>
              </tr>
            </tbody>
          </table>";
          }
        } else {
          echo "<h1 class=\"grey text-center  unselectable\">You have no conversations with this seller.</h1>
          <h2 class=\"grey text-center unselectable\">Start one by sending a message.</h2>";
        }
        ?>
        <a href="inbox.php" class="ruby vis-ruby underline m-l-1">Back to Inbox</a>

        <form id="messageform" action="add_message.php" method="POST">
          <input type="hidden" name="vendorId" value="<?php echo $vendorId; ?>">
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

  <!-- ----------------------------------- BODY ----------------------------------- -->

  <!-- ----------------------------------- FOOTER ----------------------------------- -->
  <?php include "includes/footer.php" ?>
  <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<?php include "includes/store_scripts.php"; ?>
<script src="scripts/conversation_page.js"></script>

</html>