<?php 

require 'db.php';

$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = $row['name'];

    # Insert category
echo "<li class='header__list-item catsort-header'>
        <a href='#' class='header__item-link'>$name</a>
      </li>";
endwhile;

?>
