<?php
include "includes/sessioncheck.php";
include_once "includes/database.php";

if (
  !isset($_POST["vendorId"]) ||
  empty($_POST["conversationMessage"]) ||
  strlen($_POST["conversationMessage"]) > 1024 ||
  strlen($_POST["conversationMessage"]) < 5
) {
  die(header("Location: inbox.php?error=true"));
}

$messageBody = mysqlidb::escape(trim($_POST["conversationMessage"]));
$vendorId = mysqlidb::escape($_POST["vendorId"]);
$userId = $_SESSION["userid"];

try {
  mysqlidb::query("INSERT INTO `message` (`UserId`, `VendorId`, `Sender`, `MessageBody`) VALUES ($userId, $vendorId, 0, '$messageBody')");
} catch (\Throwable $th) {
  die(header("Location: inbox.php?error=true"));
}

die(header("Location: conversation.php?vendorid=$vendorId"));
