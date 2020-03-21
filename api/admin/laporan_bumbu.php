<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$result_array = array();
$tanggal = $_POST['tanggal'];

$sql="SELECT * FROM maktam_sale WHERE date='$tanggal'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo $row['tempat'];
    }
}

?>