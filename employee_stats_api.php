<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  die(http_response_code(401));
}


if (isset($_POST['type'])) {
  if (strtolower($_POST['type']) == "trending") {
    include_once 'includes/database.php';

    $trendingData = mysqlidb::fetchAllRows("SELECT SUM(orderitem.ProductQuantity) as Purchases, product.ProductName 
    FROM orderitem 
    INNER JOIN product ON product.ProductId = orderitem.ProductId 
    WHERE product.ProductStatus='Approved' 
    GROUP BY orderitem.ProductId 
    ORDER BY Purchases DESC LIMIT 10");

    echo json_encode($trendingData);
  } else if (strtolower($_POST['type']) == "rating") {
    include_once 'includes/database.php';

    $ratingData = mysqlidb::fetchAllRows("SELECT COUNT(*) AS Products, t1.AvgRating FROM ( SELECT AVG(`review`.`ReviewRating`) AS AvgRating, product.ProductName FROM `review` INNER JOIN product ON product.ProductId = review.ProductId GROUP BY `review`.`ProductId` ) t1 GROUP BY t1.AvgRating ");

    echo json_encode($ratingData);
  }
}
