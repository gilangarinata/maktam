<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");


$material = $_POST['material'];
$mode = $_POST['mode'];
$id = $_POST['id'];

$sql = "SELECT * FROM maktam_add_mate WHERE material='$material'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    if($mode==0){
        $sql = "INSERT INTO `maktam_add_mate` (`id`, `material`) VALUES (NULL, '$material');";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }else{
        $sql = "UPDATE `maktam_add_mate` SET `material` = '$material' WHERE `maktam_add_mate`.`id` = '$id';";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }
}else{
        echo "405";
}

?>