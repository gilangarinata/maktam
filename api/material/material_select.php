<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");


$result_array = array();
$sql="SELECT * FROM maktam_add_mate";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        array_push($result_array, $row);
    }
}
echo json_encode($result_array);
?>