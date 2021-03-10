<?php

include "includes/sessioncheck.php";
include_once "includes/database.php";

$productId = mysqlidb::escape($_POST["productid"]);
$reason = mysqlidb::escape($_POST["reason"]);

if (empty($productId) || empty($reason)) {
  die(http_response_code(404));
}

if (mysqlidb::query("INSERT INTO report (ProductId,ReportReason) VALUES ($productId, '$reason')")) {
  die(http_response_code(200));
} else {
  die(http_response_code(404));
}
