<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$id=$_POST['id'];

$sql = "DELETE FROM maktam_login WHERE id=$id";
mysqli_query($conn, $sql)

?>