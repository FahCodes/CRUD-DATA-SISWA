<!DOCTYPE html>
<?php 
include "koneksi.php";
$nis 	= "";
$nama 	= "";
$alamat = "";
$sex 	= "";
if($_SERVER['REQUEST_METHOD']=="POST"){
	$nis = $_POST['nis'];
	$nama = $_POST['namasiswa'];
	$alamat = $_POST['alamat'];
	$sex = $_POST['sex'];
	//Cek Data
	$sqlcek = "SELECT * FROM SISWA where nis='$nis'";
	$hasilCek = $koneksi->query($sqlcek);
	if(!$hasilCek->num_rows>0){
		//Simpan Data
		if(!empty($nis) or !empty($nama)){
			$sql = "INSERT INTO SISWA (nis,nama,alamat,sex) VALUES ('$nis','$nama','$alamat','$sex')";
			if($koneksi->query($sql)=== TRUE){
				header('location:tampildata.php');
			}else{
				echo "<script>alert('Data Siswa Dengan Nama : $nama, Gagal Disimpan !');</script>";
			}
		}else{
			echo "<script>alert('Data Nama Dan Alamat Wajib Diisi !'); </script>";
		}
	}else{
		echo "<script>alert('Data Dengan Nis: $nis Dan Nama: $nama Sudah Ada !');</script>";
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
				<input type="text" name="nis" id="nis" placeholder="Nis Siswa..." value="<?php echo $nis; ?>">
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
			<input type="submit" name="simpan" value="Simpan Data">
			<input type="reset" name="batal" value="Kembali" onclick="location.href='tampildata.php'">
		</div>
	</form>
	<!--Akhir Form-->
</div>
</body>
<?php 
$koneksi->close();
?>
</html>