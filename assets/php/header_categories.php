<?php 

require 'db.php';

$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = $row['name'];

    if (strpos($_SERVER['REQUEST_URI'], 'product')){
        echo "<li class='header__list-item catsort-header'><a class='header__item-link' href='./?category=$name&#category'>$name</a></li>";
    }
    else {
        echo "<li class='header__list-item catsort-header'>$name</li>";
    }
endwhile;

?>
