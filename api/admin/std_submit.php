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

$datas = array();

for($i=0; $i<$data[2]; $i++){
$datas[$i]=$data[$i+3];
}


$sql = "SELECT * FROM maktam_set WHERE date='$tanggal' and outlet='$outlet'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

$datass = json_encode($datas);


if($avail==false){
        $sql = "INSERT INTO `maktam_set` (`id`, `dataset`, `outlet`, `date`) VALUES (NULL, '$datass', '$outlet', '$tanggal');";
        $result = mysqli_query($conn,$sql);
        echo "200";
}else{
    $sql = "UPDATE `maktam_set` SET `dataset` = '$datass', `outlet` = '$outlet', `date` = '$tanggal' WHERE `maktam_set`.`outlet` = '$outlet' and `maktam_set`.`date` = '$tanggal';";
    $result = mysqli_query($conn,$sql);
    echo "201";

}

?>