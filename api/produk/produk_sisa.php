<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$tanggal = $_POST['tanggal'];
$outlet = $_POST['outlet'];

$result_array = array();
$sql="SELECT * FROM maktam_other WHERE date='$tanggal' and outlet='$outlet' and shift='1' ORDER BY id DESC";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo $row['icecream'];
    }
}
?>