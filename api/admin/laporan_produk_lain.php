<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
$tanggal = $_POST['tanggal'];
$result_array = array();
$data = array();
$produk = array();
$rasa = array();

$sql="SELECT * FROM maktam_produk";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $produk[$i]=$row['produk'];
        $rasa[$i]=json_decode($row['rasa1']);
        $i++;
    }
}



    $sql="SELECT * FROM maktam_other WHERE date='$tanggal'";
    $result=mysqli_query($conn,$sql);
    $k = 0;
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $datas[$k] = json_decode($row['icecream']);
            $k++;
        }
    }else{
            $datas = array();
    }
   
    $data["produk"] = json_encode($produk);
    $data["data"] = json_encode($datas);
    $data["rasa"] = json_encode($rasa);
   
echo json_encode($data);
?>