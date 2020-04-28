<?php 

require 'db.php';

$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = htmlspecialchars($row['name']);
    echo "<li class='footer__list-item catsort'><a class='footer__link' href='./category.php?category=$name'>$name</a></li>";


endwhile;

?>