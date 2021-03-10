<?php
include_once 'includes/database.php';
$banners = mysqlidb::fetchAllRows("SELECT * FROM banner");

$offset = 0;
$perPage = 30;

if (isset($_GET["page"])) {
  if ($num = intval($_GET["page"])) {
    $offset = ($num * $perPage) - $perPage;
  }
}

$products = mysqlidb::fetchAllRows(
  "SELECT t1.*, IFNULL(AVG(review.ReviewRating), 0) AS ProductRating FROM( SELECT product.*, orderitem.OrderItemId, orderitem.OrderId, orderitem.ProductQuantity, IFNULL( SUM(orderitem.ProductQuantity), 0) AS TotalSold FROM product LEFT JOIN orderitem ON orderitem.ProductId = product.ProductId WHERE ( ProductStatus = 'Approved' AND ProductStock > 0 ) GROUP BY product.ProductId, orderitem.ProductId ORDER BY `TotalSold` DESC ) t1 LEFT JOIN review ON review.ProductId = t1.ProductId GROUP BY t1.ProductId ORDER BY t1.TotalSold DESC , t1.ProductId ASC LIMIT $offset, $perPage"
);

$trending = mysqlidb::fetchAllRows(
  "SELECT COUNT(*) as Purchases, orderitem.ProductId, product.ProductName, product.ProductPrice, product.ProductImage 
  FROM orderitem 
  INNER JOIN product ON product.ProductId = orderitem.ProductId 
  WHERE product.ProductStatus='Approved' 
  GROUP BY orderitem.ProductId 
  ORDER BY Purchases DESC LIMIT 6"
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <title>Chapalang Clothes</title>
</head>

<body>
  <?php include "includes/storetopbar.php" ?>

  <!-- ----------------------------------- MODAL ----------------------------------- -->
  <!-- <div  class="modal-background modal">
    <div class="modal-content center-in-page-abs">
      <div onclick="DismissModal()" class="material-icons modal-close-button white">close</div>
      <div class="modal-body">
        everything is 100% off buy everything for free!
      </div>
    </div>
  </div> -->
  <!-- ----------------------------------- MODAL ----------------------------------- -->

  <div class="body-wrapper">

    <!-- ----------------------------------- TOP-BAR-PLACEHOLDER ----------------------------------- -->
    <div></div>
    <!-- ----------------------------------- TOP-BAR-PLACEHOLDER ----------------------------------- -->

    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <div class="item-listings-wrapper">
        <div class="special-offers bg-white">
          <div class="carousel bg-white">
            <div class="carousel-items">
              <?php
              foreach ($banners as $banner) {
                echo "<div class=\"carousel-item carousel-active\">
                        <img src=\"{$banner['BannerImage']}\" alt=\"{$banner['BannerName']}\">
                        <div class=\"carousel-item-details transparent\">
                          <div class=\"carousel-item-name\">{$banner['BannerName']}</div>
                          <div class=\"carousel-item-description\">{$banner['BannerDescription']}</div>
                        </div>
                      </div>";
              }
              ?>
            </div>
            <div class="carousel-navigation transparent flex">
              <div class="carousel-btn-left white material-icons md-36 unselectable">navigate_before</div>
              <div class="carousel-btn-right white material-icons md-36 unselectable">navigate_next</div>
            </div>
            <div class="carousel-indicators flex">

            </div>
          </div>
          <div class="special-offers-trending bg-white">
            <div class="trending-header">
              <span class="material-icons unselectable md-24 ruby trending-icon">whatshot</span>
              TRENDING PRODUCTS
            </div>
            <div class="flex h-4">
              <?php
              if (count($trending) > 0) {
                foreach ($trending as $trendingItem) {
                  $imageUrl = explode(",", $trendingItem["ProductImage"])[0];
                  echo '<a href="item.php?id=' . $trendingItem["ProductId"] . '" class="trending-item"><img src="' . $imageUrl . '" alt="">
                          <div class="trending-name ellipsis-truncate">' . $trendingItem["ProductName"] . '</div>
                          <div class="trending-price">From <span class="ruby">RM ' . number_format($trendingItem["ProductPrice"], 2) . '</span></div>
                        </a>';
                }
              } else {
                echo '<h3 class="cultured-dark m-a">There are no trending items currently.</h3>';
              }
              ?>
            </div>
          </div>
        </div>
        <div class="flex-wrapper">
          <?php
          foreach ($products as $product) {
            $productImage = explode(",", $product['ProductImage'])[0];
            echo "<a class=\"item-card bg-white\" href=\"item.php?id={$product['ProductId']}\">
                    <img class=\"item-image\" src=\"{$productImage}\" alt=\"\" />
                    <div class=\"item-details\">
                      <div class=\"item-name\">
                        {$product['ProductName']}
                      </div>
                      <div class=\"item-total-sold cultured-dark text-right\">
                      " . number_format($product['TotalSold'], 0) . " sold</div>
                      <div class=\"flex flex-justify-space-between\">
                        <div class=\"item-price rubine-red\">
                          RM <span class=\"item-price-highlighted\">
                          " . number_format($product['ProductPrice'], 2) . "
                          </span>
                        </div>
                        <div class=\"item-ratings ruby\">
                          " . number_format($product['ProductRating'], 1) . "
                          <span class=\"material-icons md-18 unselectable\">star_rate</span>
                        </div>
                      </div>
                    </div>
                  </a>";
          }
          ?>
        </div>
        <?php
        $numrows = mysqlidb::fetchRow("SELECT COUNT(*) as NumRows from product WHERE (ProductStatus='Approved' AND ProductStock>0)")["NumRows"];
        if (($numrows / $perPage) > 1) {
        ?>
          <div class="flex flex-justify-center pagination-links">
            <a class="pagination">&laquo;</a>
            <?php
            $pages = ceil($numrows / $perPage);
            for ($i = 1; $i < $pages + 1; $i++) {
              echo "<a class=\"pagination\" data-page=\"$i\">$i</a>";
            }
            ?>
            <a class="pagination">&raquo;</a>
          </div>
        <?php } ?>
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
<script src="scripts/carousel.js"></script>
<script src="scripts/pagination.js"></script>

</html>