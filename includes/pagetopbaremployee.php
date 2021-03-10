<?php
include("includes/employee_session.php");
include_once("includes/database.php");
$row = mysqlidb::fetchRow("SELECT * FROM employee WHERE EmployeeId = '{$_SESSION['employeeid']}'");
?>

<div class="top-bar white">
    <div class="top-bar-wrapper container">
        <div class="top-bar-elements">
            <div class="top-bar-left">
            </div>
            <div class="top-bar-right">
                <a class="m-0"><?php echo "$row[Username]";?></a>
                |
                <a href="logout.php"> Logout</a>
            </div>
        </div>
        <div class="top-bar-header">
            <a class="top-bar-logo-wrapper"><img class="chapalang-logo" src="images/logo.png" alt="" /></a>
            <div class="top-bar-title">
                Employee
            </div>
        </div>
    </div>
</div>



