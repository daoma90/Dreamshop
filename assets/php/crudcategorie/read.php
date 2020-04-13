<?php

$sql = "SELECT * FROM categorie";
$stmt = $db->prepare($sql);
$stmt->execute();

$button = "<button class='createbtn'>";
$button .= "<a href='create.php?'>
  Create a Post</a> ";
echo $button .= "</button>";


$table = "<table>";
$table .= "

<tr>
<td> Id </td>
<td> Name </td>
<td> Image </td>
<td> Delete</td>
<td> Uppdate</td>

</tr>
<tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

  $name = htmlspecialchars($row["name"]);
  $image = htmlspecialchars($row["image"]);
  $id = htmlspecialchars($row["id"]);
  
  
  
  //echo $showing;
  $table .= "
    <td>$id</td>
    <td>$name</td>
    <td>$image</td>
     <td class='delete'> 
    <a href='delete.php?id=$id' 
    class='delete'>
    Delete</a> </td>
    <td class='uppdatera'> 
    <a href='update.php?id=$id' 
    class='uppdatera'>
    Update</a> 
    </td>
 
  </tr>";
}

echo $table .= "</table>";
?>


