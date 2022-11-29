<!DOCTYPE html>
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
		$sex 	= $data['sex'];
	}
}
//Mengubah Data
if($_SERVER['REQUEST_METHOD']=="POST"){
	$nis 	= $_POST['nis'];
	$nama 	= $_POST['namasiswa'];
	$alamat = $_POST['alamat'];
	$sex 	= $_POST['sex'];
	//Cek Data
	if(empty($alamat)){
		$sqlEdit = "UPDATE SISWA SET nama='$nama' WHERE nis='$nis'";
	}else{
		$sqlEdit = "UPDATE SISWA SET nama='$nama', alamat='$alamat', sex='$sex' WHERE nis='$nis'";
	}
	$hasilEdit = $koneksi->query($sqlEdit);
	if($hasilEdit){
		header('location:tampildata.php');
	}else{
		echo "<script>alert('Data Siswa Gagal Diubah !');</script>";
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>::FORM INPUT DATA::</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
	<!--Awal Form-->
	<form name="frmsiswa" id="frmsiswa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		<!-- Form Nis Siswa-->
		<div class="row">
			<div class="col-25">
				<label for="nis">NIS</label>
			</div>
			<div class="col-75">
				<input type="text" name="nis" id="nis" placeholder="Nis Siswa..." readonly value="<?php echo $nis; ?>">
			</div>
		</div>
		<!-- Form Nama Siswa-->
		<div class="row">
			<div class="col-25">
				<label for="namasiswa">Nama Siswa</label>
			</div>
			<div class="col-75">
				<input type="text" name="namasiswa" id="namasiswa" placeholder="Nama Lengkap Siswa..." value="<?php echo $nama; ?>">
			</div>
		</div>
		<!--Form Alamat Siswa-->
		<div class="row">
			<div class="col-25">
				<label for="alamat">Alamat Siswa</label>
			</div>
			<div class="col-75">
				<textarea name="alamat" id="alamat" style="height: 100px;" placeholder="Alamat Lengkap Siswa..."><?php echo $alamat; ?></textarea>
			</div>
		</div>
		<!--Pilihan Jenis Kelamin-->
		<div class="row">
			<div class="col-25">
				<label for="sex">Jenis Kelamin</label>
			</div>
			<div class="col-75">
				<select name="sex" id="sex">
					<option value="L" <?php echo $sex=="L"?"Selected":"" ;?>>Laki-laki</option>
					<option value="P" <?php echo $sex=="P"?"Selected":"" ;?>>Perempuan</option>
				</select>
			</div>			
		</div>
		<!--Tombol-->
		<div class="row">
			<input type="submit" name="simpan" value="Simpan Edit">
			<input type="reset" name="batal" value="Kembali" onclick="location.href='tampildata.php'">
		</div>
	</form>
	<!--Akhir Form-->
</div>
</body>
</html>
<?php 
$koneksi->close();
?>