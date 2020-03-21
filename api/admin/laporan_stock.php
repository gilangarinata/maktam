<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
$tanggal = $_POST['tanggal'];
$result_array = array();
$data = array();
$outlets = array();


$sql="SELECT * FROM maktam_login WHERE username!='Admin'";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $outlets[$i]=$row['outlet'];
        $i++;
    }
}

for($j=0; $j<sizeof($outlets); $j++){
    $sql="SELECT * FROM maktam_sale WHERE outlet='$outlets[$j]' and date='$tanggal'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $datas = json_decode($row['tempat']);
        }
    }else{
            $datas = array();
    }
   
    $data["outlet"] = $outlets[$j];
    $data["data"] = json_encode($datas);
    array_push($result_array, $data);
}
   
echo json_encode($result_array);
?>