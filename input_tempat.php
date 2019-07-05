<?php 
include 'koneksi.php';
 
 echo $id = $_GET['id_tempat'];

mysqli_query($conn,"DELETE FROM `tempat` WHERE `tempat`.`id_tempat` = '$id';");

header("location:tempat.php");
 ?>