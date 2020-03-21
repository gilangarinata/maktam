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
$mode = $data[38];
$id = $data[39];

$datas = json_encode($data);

$sql = "SELECT * FROM maktam_sale WHERE date='$data[0]' and outlet='$data[1]'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    $sql = "INSERT INTO `maktam_sale` (`id`, `date`, `employee`, `shift`, `note`, `milk`, `spice`, `cup`, `outlet`, `tempat`) VALUES (NULL, '$data[0]', '', '2', '', '', '', '', '$data[1]', '$datas');";
    $result = mysqli_query($conn,$sql);
    echo "200";
}else{
    if($mode==1){
        $sql = "UPDATE `maktam_sale` SET `date` = '$data[0]', `tempat` = '$datas' WHERE `maktam_sale`.`id` = '$id';";
        $result = mysqli_query($conn,$sql);   
        echo "200";         
    }else{
        echo "405";
    }
}
?>