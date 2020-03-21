<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$sql="SELECT * FROM maktam_rasa";
$result=mysqli_query($conn,$sql);

$size=0;
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $size++;
    }
}


$sizeAll = $size*3+10; 
for($i=0; $i<$sizeAll; $i++){
    $data[$i] = $_POST['dt'.$i];
}

for($j=0; $j<$size; $j++){
    $dingin[$j]=$data[$j];
    $hangat[$j]=$data[$j+$size];
    $bonus[$j]=$data[$j+$size+$size];
    if(empty($dingin[$j]))      $dingin[$j]=0;
    if(empty($hangat[$j]))      $hangat[$j]=0;
    if(empty($bonus[$j]))       $bonus[$j]=0;
}


$dingin = json_encode( $dingin );
$hangat = json_encode( $hangat );
$bonus = json_encode( $bonus );

 $tanggal = $data[$size*3];
 $karyawan = $data[$size*3+1];
 $shift = $data[$size*3+2];
 $catatan = $data[$size*3+3];
 $modal = $data[$size*3+4];
 $pengeluaran = $data[$size*3+5];
 $pendapatan = $data[$size*3+6];
 $outlet = $data[$size*3+7];
 $mode = $data[$size*3+8];
 $idx = $data[$size*3+9];
 
 if(empty($pendapatan)) $pendapatan=0;
 if(empty($modal)) $modal=0;
 if(empty($pengeluaran)) $pengeluaran=0;

 $sql = "SELECT * FROM maktam_income WHERE date='$tanggal' and shift='$shift' and outlet='$outlet'";
 $result = mysqli_query($conn,$sql);
 
 if(mysqli_num_rows($result)>0){
    $avail=true;
 }else{
    $avail=false;
 }

 $sql = "SELECT * FROM maktam_income WHERE date='$tanggal' and shift='1' and outlet='$outlet'";
 $result = mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);

 $balance2 = 0;
 if($shift==1){
     $balance = $pendapatan;
 }else{
     if(mys)
     $balance = $row['balance'] + $pendapatan - $pengeluaran + $modal;
     $balance2 = $pendapatan - $pengeluaran + $modal;
 }

if($avail==false){
 $sql = "INSERT INTO `maktam_income` (`id`, `date`, `shift`, `employee`, `note`, `modals`, `expenditure`, `coldcup`, `warmcup`, `bonus`, `balance`, `income`, `outlet`, `saldo2`) VALUES (NULL, '$tanggal', '$shift', '$karyawan', '$catatan', '$modal', '$pengeluaran', '$dingin', '$hangat', '$bonus', '$balance', '$pendapatan', '$outlet', '$balance2');";
 mysqli_query($conn,$sql);
 echo "200";
}else{
   if($mode==1){
       $sql = "UPDATE `maktam_income` SET `date` = '$tanggal', `shift` = '$shift', `employee` = '$karyawan', `note` = '$catatan', `modals` = '$modal', `expenditure` = '$pengeluaran', `coldcup` = '$dingin', `warmcup` = '$hangat', `bonus` = '$bonus', `balance` = '$balance', `income` = '$pendapatan', `outlet` = '$outlet', `saldo2` = '$balance2' WHERE `maktam_income`.`id` = '$idx';";
       $result=mysqli_query($conn,$sql);
       echo "200";
   }else{
       echo "405";
   }
}

?>