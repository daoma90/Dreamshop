<?php 
function initImages() {
    extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
        if(in_array($ext,$extension)) {
            if(!file_exists("photo_gallery/".$txtGalleryName."/".$file_name)) {
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$file_name);
            }
            else {
                $filename=basename($file_name,$ext);
                $newFileName=$filename.time().".".$ext;
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$newFileName);
            }
        }
        else {
            array_push($error,"$file_name, ");
        }
    }    
}

// $query = "SELECT * FROM event ";
// $result = mysqli_query($connection,$query) or die(mysqli_error());


//   if($result->num_rows > 0) {
//       while($r = mysqli_fetch_assoc($result)){
//         $eventid= $r['id'];
//         $sqli="select id,image from photos where eventid='".$eventid."'";
//         $resulti=mysqli_query($connection,$sqli);
//         $image_json_array = array();
//         while($row = mysqli_fetch_assoc($resulti)){
//             $image_id = $row['id'];
//             $image_name = $row['image'];
//             $image_json_array[] = array("id"=>$image_id,"name"=>$image_name);
//         }
//         $msg1[] = array ("imagelist" => $image_json_array);

//       }
?>