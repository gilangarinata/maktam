<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$outlet = $_POST['outlet'];

$result_array = array();
$sql="SELECT * FROM maktam_other WHERE outlet='$outlet' ORDER BY id DESC";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        array_push($result_array, $row);
    }
}
echo json_encode($result_array);
?>