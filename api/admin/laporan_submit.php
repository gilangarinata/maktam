<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
$stock = array();

for($i=0; $i<count($_POST); $i++){
    if(!empty($_POST['dt'.$i])){
        $data[$i]=$_POST['dt'.$i];
    }else{
        $data[$i]=0;
    }

}
$tanggal = $data[0];
$length = $data[1];

for($i=0; $i<$length; $i++){
    $stock[$i] = $data[2+$i];
    $sisa[$i] = $data[2+$length+$i];
}

$stocki = json_encode($stock);
$sisai = json_encode($sisa);


$sql = "SELECT * FROM maktam_stock WHERE date='$tanggal'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
    $sql = "INSERT INTO `maktam_stock` (`id`, `stock`, `sisa`, `date`) VALUES (NULL, '$stocki', '$sisai', '$tanggal');";
    $result = mysqli_query($conn,$sql);
    echo "200";
}else{
    $sql = "UPDATE `maktam_stock` SET `stock` = '$stocki', `sisa` = '$sisai' WHERE `maktam_stock`.`date` = '$tanggal';";
    $result = mysqli_query($conn,$sql);   
    echo "201";         
}
?>