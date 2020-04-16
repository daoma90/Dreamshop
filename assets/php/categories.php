<?php 

require 'db.php';

$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = $row['name'];
    $image = $row['image'];
echo "<article class='lp-categories__item'>
        <img class='lp-categories__img' src='./admin/images/$image' alt=''>
        <div class='lp-categories__title'>$name</div>
      </article>";
endwhile;

?>
