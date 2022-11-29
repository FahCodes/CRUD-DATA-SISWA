<?php 
$server   = "localhost";
$username = "root";
$password = "";
$database = "crud1";
//Membuat Koneksi
$koneksi  = new mysqli($server, $username, $password, $database);
//Cek Koneksi
if($koneksi->connect_error){
	die("Koneksi Gagal" .$koneksi->connect_error);
}
?>