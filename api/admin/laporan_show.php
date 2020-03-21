<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$tanggal = $_POST['tanggal'];

$result_array = array();
$sql="SELECT * FROM maktam_login WHERE username != 'admin'";
$result=mysqli_query($conn,$sql);
$i = 0;
$data = array();

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $outlets[$i]=$row['outlet'];
        $i++;
    }
}

for($j=0; $j<sizeof($outlets); $j++){

    $sql="SELECT * FROM maktam_income WHERE outlet='$outlets[$j]' and date='$tanggal'";
    $result=mysqli_query($conn,$sql);
    $pendapatan_shift1[$j]=0;
    $pendapatan_shift2[$j]=0;
    $modal[$j]=0;
    $pengeluaran[$j]=0;
    $saldo[$j]=0;
    $pengeluaran[$j]=0;

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            if($row['shift']==1)               $pendapatan_shift1[$j]=$row['income'];
            if($row['shift']==2){
                $pendapatan_shift2[$j]=$row['income'];
                $saldo[$j] = $row['balance'];
                $pengeluaran[$j] = $row['expenditure'];
            }
            $modal[$j]=$modal[$j]+$row['modals'];
        }
    }
   
    $data["outlet"] = $outlets[$j];
    $data["pendapatan1"] = $pendapatan_shift1[$j];
    $data["pendapatan2"] = $pendapatan_shift2[$j];
    $data["pengeluaran"] = $pengeluaran[$j];
    $data["modal"] = $modal[$j];
    $data["saldo"] = $saldo[$j];
    array_push($result_array, $data);
}

echo json_encode($result_array);
?>