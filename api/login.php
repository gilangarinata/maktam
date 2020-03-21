<?php
header('Access-Control-Allow-Origin: *');
session_start();
require_once("koneksi.php");
$username=$_POST["username"];
$password=$_POST["password"];
$sql = "SELECT * FROM maktam_login WHERE username='$username' and password='$password'" ;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row=mysqli_fetch_assoc($result)){
       $outlet=$row['outlet'];
   }
   echo $outlet;
}else{
   echo 504;
}
?>	

