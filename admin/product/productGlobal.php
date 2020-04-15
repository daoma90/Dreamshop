<?php

require "../includes/db.php";


function readAll($pdo)
{
    $sql = 'SELECT * FROM products';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
}

//Draws each product based on arr from db
function drawProducts($pdo)
{
    $stmt = readAll($pdo);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<article class='product' id='product_" . $row["ID"] . "'>
                <div class='product__left-info'>
                    <div class='product__left-info-image'><img src='../images" . $row["image"] . "' alt=''></div>
                    <div class='product__btn-wrapper'>
                     <button class='product__btn product__btn--edit' onclick='populateFields(" . $row["ID"] .  ")'>Edit</button>
                     <button class='product__btn product__btn--del' onclick='deleteView(" . $row["ID"] .  ")'>Delete</button>
                    </div>
                </div>
        <div class='product__right-info'>
            <h3 class='name'>" . $row["name"] . "</h3>
            <p class='desc'>" . $row["description"] . " </p>
            <p class='price'>" . $row["price"] . " </p>
            <p class='in_stock'>" . $row["in_stock"] . " </p>
            <p class='featured' style='display:none;'>" . $row["featured"] . " </p>
            <p>" . $row["cat_id"] . " '</p>
        </div>
    </article>";
        }
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
            echo "<option value=" . $row["ID"] . ">" . $row["name"] . "</option>";
        }
        echo "</select>";
    }
}
