<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
$tanggal = $_POST['tanggal'];
$data = array();

$sql="SELECT * FROM maktam_income WHERE date='$tanggal' and shift='2'";
$result=mysqli_query($conn,$sql);
$saldo = 0;
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $saldo = $saldo + $row['balance'];
    }
}else{
    $saldo = 0;
}

$sql="SELECT * FROM maktam_gudang WHERE date='$tanggal'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $pengeluaran = $row['pengeluaran'];
    }
}else{
        $pengeluaran = array();
}

$data['saldo'] = $saldo;
$data['pengeluaran'] = $pengeluaran;

echo json_encode($data);
?>