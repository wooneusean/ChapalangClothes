<?php
include_once 'includes/database.php';
$q = isset($_GET['q']) ? $_GET['q'] : "";
$min = isset($_GET['min']) ? intval($_GET['min']) : 0;
$max = isset($_GET['max']) ? intval($_GET['max']) : 0;
$stars = isset($_GET['stars']) ? $_GET['stars'] : -1;
$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : "";
$sort = isset($_GET['sort']) ? $_GET['sort'] : "";

$q_esc = mysqlidb::escape($q);
$min_esc = mysqlidb::escape($min);
$max_esc = mysqlidb::escape($max);
$stars_esc = mysqlidb::escape($stars);
$sortby_esc = mysqlidb::escape($sortby);
$sort_esc = mysqlidb::escape($sort);

$sortby_query = " ORDER BY resultTable.TotalSold DESC, resultTable.ProductID ASC";
if ($sortby_esc == "") {
  $sortby_query = " ORDER BY resultTable.TotalSold DESC, resultTable.ProductID ASC";
} else {
  $sortby_query = " ORDER BY $sortby_esc $sort_esc, resultTable.TotalSold DESC, resultTable.ProductID ASC";
}

$star_query = " AND ProductRating >= $stars_esc";

$minmax_query = "";
if ($max_esc > 0 && $min_esc > 0) {
  $minmax_query = " AND ProductPrice BETWEEN $min_esc AND $max_esc";
} else if ($max_esc > 0 && $min_esc == 0) {
  $minmax_query = " AND ProductPrice <= $max_esc";
} else if ($max_esc == 0 && $min_esc > 0) {
  $minmax_query = " AND ProductPrice >= $min_esc";
}

$offset = 0;
$perPage = 25;

if (isset($_GET["page"])) {
  if ($num = intval($_GET["page"])) {
    $offset = ($num * $perPage) - $perPage;
  }
}

$limitQuery = " LIMIT $offset, $perPage ";

$fullQuery = "SELECT * FROM( SELECT t1.*, IFNULL(AVG(review.ReviewRating), 0) AS ProductRating FROM ( SELECT product.*, orderitem.OrderItemId, orderitem.OrderId, orderitem.ProductQuantity, IFNULL( SUM(orderitem.ProductQuantity), 0) AS TotalSold FROM product LEFT JOIN orderitem ON orderitem.ProductId = product.ProductId WHERE ( product.ProductName LIKE '%$q_esc%' OR product.ProductDescription LIKE '%$q_esc%' OR product.ProductTags LIKE '%$q_esc%' ) GROUP BY product.ProductId, orderitem.ProductId ORDER BY `TotalSold` DESC ) t1 LEFT JOIN review ON review.ProductId = t1.ProductId GROUP BY t1.ProductId ORDER BY t1.TotalSold DESC , t1.ProductId ASC ) resultTable WHERE resultTable.ProductStatus = 'Approved' " . $minmax_query . $star_query . $sortby_query . $limitQuery;

$rows = mysqlidb::fetchAllRows($fullQuery);

$numrows = mysqlidb::fetchRow("SELECT COUNT(*) as NumRows FROM( SELECT t1.*, IFNULL(AVG(review.ReviewRating), 0) AS ProductRating FROM ( SELECT product.*, orderitem.OrderItemId, orderitem.OrderId, orderitem.ProductQuantity, IFNULL( SUM(orderitem.ProductQuantity), 0) AS TotalSold FROM product LEFT JOIN orderitem ON orderitem.ProductId = product.ProductId WHERE ( product.ProductName LIKE '%$q_esc%' OR product.ProductDescription LIKE '%$q_esc%' OR product.ProductTags LIKE '%$q_esc%' ) GROUP BY product.ProductId, orderitem.ProductId ORDER BY `TotalSold` DESC ) t1 LEFT JOIN review ON review.ProductId = t1.ProductId GROUP BY t1.ProductId ORDER BY t1.TotalSold DESC , t1.ProductId ASC ) resultTable WHERE resultTable.ProductStatus = 'Approved' " . $minmax_query . $star_query . $sortby_query)["NumRows"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="images/shirtlogo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <title>Search results for "<?php echo $q_esc ?>"</title>
</head>

<body>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <?php include "includes/storetopbar.php" ?>
  <!-- ----------------------------------- TOP-BAR ----------------------------------- -->
  <div class="body-wrapper">
    <div></div>
    <!-- ----------------------------------- BODY ----------------------------------- -->
    <div class="content-wrapper container">
      <div class="search-result-header cultured-dark">
        <div>
          <span class="material-icons unselectable">info</span>
          <?php
          if ($q) {
            echo "Search results for \"<span class=\"ruby\">$q</span>\"";
          } else {
            echo "Showing all listed products.";
          }
          ?>
        </div>
        <div class="text-right">
          Sort By:
          <select id="sort-options">
            <option value="ProductPrice" onclick="SortSearch();" <?php echo $sortby_esc == "ProductPrice" ? "selected" : "" ?>>Price</option>
            <option value="ProductRating" onclick="SortSearch();" <?php echo $sortby_esc == "ProductRating" ? "selected" : "" ?>>Rating</option>
          </select>
          <span id="sort-direction" onclick="ChangeSortDirection();" class="material-icons md-24 unselectable <?php echo $sort == "ASC" ? "opposite" : "" ?>">sort</span>
        </div>
      </div>
      <div class=" search-sidebar">
        <div class="search-sidebar-header"><span class="material-icons unselectable">filter_alt</span> Filter Options</div>
        <div class="search-sidebar-group">
          <div>Price Range</div>
          <div class="search-sidebar-price">
            <input type="text" min="0" id="min-price" placeholder="MIN" maxlength="6" <?php echo "value=$min" ?>>
            <div class="search-sidebar-text">to</div>
            <input type="text" min="0" id="max-price" placeholder="MAX" maxlength="6" <?php echo "value=$max" ?>>
          </div>
          <div class="btn-primary" onclick="FilterPrice()">Filter</div>
        </div>
        <div class="search-sidebar-group">
          <div>Rating</div>
          <div class="search-sidebar-rating">
            <div class="search-sidebar-rating-option <?php echo $stars == 5 ? " active " : "" ?> ruby" onclick="FilterSearchStar(5)">
              <span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span>
            </div>
            <div class="search-sidebar-rating-option <?php echo $stars == 4 ? " active " : "" ?> ruby" onclick="FilterSearchStar(4)">
              <span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star_outline</span><span class="black"> & Up</span>
            </div>
            <div class="search-sidebar-rating-option <?php echo $stars == 3 ? " active " : "" ?> ruby" onclick="FilterSearchStar(3)">
              <span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="black"> & Up</span>
            </div>
            <div class="search-sidebar-rating-option <?php echo $stars == 2 ? " active " : "" ?> ruby" onclick="FilterSearchStar(2)">
              <span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="black"> & Up</span>
            </div>
            <div class="search-sidebar-rating-option <?php echo $stars == 1 ? " active " : "" ?> ruby" onclick="FilterSearchStar(1)">
              <span class="material-icons md-18 unselectable">star</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="black"> & Up</span>
            </div>
            <div class="search-sidebar-rating-option <?php echo $stars == 0 ? " active " : "" ?> ruby" onclick="FilterSearchStar(0)">
              <span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="material-icons md-18 unselectable">star_outline</span><span class="black"> & Up</span>
            </div>
          </div>
        </div>
      </div>
      <div class="search-results flex-wrapper">
        <?php
        if (count($rows) > 0) {
          foreach ($rows as $row) {
            $firstImage = explode(",", $row['ProductImage'])[0];
            echo "<a class=\"item-card bg-white\" href=\"item.php?id={$row['ProductId']}\">
                    <img class=\"item-image\" src=\"{$firstImage}\" alt=\"\" />
                    <div class=\"item-details\">
                      <div class=\"item-name\">
                        {$row['ProductName']}
                      </div>
                      <div class=\"item-total-sold cultured-dark text-right\">" . number_format($row['TotalSold'], 0) . " sold</div>
                      <div class=\"flex flex-justify-space-between\">
                        <div class=\"item-price rubine-red\">
                          RM <span class=\"item-price-highlighted\">" . number_format($row['ProductPrice'], 2) . "</span>
                        </div>
                        <div class=\"item-ratings ruby\">
                          " . number_format($row['ProductRating'], 1) . "<span class=\"material-icons md-18 unselectable\">star_rate</span>
                        </div>
                      </div>
                    </div>
                  </a>";
          }
        } else {
          echo '<div class="search-results-empty cultured-dark">
                  There are no products that match your criteria.
                </div>';
        }
        ?>
      </div>
      <?php
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
    <!-- ----------------------------------- BODY ----------------------------------- -->

    <!-- ----------------------------------- FOOTER ----------------------------------- -->
    <?php include "includes/footer.php" ?>
    <!-- -----------------------------------FOOTER----------------------------------- -->
  </div>
</body>
<script src="scripts/main.js"></script>
<?php include "includes/store_scripts.php"; ?>
<script src="scripts/search_filter.js"></script>
<script src="scripts/pagination.js"></script>

</html>