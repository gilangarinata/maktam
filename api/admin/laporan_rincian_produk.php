<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
//$tanggal = $_POST['tanggal'];

$tanggal = "23/07/2019";
$result_array = array();
$data = array();
$outlets = array();
$produk = array();
$rasa = array();
$dingin = array();
$terjual = array();
$sisa = array();
$total_terjual = array();
$total_sisa = array();

$sql="SELECT * FROM maktam_produk";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $produk[$i]=$row['produk'];
        $rasa[$i]=json_decode($row['rasa1']);
        $i++;
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
$pendapatan = 0;
    for($j=0; $j<sizeof($outlets); $j++){
    $sql="SELECT * FROM maktam_other WHERE outlet='$outlets[$j]' and date='$tanggal'";
    $result=mysqli_query($conn,$sql);
    $length = 0;
    $p = 0;
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $dingin = json_decode($row['icecream']);
            $pendapatan = $pendapatan + $dingin[5];



            $length = array_sum($dingin[9]) + $dingin[8];
            for($i=0; $i<$length; $i++){
                $terjual[$i] = $dingin[10 + $length + $i];
                $sisa[$i] = $dingin[10 + 2*$length + $i];
                $total_terjual[$i] = $total_terjual[$i] + $terjual[$i];
                $total_sisa[$i] = $sisa[$i];                     
            }
            $p++;      
        }
    }else{
            $dingin = array();
            $total_terjual = array();
            $total_sisa = array();
            $terjual = array();
            $sisa = array();

    }


    $data["outlet"] = $outlets[$j];
    $data["data"] = json_encode($dingin);
    $data["terjual"] = json_encode($total_terjual);
    $data["sisa"] = json_encode($total_sisa);
    array_push($result_array, $data);
}
$data["produk"] = json_encode($produk);
$data["rasa"] = json_encode($rasa);
$data["pendapatan"] = json_encode($pendapatan);


array_push($result_array,$data);
    
//echo json_encode($result_array);
?>


<style>
*, *:before, *:after {
  -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
 }

body {
  background: #999;
}

h2 {
  margin: 0 0 20px 0;
  padding: 0 0 5px 0;
  border-bottom: 1px solid #999;
  font-family: sans-serif;
  font-weight: normal;
  color: #333;
}

.container {
  width: 500px;
  margin: 20px;
  background: #fff;
  padding: 20px;
  overflow: hidden;
  float: left;
}

.horizontal .progress-bar {
  float: left;
  height: 45px;
  width: 100%;
  padding: 12px 0;
}

.horizontal .progress-track {
  position: relative;
  width: 100%;
  height: 20px;
  background: #ebebeb;
}

.horizontal .progress-fill {
  position: relative;
  background: #666;
  height: 20px;
  width: 50%;
  color: #fff;
  text-align: center;
  font-family: "Lato","Verdana",sans-serif;
  font-size: 12px;
  line-height: 20px;
}

.rounded .progress-track,
.rounded .progress-fill {
  border-radius: 3px;
  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
}



/* Vertical */

.vertical .progress-bar {
  float: left;
  height: 300px;
  width: 40px;
  margin-right: 25px;
}

.vertical .progress-track {
  position: relative;
  width: 40px;
  height: 100%;
  background: #ebebeb;
}

.vertical .progress-fill {
  position: relative;
  background: #825;
  height: 50%;
  width: 40px;
  color: #fff;
  text-align: center;
  font-family: "Lato","Verdana",sans-serif;
  font-size: 12px;
  line-height: 20px;
}

.rounded .progress-track,
.rounded .progress-fill {
  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
  border-radius: 3px;
}
    </style>

<div class="container vertical flat">
  <h2>Vertical, Flat</h2>
  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>100%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>75%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>60%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>20%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>34%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>82%</span>
      </div>
    </div>
  </div>
</div>

<script>
$('.vertical .progress-fill span').each(function(){
  var percent = $(this).html();
  var pTop = 100 - ( percent.slice(0, percent.length - 1) ) + "%";
  $(this).parent().css({
    'height' : percent,
    'top' : pTop
  });
});

</script>