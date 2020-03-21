<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");


$rasa = $_POST['rasa'];
$hargaDingin = $_POST['hargaDingin'];
$hargaHangat = $_POST['hargaHangat'];

$mode = $_POST['mode'];
$id = $_POST['id'];

$sql = "SELECT * FROM maktam_rasa WHERE rasa='$rasa'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    if($id==0){
        $sql = "INSERT INTO `maktam_rasa` (`id`, `rasa`, `harga_dingin`, `harga_hangat`) VALUES (NULL, '$rasa', '$hargaDingin', '$hargaHangat');";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }else{
        $sql = "UPDATE `maktam_rasa` SET `rasa` = '$rasa', `harga_dingin` = '$hargaDingin', `harga_hangat` = '$hargaHangat' WHERE `maktam_rasa`.`id` = '$id';";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }
}else{
        echo "405";
}

?>