<?php
include "includes/vendor_session.php";
include("includes/database.php");
$vendorid = $_SESSION["vendorid"]; // USE SESSIONS
$rows = mysqlidb::fetchAllRows("SELECT * FROM productorder
INNER JOIN orderitem ON orderitem.OrderId = productorder.OrderId
INNER JOIN product ON product.ProductId = orderitem.ProductId
INNER JOIN user ON user.UserId = productorder.UserId 
WHERE (OrderStatus = 'Shipped' OR OrderStatus = 'To Ship')
AND ProductStatus = 'Approved'
AND VendorId = $vendorid
GROUP BY orderitem.OrderId
ORDER BY PurchaseDate Desc");
$receivedrow = mysqlidb::fetchRow("SELECT SUM(Total.OrderTotal) as Total FROM (SELECT productorder.OrderId, user.Username, productorder.PurchaseDate, productorder.OrderTotal FROM productorder
INNER JOIN orderitem ON orderitem.OrderId = productorder.OrderId
INNER JOIN product ON  product.ProductId = orderitem.ProductId
INNER JOIN user ON user.UserId = productorder.UserId
WHERE (OrderStatus = 'Shipped' OR OrderStatus = 'To Ship')
AND ProductStatus = 'Approved'
AND product.VendorId = $vendorid
GROUP BY productorder.OrderId) as Total");
$balancerow = mysqlidb::fetchRow("SELECT * FROM vendor
WHERE VendorId = $vendorid");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link rel="stylesheet" href="styles/template.css" />
  <link rel="stylesheet" href="styles/vendor.css" />
  <link rel="stylesheet" href="styles/pagetopbar.css" />
  <script src="scripts/Chart.min.js"></script>
  <script src="scripts/luxon.min.js"></script>
  <script src="scripts/luxon.adapter.js"></script>
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
          <h3>Income</h3>
          <hr>

          <canvas id="income-chart">

          </canvas>

          <?php
          echo "<div class=\"total flex flex-row flex-justify-center\">
          <div class=\"m-2\">
            <h3>Total Received</h3>
            <h4>RM " . number_format($receivedrow['Total'], 2) . "</h4>
          </div>

          <div class=\"m-2\">
            <h3>Total Balance</h3>
            <h4>RM " . number_format($balancerow['Balance'], 2) . "</h4>
            <a href=\"vendor_withdraw.php\" class=\"btn-primary p-2 m-1 visited-white\">Withdraw</a>
          </div>
          </div>";
          ?>

          <?php
          // <table style="width: 80%; float: left;">
          //   <tr>
          //     <th width="15%">Order ID</th>
          //     <th width="25%">Customer</th>
          //     <th width="25%">Purchase Date</th>
          //     <th width="15%">Amount Paid</th>
          //   </tr>
          //   <?php
          //   if (count($rows) > 0) {
          //     foreach ($rows as $row) {
          //       echo "
          // <tr>
          // <td>{$row['OrderId']}</td>
          // <td>{$row['Username']}</td>
          // <td>{$row['PurchaseDate']}</td>
          // <td>RM " . number_format($row['OrderTotal'], 2) . "</td>
          // </tr>";
          //     }
          //   } else {
          //     echo "<tr><td colspan=\"4\"><h2 class=\"cultured-dark\">There are no orders.</h2></td></tr>";
          //   }
          // </table>
          ?>


        </div>
      </div>
    </div>
    <br><br>
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footeremployee.html" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/vendor_page.js"></script>
<script>
  <?php
  $dates;
  foreach ($rows as $row) {
    $toMonthly = substr($row['PurchaseDate'], 0, 8);
    $toMonthly .= "01";
    if (!isset($dates[$toMonthly])) {
      $dates[$toMonthly] = $row['OrderTotal'];
    } else {
      $dates[$toMonthly] += $row['OrderTotal'];
    }
  }

  $data = "";
  $lastKey = array_key_last($dates);
  foreach ($dates as $date => $income) {
    if ($date == $lastKey) {
      $data .= "{ x: DateTime.fromISO('$date'), y: $income }";
    } else {
      $data .= "{ x: DateTime.fromISO('$date'), y: $income },";
    }
  }
  ?>

  var DateTime = luxon.DateTime;
  var ctx = document.getElementById('income-chart').getContext('2d');
  var incomeChart = new Chart(ctx, {
    type: 'line',
    data: {
      // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Income (RM)',
        data: [<?php echo "$data" ?>],
        backgroundColor: 'rgba(197, 16, 85, 0.1)',
        borderColor: 'rgb(224, 17, 95)',
        pointBackgroundColor: 'rgb(169, 10, 71)',
        pointBorderColor: 'rgb(192, 12, 81)',
        pointRadius: 4,
        pointHitRadius: 20,
        lineTension: 0
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return 'RM ' + value;
            }
          }
        }],
        xAxes: [{
          type: 'time',
          time: {
            unit: 'month',
            tooltipFormat: 'MMMM yyyy'
          },
          distribution: 'linear',
        }],
      }

    }
  });
</script>

</html>