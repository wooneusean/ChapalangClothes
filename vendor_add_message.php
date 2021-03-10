<?php
include "includes/vendor_session.php";
include_once "includes/database.php";

if (
  !isset($_POST["userId"]) ||
  empty($_POST["conversationMessage"]) ||
  strlen($_POST["conversationMessage"]) > 1024 ||
  strlen($_POST["conversationMessage"]) < 5
) {
  die(header("Location: vendor_inbox.php?error=true"));
}

$messageBody = mysqlidb::escape(trim($_POST["conversationMessage"]));
$vendorId = $_SESSION["vendorid"];
$userId = mysqlidb::escape($_POST["userId"]);

try {
  mysqlidb::query("INSERT INTO `message` (`UserId`, `VendorId`, `Sender`, `MessageBody`) VALUES ($userId, $vendorId, 1, '$messageBody')");
} catch (\Throwable $th) {
  die(header("Location: vendor_inbox.php?error=true"));
}

die(header("Location: vendor_conversation.php?userid=$userId"));
