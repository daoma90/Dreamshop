<?php

require "../includes/db.php";


function readAll($pdo)
{
    $sql = 'SELECT * FROM products';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
}


// function drawProducts($pdo)
// {
//     $stmt = readAll($pdo);
//     if ($stmt->rowCount() > 0) {
//         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//             echo "<article class='product' id='product_" . $row["ID"] . "'>
//                 <div class='product__left-info'>
//                     <div class='product__left-info-image'><img src='../images/" . $row["image"] . "' alt=''></div>
//                     <div class='product__btn-wrapper'>
//                      <button class='product__btn product__btn--edit' onclick='populateFields(" . $row["ID"] .  ")'>Edit</button>
//                      <button class='product__btn product__btn--del' onclick='deleteView(" . $row["ID"] .  ")'>Delete</button>
//                      <label class='product__tag'>" .  getCategoryLabel($pdo, $row["cat_id"]) . "</label>
//                     ".isFeatured($row["featured"])."
//                     </div>
//                 </div>
//         <div class='product__right-info'>
//             <h3 class='name'>" . $row["name"] . "</h3>
//             <p class='desc' style='display:none'>" . $row["description"] . " </p>
//             <p class='price'>" . $row["price"] . " </p>
//             <p class='in_stock'>" . $row["in_stock"] . " </p>
//             <p class='featured'>" . $row["featured"]. " </p>
//             <p style='display:none;'>" . $row["cat_id"] . " '</p>
//         </div>
//     </article>";
//         }
//     }
// }


//Draws each product based on arr from db
function drawProducts($pdo)
{
    $stmt = readAll($pdo);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<article class='product' id='product_" . $row["ID"] . "'>
                <div class='product__left-info'>
                    <div class='product__left-info-image'><img src='../images/" . $row["image"] . "' alt=''></div>
                    <div class='product__btn-wrapper'>
                     <button class='btn btn--edit' onclick='initEdit(" . $row["ID"] .  ")'></button>
                     <button class='btn btn--del' onclick='deleteView(" . $row["ID"] .  ")'></button>
                    ".isFeatured($row["featured"])."
                    </div>
                </div>
        <div class='product__right-info'>
            <div></div>
            <h3 class='name'>" . $row["name"] . "</h3>
            <p class='description'>" . $row["description"] . "</p>
            <p class='price'>" . $row["price"] . "</p>
            <p class='in_stock'> " . $row["in_stock"] . "</p>
            <label class='product__tag'>" .  getCategoryLabel($pdo, $row["cat_id"]) . "</label>
            <p class='featured' style='display:none;'>" . $row["featured"]. " </p>
            <p style='display:none;' class='cat_id'>" . $row["cat_id"] . "</p>
        </div>
    </article>";
        }
    }
}



//Shows current category foreach product
function getCategoryLabel($pdo, $cat)
{
    $sql = 'SELECT name FROM category WHERE ID=:c_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':c_id', $cat);
    $stmt->execute();
    $resp = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resp["name"];
}


//Determines featured
function isFeatured($feat) {
    if($feat === "1") {
        return "<div class='product__featured'>Featured</div>";        
    }
}

//Draws dropdownlist with all categorys
function getCatList($pdo)
{
    $sql = 'SELECT * FROM category';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "<select name='cat_id'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option name='cat_id' value=" . $row["ID"] . ">" . $row["name"] . "</option>";
        }
        echo "</select>";
    }
}
