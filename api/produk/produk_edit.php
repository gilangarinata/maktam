<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$id = $_POST['id'];
$result_array = array();

$sql="SELECT * FROM maktam_other WHERE id='$id'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo $row['icecream'];
    }
}
?>