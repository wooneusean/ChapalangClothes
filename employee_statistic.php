<?php
include("includes/employee_session.php");
include_once("includes/database.php");

$ratingData = mysqlidb::fetchAllRows("SELECT COUNT(*) AS Rating,t1.AvgRating FROM (SELECT AVG(`review`.`ReviewRating`) as AvgRating, product.ProductName FROM `review` INNER JOIN product ON product.ProductId = review.ProductId GROUP BY `review`.`ProductId`) t1 GROUP BY t1.AvgRating");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <link href="styles/template.css" type="text/css" rel="stylesheet">
  <link href="styles/pagetopbar.css" type="text/css" rel="stylesheet">
  <link href="styles/khor.css" type="text/css" rel="stylesheet">
  <script src="scripts/Chart.min.js"></script>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <title>View Statistics</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/pagetopbaremployee.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <h1>View Statistics</h1>
      <div class="employee-wrapper">
        <?php include "includes/employee_sidenav.php" ?>
        <div>
          <div class="canvas-container m-b-2">
            <canvas id="trending-chart"></canvas>
          </div>
          <div class="canvas-container m-t-2">
            <canvas id="rating-chart"></canvas>
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
<script src="scripts/main.js"></script>
<script src="scripts/employee_sidenav.js"></script>
<script>
  $(() => {
    var trendingCtx = document.getElementById('trending-chart').getContext('2d');
    var trendingChart = new Chart(trendingCtx, {
      responsive: false,
      maintainAspectRatio: true,
      showScale: false,
      type: 'bar',
      data: {
        labels: [],
        datasets: [{
          label: 'Total Sold',
          data: [],
          backgroundColor: 'rgba(197, 16, 85, 0.1)',
          borderColor: 'rgb(224, 17, 95)',
          borderWidth: 1,
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Trending Items',
          fontSize: 18,
        },
        scales: {
          yAxes: [{
            ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return value + " sold";
              },
              beginAtZero: true,
            }
          }]
        }
      }
    });

    $.post('employee_stats_api.php', {
        type: 'trending'
      },
      (data, textStatus, jqXHR) => {
        const $trendingData = JSON.parse(data);
        $trendingData.forEach(e => {
          trendingChart.data.labels.push(e.ProductName);
          trendingChart.data.datasets.forEach((dataset) => {
            dataset.data.push(e.Purchases);
          });
        });
        trendingChart.update(0);
      });

    var ratingCtx = document.getElementById('rating-chart').getContext('2d');
    var ratingChart = new Chart(ratingCtx, {
      responsive: false,
      maintainAspectRatio: true,
      showScale: false,
      type: 'bar',
      data: {
        labels: ['5', '4', '3', '2', '1'],
        datasets: [{
          label: 'Products Rated',
          data: [],
          backgroundColor: 'rgba(197, 16, 85, 0.1)',
          borderColor: 'rgb(224, 17, 95)',
          borderWidth: 1,
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Average Ratings',
          fontSize: 18,
        },
        tooltips: {
          callbacks: {
            title: function(item) {
              return "Rated " + item[0].label + ' stars or higher';
            }
          }
        },
        scales: {
          yAxes: [{
            ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return value + " products";
              },
              beginAtZero: true,
            }
          }],
          xAxes: [{
            ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return value + " stars";
              },
              beginAtZero: true,
            }
          }]
        }
      }
    });
    $.post('employee_stats_api.php', {
        type: 'rating'
      },
      (data, textStatus, jqXHR) => {
        const $ratingData = JSON.parse(data);
        console.log($ratingData);
        const adjustedValues = [];
        for (let i = 0; i < 5; i++) {
          adjustedValues[i + 1] = 0;
        }
        $ratingData.forEach(e => {
          var val = parseFloat(e.AvgRating).toFixed();
          adjustedValues[val] = parseInt(adjustedValues[val]) + parseInt(e.Products);
        });
        adjustedValues.reverse().forEach(e => {
          ratingChart.data.datasets.forEach((dataset) => {
            dataset.data.push(e);
          });
        });
        console.log(adjustedValues);
        ratingChart.update(0);
      });
  });
</script>

</html>