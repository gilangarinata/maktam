<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
$tanggal = $_POST['tanggal'];
$result_array = array();

$sql="SELECT * FROM maktam_rasa";
$result=mysqli_query($conn,$sql);
$rasa = Array();
$dingin = Array();
$hangat = Array();
$data = Array();
$totalDingin = Array();
$totalHangat = Array();

$i=0;
$j=0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $rasa[$i]=$row['rasa'];
        $i++;
    }
}

$sql="SELECT * FROM maktam_income WHERE date='$tanggal'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $dingin = json_decode($row['coldcup']);
        $hangat = json_decode($row['warmcup']);
        
        for($k=0; $k<sizeof($dingin); $k++){
            $totalDingin[$k]=$totalDingin[$k]+$dingin[$k];
            $totalHangat[$k]=$totalHangat[$k]+$hangat[$k];
        }
        $j++;   
    }
    
}  
    $data["rasa"] = json_encode($rasa);
    $data["dingin"] = json_encode($totalDingin);
    $data["hangat"] = json_encode($totalHangat);

    echo json_encode($data);
?>