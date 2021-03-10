<?php
include "includes/vendor_session.php";
include("includes/database.php");
$vendorid = $_SESSION["vendorid"]; // USE SESSIONS
$sql = "UPDATE vendor SET Balance = 0
        WHERE VendorId=$vendorid;";
mysqlidb::query($sql);
header("Location: vendor_income.php");
