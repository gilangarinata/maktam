<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$data = array();
$tanggal = $_POST['tanggal'];

$result_array = array();
$sql="SELECT * FROM maktam_income WHERE date='$tanggal'";
$result=mysqli_query($conn,$sql);
$modal=0;
$pengeluaran = 0;
$saldo = 0;
$pendapatan = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $modal  = $modal + $row['modals'];
        $pengeluaran  = $pengeluaran + $row['expenditure'];
        $pendapatan  = $pendapatan + $row['income'];
        if($row['shift']==2)        $saldo  = $saldo + $row['balance'];
    }
}

$data['modal'] = $modal;
$data['pengeluaran'] = $pengeluaran;
$data['pendapatan'] = $pendapatan;
$data['saldo'] = $saldo;

echo json_encode($data);
?>