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
$length = $data[1];

for($i=0; $i<$length; $i++){
    $keterangan[$i] = $data[2+$i];
    $jumlah[$i] = $data[2+$length+$i];  
}

$keterangan1 = json_encode($keterangan);
$jumlah1 = json_encode($jumlah);

$sql = "SELECT * FROM maktam_gudang WHERE date='$tanggal'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)  $avail=1;
else                            $avail=0;

if($avail==0){
    $sql = "INSERT INTO `maktam_gudang` (`id`, `date`, `pengeluaran`, `keterangan`) VALUES (NULL, '$tanggal', '$jumlah1', '$keterangan1');";
    $result = mysqli_query($conn,$sql);
    echo "200";
}else{
    $sql = "UPDATE `maktam_gudang` SET `pengeluaran` = '$jumlah1', `keterangan` = '$keterangan1' WHERE `maktam_gudang`.`date` = '$tanggal';";
    $result = mysqli_query($conn,$sql);
    echo "201";
}
?>