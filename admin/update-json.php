<?php
session_start();
if (!isset($_SESSION["authCode"])) {
    header("Location: login.html");
    exit();
}
// create empty variable to store post ID
$postID = $_POST['postID'];
echo $postID;

// read json file
$data = file_get_contents('../posts.json');

// decode json to associative array
$json_arr = json_decode($data, true);

// get array index to delete
$arr_index = array();
foreach ($json_arr as $key => $value)
{
    if ($value['postID'] == $postID)
    {
        $arr_index[] = $key;
    }
}

// delete data
foreach ($arr_index as $i)
{
    unset($json_arr[$i]);
}

// rebase array
$json_arr = array_values($json_arr);

// encode array to json and save to file
file_put_contents('../posts.json', json_encode($json_arr));
?>