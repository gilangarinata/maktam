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
$produk = $data[0];
$length = $data[1];
$id = $data[2];
$mode = $data[3];

for($i=0; $i<$length; $i++){
    $rasa[$i] = $data[4+$i];
    $harga[$i] = $data[4+$length+$i];  
}


$rasa1 = json_encode($rasa);
$harga1 = json_encode($harga);

$sql = "SELECT * FROM maktam_produk WHERE produk='$produk'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)      $avail=true;
else                                $avail=false;

if($avail==false){
        $sql = "INSERT INTO `maktam_produk` (`id`, `produk`, `rasa1`, `rasa2`, `rasa3`, `rasa4`, `rasa5`, `harga1`, `harga2`, `harga3`, `harga4`, `harga5`, `name`) VALUES (NULL, '$produk', '$rasa1', '', '', '', '', '$harga1', '', '', '', '', '');";
        $result = mysqli_query($conn,$sql);
        echo "200";
        
}else{
    $sql = "UPDATE `maktam_produk` SET `produk` = '$produk', `rasa1` = '$rasa1', `harga1` = '$harga1' WHERE `maktam_produk`.`id` = '$id';";
    $result = mysqli_query($conn,$sql);
    echo "200";}

?>