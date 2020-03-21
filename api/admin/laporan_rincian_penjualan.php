<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
$tanggal = $_POST['tanggal'];
$result_array = array();
$data = array();
$rasa = array();
$outlets = array();
$dingin = array();
$hangat = array();
$bonus = array();

$sql="SELECT * FROM maktam_rasa";
$result=mysqli_query($conn,$sql);
$o = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $rasa[$o]=$row['rasa'];
        $o++;
    }
}

$sql="SELECT * FROM maktam_login WHERE username != 'Admin'";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $outlets[$i]=$row['outlet'];
        $i++;
    }
}

for($j=0; $j<sizeof($outlets); $j++){
    $dingin[$j]=0;
    $hangat[$j]=0;
    $bonus[$j]=0;
    $totalDingin = array();
    $totalHangat = array();
    $totalBonus = array();

    $sql="SELECT * FROM maktam_income WHERE outlet='$outlets[$j]' and date='$tanggal'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $dingin = json_decode($row['coldcup']);
            $hangat = json_decode($row['warmcup']);
            $bonus = json_decode($row['bonus']);

            for($k=0; $k<sizeof($dingin); $k++){
                $totalDingin[$k]=$totalDingin[$k]+$dingin[$k];
                $totalHangat[$k]=$totalHangat[$k]+$hangat[$k];
                $totalBonus[$k]=$totalBonus[$k]+$bonus[$k]; 
            }
        }
    }else{

    }
   
    $data["outlet"] = $outlets[$j];
    $data["dingin"] = json_encode($totalDingin);
    $data["hangat"] = json_encode($totalHangat);
    $data["bonus"] = json_encode($totalBonus);
    $data["rasa"] = json_encode($rasa);
    array_push($result_array, $data);
}
    
echo json_encode($result_array);
?>