<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
$tanggal = $_POST['tanggal'];
$result_array = array();
$data = array();
$material = array();
$stock = array();

$sql="SELECT * FROM maktam_add_mate";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $material[$i]=$row['material'];
        $i++;
    }
}

$sql="SELECT * FROM maktam_stock WHERE date = '$tanggal'";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $stock[$i]=$row['stock'];
        $i++;
    }
}

    $sql="SELECT * FROM maktam_mate WHERE date='$tanggal'";
    $result=mysqli_query($conn,$sql);
    $k = 0;
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $datas[$k] = json_decode($row['total']);
            $k++;
        }
    }else{
            $datas = array();
    }
   
    $data["material"] = json_encode($material);
    $data["data"] = json_encode($datas);
    $data["stock"] = $stock;
   
echo json_encode($data);
?>