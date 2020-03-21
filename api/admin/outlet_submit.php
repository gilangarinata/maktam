<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");


$username = $_POST['username'];
$outlet = $_POST['outlet'];
$password = $_POST['password'];
$mode = $_POST['mode'];
$id = $_POST['id'];



$sql = "SELECT * FROM maktam_login WHERE username='$username' or outlet='$outlet'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    if($id==0){
        $sql = "INSERT INTO `maktam_login` (`id`, `username`, `password`, `outlet`, `dataset`) VALUES (NULL, '$username', '$password', '$outlet', '');";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }else{
        $sql = "UPDATE `maktam_login` SET `username` = '$username', `password` = '$password', `outlet` = '$outlet' WHERE `maktam_login`.`id` = '$id';";
        $result = mysqli_query($conn,$sql);
        echo "200";    
    }
}else{
        echo "405";
}

?>