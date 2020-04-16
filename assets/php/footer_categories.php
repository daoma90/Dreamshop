<?php 

require 'db.php';

$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = $row['name'];

    # Insert category
echo "<li class='footer__list-item catsort-footer'>$name</li>";
endwhile;

?>
