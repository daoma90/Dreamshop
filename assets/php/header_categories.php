<?php 

require 'db.php';

$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = htmlspecialchars($row['name']);
    echo "<li class='header__list-item catsort'><a class='header__item-link' href='./category.php?category=$name'>$name</a></li>";

endwhile;

?>
