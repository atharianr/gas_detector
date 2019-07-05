
<?php include "./koneksi.php"; // koneksi ke database
date_default_timezone_set('Asia/Jakarta'); // set waktu ke dalam zona asia/jakarta

// metode get untuk menerima data dari arduino
$lpg = $_GET['lpg'];
//$co = $_GET['co'];
//$smoke = $_GET['smoke'];
$tempat = "T".$_GET['tempat'];

// Memberikan payload ke arduino bahwa dataa berhasil di masukkan
echo "Menambah LPG=".$lpg." Sukses Dari Tempat ". $tempat;

// query untuk menambahkan data masuk ke dalam database
$query_tambah = "INSERT INTO `data` (`id_data`, `lpg`, `waktu`, `tempat`) VALUES (NULL, '$lpg' , CURRENT_TIMESTAMP,'$tempat' );";
$ck= mysqli_query($conn,$query_tambah);

 
