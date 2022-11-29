<?php
include "koneksi.php";
if(isset($_GET['nis'])){
	$idhapus	= $_GET['nis'];
}else{
	echo "Parameter Nis Tidak Ada";
	$idhapus	= "";
}
$sqlhapus = "DELETE FROM siswa WHERE nis='$idhapus'";
$hasil = $koneksi->query($sqlhapus);
if($koneksi->query($sqlhapus) === TRUE){
	header('location:tampildata.php');
}else{
	echo "Error Hapus :".$sqlhapus."<br>".$koneksi->error;
}
$koneksi->close();
?>