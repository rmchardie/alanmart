<?php
session_start();
if (!isset($_SESSION["authCode"])) {
    header("Location: login.html");
    exit();
}
$posted[] = $_POST;

if (isset($_FILES['postImageFile']['name'])) {
    $file_name = $_FILES['postImageFile']['name'];
    $file_tmp =$_FILES['postImageFile']['tmp_name'];
    
    if (move_uploaded_file($file_tmp,"../images/".$file_name)) {
        echo "Success uploading image....\r\n";
    } else {
        echo "Error uploading image....\r\n";
    }
}

$current_data = file_get_contents('../posts.json');
$decoded = json_decode($current_data,true);
//You merge together posted array values with the current array
//that is in the current file (after decoding the json)
//$posted is first part of the array because you start to merge from that
//array
$new_arr = array_merge($posted, $decoded); 

//Encode the new array into JSON and save it
$encoded_json = json_encode($new_arr,);

if (file_put_contents('../posts.json', $encoded_json)) {
    header("Location: index.php");
} else {
    echo "Error adding post!\r\n";
}
?>
