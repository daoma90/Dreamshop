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
  ?>

  <div class="search-container">
    <?php
    if (isset($_GET['submit-search'])) {
      $searchQ = htmlspecialchars($_GET['search-word']);
      $stmt = $db->prepare('SELECT * FROM products WHERE name LIKE :keywords OR description LIKE :keywords');
      $stmt->execute([
        ':keywords' => '%' . $searchQ . '%'
      ]);
      if ($stmt->rowCount()) {
        while ($row = $stmt->fetch()) {
          $id = $row['ID'];
          $image = $row["image"];
          $name = $row["name"];
          $price = $row["price"];
          echo "<article >
                <a class='searchProd'  href='./product.php?id=$id'>
                <div class='searchProd__image'>
                  <img src='./admin/images/$image' alt=''>
                 </div>
                <div class='searchProd__detail'>
                    <h3 class='searchProd__detail-name'>$name</h3>
                    <p class='searchProd__detail-name-price'>$price</p>
                </div>
                </a>
                 </article>";
        }
      } else {
        echo 'Nothing found';
      }
    }



    ?>
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