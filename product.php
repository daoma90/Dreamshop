<?php 
    require_once './assets/php/db.php';


    if (isset($_GET['id'])){
        $product_id = $_GET['id'];
        $sql = "SELECT products.*, category.name AS category FROM products, category WHERE products.ID = :id AND category.ID = products.cat_id";
        #$sql = "SELECT * FROM products JOIN category ON (products.cat_id = category.ID) WHERE products.ID = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
        $name = $row['name'];
        $desc = $row['description'];
        $price = $row['price'];
        $sale_price = $row['sale_price'];
        $image = $row['image'];
        $category = $row['category'];
        $stock = $row['in_stock'];

    endwhile;
    $product = $name;

    $sql = "SELECT * FROM images WHERE product_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $product_id]);

    $printImgs = '';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if ($image != $row['image']){
        $imageToShow = $row['image'];
        $printImgs .= "<div class='productpage__img-wrap'>
                          <img
                            class='productpage__img'
                            src='./admin/images/$imageToShow'
                            alt=''
                          />
                        </div>";
      }
      
    }

    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="./assets/style/main.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>

  <body>
    <?php include 'header.php';?>
    <main class="productpage-wrapper">
      <section class="productpage">
        <div class="productpage__col-left">
          <div class="productpage__primary-img-wrap">
            <img
              class="productpage__img productpage__img--large"
              src="<?= "./admin/images/$image"?>"
              alt=""
            />
          </div>
          <div class="productpage__image-bar">
            <?= $printImgs; ?>
          </div>
        </div>

        <div class="productpage__col-right">
          <div class="productpage__heading-wrap">
            <h1 class="productpage__name"><?= $product ?></h1>
            <?php 
              if ($sale_price > 0) {
                echo "<span style='text-decoration: line-through' class='productpage__price'>$price SEK</span>";
                echo "<span style='margin-left: 0.5rem' class='productpage__price'>$sale_price SEK</span>";
              }
              else {
                echo "<span class='productpage__price'>$price SEK</span>";
              }
            ?>
            <small class="productpage__category"><?= $category ?></small>
            <small class="productpage__category">IN STOCK: <?= $stock ?></small>
          </div>
          <p class="productpage__desc"><?= $desc ?></p>
          <div class="productpage__input-wrap">
            <div class="productpage__qty-wrap">
              <button class="productpage__qty-down"><i class="fa fa-minus"></i></button>
              <input
                class="productpage__qty"
                type="number"
                value="1"
                readonly
              />
              <button class="productpage__qty-up"><i class="fa fa-plus"></i></button>
            </div>
            <?php 
              if ($stock == 0) {
                echo "<div>OUT OF STOCK</div>";
              }
              else {
                echo "<button class='productpage__add' data-id=$product_id >ADD TO CART</button>";
              }
            ?>
          </div>
        </div>
      </section>
    </main>
    <?php require_once 'footer.php'; ?>
    <script src="./assets/js/happyLib.js"></script>
    <script src="./assets/js/ajax-categories.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/cart.js"></script>
  </body>
</html>
