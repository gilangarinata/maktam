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
$tanggal = $data[0];
$outlet = $data[1];
$karyawan = $data[2];
$shift = $data[3];
$pendapatan = $data[5];
$mode = $data[6];
$id = $data[7];

$datas = json_encode($data);

$sql = "SELECT * FROM maktam_other WHERE date='$tanggal' and shift='$shift' and outlet='$outlet'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    $sql = "INSERT INTO `maktam_other` (`id`, `date`, `employee`, `shift`, `note`, `icecream`, `yogurt`, `p1`, `p2`, `outlet`, `pendapatan`) VALUES (NULL, '$tanggal', '$karyawan', '$shift', '', '$datas', '', '', '', '$outlet', '$pendapatan');";
    $result = mysqli_query($conn,$sql);
    echo "200";
}else{
    if($mode==1){
        $sql = "UPDATE `maktam_other` SET `date` = '$tanggal', `employee` = '$karyawan', `shift` = '$shift', `icecream` = '$datas', `outlet` = '$outlet', `pendapatan` = '$pendapatan' WHERE `maktam_other`.`id` = '$id';";
        $result = mysqli_query($conn,$sql);
        echo "200";
    }else{
        echo "405";
    }
}

?>