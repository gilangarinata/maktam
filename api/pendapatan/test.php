
 <?php
 header('Access-Control-Allow-Origin: *');
 require_once("../koneksi.php");

$tanggal = "06-04-2019";
$shift = 1;
$outlet="rejakso";

 $sql = "SELECT * FROM maktam_income WHERE date='$tanggal' and shift='$shift' and outlet='$outlet'";
 $result = mysqli_query($conn,$sql);
 
 if(mysqli_num_rows($result)>0){
   echo "ada";
 }else{
echo "tak ade"; 
}

 ?>