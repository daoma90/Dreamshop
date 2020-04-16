<body>
    <?php
    require "includes/db.php";
    ?>

    <section class="categories">

        <?php

        $sql = "SELECT * FROM category";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $categories = "";
        echo $categories;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $name = htmlspecialchars($row["name"]);
            $image = htmlspecialchars($row["image"]);
            $ID = htmlspecialchars($row['ID']);

            $name = strtoupper($name);

            $categories .= "
                    <div class='cat-container' id='cat-{$ID}'>
                        <div class='cat-container__img-container'>
                            <img src='./images/{$image}' class='cat-container__img'>
                            <h2 class='cat-container__text'>{$name}</h2>
                        </div>
                        <div class='cat-container__buttons' method='POST'>
                            <button class='cat-container__button' onclick='populateCategoryForm({$ID})' id='edit'>REDIGERA</button>
                            <a href='./category/categoriesDelete.php?ID={$ID}' class='cat-container__button' id='delete'>RADERA</a>
                        </div>
                    </div>
                    ";
        }
        echo $categories;
        ?>