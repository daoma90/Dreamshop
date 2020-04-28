<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frontendprojekt</title>
  <link rel="stylesheet" href="./assets/style/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <?php require_once 'header.php';
  require_once './assets/php/db.php';
  $results = '';
  $query = '';
  $salePercentage = 0.9;
  ?>



    <?php

    $words_to_filter = array("and", "not", "if", "get", "with", "keep", "that", "this", "every", "is", 'let', 'go');
    // character 'a' is not included here it can be find in the middle 
    if (isset($_GET['submit-search'])) {
      $searchQ = htmlspecialchars($_GET['search-word']);
      $res = str_ireplace($words_to_filter, "",   $searchQ);
      $res = trim($res);
      $res = explode(' ', $res);
      // since a can be find in middle of the word 
      foreach ($res as &$val) {
        if ($val == 'a' || $val == 'A') $val = '';
      }
      $res = trim(implode('', $res));
      $query = $res;
      if (!empty($res)) {

        $stmt = $db->prepare('SELECT * FROM products WHERE name LIKE :keywords');
        $stmt->execute([
          ':keywords' => '%' . $res . '%'
        ]);
        if ($stmt->rowCount()) {
          while ($row = $stmt->fetch()) {
            $id = $row['ID'];
            $image = $row["image"];
            $name = $row["name"];
            $price = $row["price"];
            $stock = $row["in_stock"];
            $isOld = $row['is_old'];

            $addToCartBtn = "<button class='feature-products__add' data-id=$id>ADD TO CART</button>";
            if ($stock == 0) {
                $addToCartBtn = "<div class='feature-products__oos'>OUT OF STOCK</div>";
            }
            if ($isOld == 1) {
        
        
                $sale_price = $price * $salePercentage;
                $sale = "
                <div class='feature-products__price'>
                    <span class='old-price'>$price SEK</span>
                    <span class='on-sale'>-10%</span>
                    <span class='new-price'>$sale_price SEK</span>
                </div>";
            }
            else {
                $sale = "<span class='old-price'>$price SEK</span>";
            }
        
        
        $results .= "<article class='feature-products__product'>
                <a class='feature-products__link-wrap' href='./product.php?id=$id'>
                <div class='feature-products__img-wrap'><img class='feature-products__img' src='./admin/images/$image' alt=''></div>
                <div class='feature-products__product-title'>$name</div>
                $sale
                <div class='feature-products__stock'>IN STOCK: $stock</div>
                </a>
                $addToCartBtn
              </article>";
          }
        } else {
          $results = "<div>Nothing found for search term '$query'</div>";
        }
      } else {
        $results = "<div>Nothing found for search term '$query'</div>";
      }
    }



    ?>


  <div class="search-results"><?= "Searched for: " . $query ?></div>
  <div class="search-container feature-products__product-wrap">
    <?= $results?>
  </div>



  <?php
  require_once 'footer.php';
  ?>
  <script src="./assets/js/search.js"></script>
  <script src="./assets/js/happyLib.js"></script>
  <script src="./assets/js/header.js"></script>
  <script src="./assets/js/cart.js"></script>
</body>

</html>