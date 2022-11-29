<?php 
include "koneksi.php";
$nis 	= "";
$nama 	= "";
$alamat = "";
$sex 	= "";
//Cek Data
if(isset($_GET['nis'])){
	$nis 		= $_GET['nis'];
	$sqlcek 	= "SELECT nis,nama,alamat,sex FROM siswa WHERE nis = '$nis'";
	$hasilCek 	= $koneksi->query($sqlcek);
	if($hasilCek->num_rows>0){
		$data 	= $hasilCek->fetch_assoc();
		$nis 	= $data['nis'];
		$nama 	= $data['nama'];
		$alamat = $data['alamat'];
		$sex 	= $data['sex']=="L"?"Laki-Laki":"Perempuan";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist\css\bootstrap.min.css">
</head>
<body>
	<div class="form-group">
			<label for="nama">Nama Siswa:</label>
			<input type="text" id="siswa" name="siswa" class="form-control" readonly value="<?php echo $nama; ?>">
		</div>
		<div class="form-group">
			<label for="alamat">Alamat:</label>
			<textarea class="form-control" name="alamat" id="alamat" readonly><?php echo $alamat; ?></textarea>
		</div>
		<div class="form-group">
			<label>Jenis Kelamin:</label><br>
			<input type="text" name="sex" id="sex" class="form-control" readonly placeholder="Jenis Kelamin..." value="<?php echo $sex; ?>">
		</div>
</body>
</html>
<?php
$koneksi->close();
?>