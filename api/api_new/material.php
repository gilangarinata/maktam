<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

for($i=0; $i<count($_POST); $i++){
    if(!empty($_POST['dt'.$i])){
        $data[$i]=$_POST['dt'.$i];
    }else{
        $data[$i]=0;
    }
}

$mode = $data[5];
$id = $data[6];
$karyawan = $data[2];
$tanggal = $data[0];
$outlet = $data[1];
$datas = json_encode($data);

$sql = "SELECT * FROM maktam_mate WHERE date='$tanggal' and outlet='$outlet'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    $sql = "INSERT INTO `maktam_mate` (`id`, `date`, `employee`, `shift`, `note`, `total`, `adds`, `sisa`, `outlet`) VALUES (NULL, '$tanggal', '$karyawan', '2', '', '$datas', '', '', '$outlet');";
    $result = mysqli_query($conn,$sql);
    echo "200";
}else{
    if($mode==1){
        $sql = "UPDATE `maktam_mate` SET `date` = '$tanggal', `employee` = '$karyawan', `total` = '$datas', `outlet` = '$outlet' WHERE `maktam_mate`.`id` = '$id';";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }else{
        echo "405";
    }
}
?>