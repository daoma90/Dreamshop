
    <body>
        <?php require_once "navbar.php";?>

        <section class="categories">
            
            <?php
            
            $sql = "SELECT * FROM category";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $categories = "";
            echo $categories;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                $name = htmlspecialchars($row["name"]);
                $image = htmlspecialchars($row["image"]);
                $ID = htmlspecialchars($row['ID']);
                
                $name = strtoupper($name);
                
                $categories .= "
                    <div class='cat-container'>
                        <div class='cat-container__img-container'>
                            <img src='{$image}' class='cat-container__img'>
                            <h2 class='cat-container__text'>{$name}</h2>
                        </div>
                        <form class='cat-container__buttons' method='POST' enctype='multipart/form-data'>
                            <a href='categoriesDelete.php?ID={$ID}' class='cat-container__button' id='edit'>REDIGERA</a>
                            <a href='categoriesDelete.php?ID={$ID}' class='cat-container__button' id='delete'>RADERA</a>
                        </form>
                    </div>
                    ";
            } 
            echo $categories;
            ?>  

        <script src="./assets/js/header.js"></script>
    </body>
</html>

        